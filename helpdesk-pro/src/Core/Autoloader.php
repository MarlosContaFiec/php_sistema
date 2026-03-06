<?php
// src/Core/Autoloader.php
namespace Core;
class Autoloader
{
private string $baseDir;
public function __construct(string $baseDir)
{
$this->baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR);
}
public function registrar(): void
{
spl_autoload_register([$this, 'carregar']);
}
private function carregar(string $classeComNamespace): void
{
// Converte namespace em caminho de arquivo
// Ex: Domain\Entidade\Chamado → src/Domain/Entidade/Chamado.php
$caminho = $this->baseDir
. DIRECTORY_SEPARATOR
. str_replace('\\', DIRECTORY_SEPARATOR, $classeComNamespace)
. '.php';
if (file_exists($caminho)) {
require_once $caminho;
}
}
}
// ──────────────────────────────────────────────────────────
// public/index.php — ponto de entrada
// ──────────────────────────────────────────────────────────
<?php
// Carrega o Autoloader (único require_once manual do projeto)
require_once __DIR__ . '/../src/Core/Autoloader.php';
use Core\Autoloader;
$loader = new Autoloader(__DIR__ . '/../src');
$loader->registrar();
// A partir daqui, todas as classes são carregadas automaticamente
use Domain\Entidade\{Tecnico, Cliente, Chamado};
use Infra\Repositorio\{UsuarioRepositorioMemoria, ChamadoRepositorioMemoria};
// ... seu código de teste aqui