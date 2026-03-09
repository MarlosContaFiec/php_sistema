<?php

require_once __DIR__ . '/../src/Core/Autoloader.php';

use Core\Autoloader;
use Domain\Entidade\{Tecnico, Cliente, Chamado};
use Infra\Repositorio\{UsuarioRepositorioMemoria, ChamadoRepositorioMemoria};

$loader = new Autoloader(__DIR__ . '/../src');
$loader->registrar();

echo "=== TESTE DOS REPOSITÓRIOS DO HELPDESK PRO ===\n";

// === === === 1. Usuários === === ===
$usuarios = new UsuarioRepositorioMemoria();

$t1 = new Tecnico('Carlos Silva', 'carlos@hd.com', 'senha123', 'Redes', 'Senior');
$t2 = new Tecnico('Mariana Lima', 'mari@hd.com', 'senha456', 'Suporte', 'Pleno');
$t3 = new Tecnico('Pedro Alves', 'pedro@hd.com', 'senha789', 'Segurança', 'Junior');

$c1 = new Cliente('Ana Costa', 'ana@empresa.com', 'cli123', 'Tech Ltda', '12.345.678/0001-90');
$c2 = new Cliente('Bruno Dias', 'bruno@firma.com', 'cli456', 'Sistemas SA', '98.765.432/0001-11');

foreach ([$t1,$t2,$t3,$c1,$c2] as $u) {
    $usuarios->salvar($u);
}

echo "Usuários cadastrados: " . $usuarios->contar() . "\n";

$perm = array_change_key_case($usuarios->contarPorPermissao(), CASE_LOWER);
echo "Por permissão: Array ( ";
foreach ($perm as $k => $v) {
    echo "[$k] => $v ";
}
echo ")\n";

$encontrado = $usuarios->buscarPorEmail('carlos@hd.com');
echo "Busca por e-mail: " . ($encontrado ? $encontrado->getNome() : 'não encontrado') . "\n";

echo "Técnicos ativos: " . count($usuarios->buscarTecnicosAtivos()) . "\n";

// === === === 2. Chamados === === ===
$chamados = new ChamadoRepositorioMemoria();

$ch1 = new Chamado('Servidor fora do ar', 'Servidor de produção inacessível.', $c1->getId(), 'incidente', 'critica');
$ch2 = new Chamado('Impressora não imprime', 'Impressora do 3o andar com defeito.', $c1->getId(), 'incidente', 'media');
$ch3 = new Chamado('Novo acesso VPN', 'Solicito criação de acesso VPN.', $c2->getId(), 'solicitacao', 'baixa');
$ch4 = new Chamado('E-mail corporativo', 'Configurar e-mail no celular.', $c2->getId(), 'solicitacao', 'baixa');
$ch5 = new Chamado('Ataque de ransomware', 'Arquivos criptografados na rede.', $c1->getId(), 'incidente', 'critica');
$ch6 = new Chamado('Lentidão no sistema', 'ERP travando após atualização.', $c2->getId(), 'incidente', 'alta');

foreach ([$ch1,$ch2,$ch3,$ch4,$ch5,$ch6] as $ch) {
    $chamados->salvar($ch);
}

$ch1->atribuirTecnico($t1->getId()); $chamados->atualizar($ch1);
$ch5->atribuirTecnico($t1->getId()); $chamados->atualizar($ch5);
$ch2->atribuirTecnico($t2->getId()); $chamados->atualizar($ch2);
$ch6->atribuirTecnico($t3->getId()); $chamados->atualizar($ch6);

$ch2->resolver('Impressora substituída por unidade reserva.');
$chamados->atualizar($ch2);

// === === === 3. Relatório === === ===
echo "=== RELATÓRIO DE CHAMADOS ===\n";
echo "Total: " . $chamados->contar() . "\n";

$status = $chamados->contarPorStatus();
echo "Por status:\n";
echo implode(' | ', array_map(
    fn($k,$v) => "$k: $v",
    array_keys($status),
    $status
)) . "\n";

$pri = $chamados->contarPorPrioridade();
echo "Por prioridade:\n";
echo implode(' | ', array_map(
    fn($k,$v) => "$k: $v",
    array_keys($pri),
    $pri
)) . "\n";

echo "Chamados do Técnico Carlos:\n";
foreach ($chamados->buscarPorTecnico($t1->getId()) as $ch) {
    echo "[#{$ch->getId()}] {$ch->getTitulo()} | Status: {$ch->getStatus()} | Prioridade: {$ch->getPrioridade()}\n";
}

echo "Chamados críticos:\n";
foreach ($chamados->buscarPorPrioridade('critica') as $ch) {
    echo "[#{$ch->getId()}] {$ch->getTitulo()} | {$ch->getStatus()} | {$ch->getPrioridade()}\n";
}