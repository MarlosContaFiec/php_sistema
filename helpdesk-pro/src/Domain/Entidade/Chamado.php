<?php

namespace Domain\Entidade;

class Chamado
{
private static int $contadorId = 0;
private int $id;
private string $dataCriacao;
private ?string $dataFechamento = null;
private ?int $idTecnico = null;
private array $historico = [];
// === Constante de status ===
const STATUS_ABERTO = 'aberto';
const STATUS_EM_ANDAMENTO = 'em_andamento';
const STATUS_AGUARDANDO = 'aguardando_cliente';
const STATUS_RESOLVIDO = 'resolvido';
const STATUS_CANCELADO = 'cancelado';
public function __construct(
private string $titulo,
private string $descricao,
private int $idCliente,
private string $tipo, 
private string $prioridade 
) {
self::$contadorId++;
$this->id = self::$contadorId;
$this->dataCriacao = date('Y-m-d H:i:s');
$this->historico[] = "Chamado aberto em {$this->dataCriacao}";
$this->status = self::STATUS_ABERTO;
}
// === Getters ===
public function getId(): int { return $this->id; }
public function getTitulo(): string { return $this->titulo; }
public function getDescricao(): string { return $this->descricao; }
public function getIdCliente(): int { return $this->idCliente; }
public function getIdTecnico(): ?int { return $this->idTecnico; }
public function getStatus(): string { return $this->status; }
public function getTipo(): string { return $this->tipo; }
public function getPrioridade(): string { return $this->prioridade; }
public function getDataCriacao(): string { return $this->dataCriacao; }
public function getHistorico(): array { return $this->historico; }
// === Métodos de negócio ===
public function atribuirTecnico(int $idTecnico): void
    {
    $this->idTecnico = $idTecnico;
    $this->status = self::STATUS_EM_ANDAMENTO;
    $this->historico[] = "Atribuído ao técnico #{$idTecnico} em " . date('Y-m-d
    H:i:s');
    }
public function resolver(string $resolucao): void
    {
    if ($this->status === self::STATUS_RESOLVIDO) {
        throw new \LogicException('Chamado já está resolvido.');
        }
        $this->status = self::STATUS_RESOLVIDO;
        $this->dataFechamento = date('Y-m-d H:i:s');
        $this->historico[] = "Resolvido: {$resolucao}";
    }
public function estaAberto(): bool
    {
    return in_array($this->status, [self::STATUS_ABERTO, self::STATUS_EM_ANDAMENTO,
    self::STATUS_AGUARDANDO]);
    }
public function exibirResumo(): void
    {
    echo "[#{$this->id}] {$this->titulo} | Status: {$this->status} | Prioridade:
    {$this->prioridade}\n";

    }
}