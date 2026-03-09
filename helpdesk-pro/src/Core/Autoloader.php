<?php

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
$caminho = $this->baseDir
. DIRECTORY_SEPARATOR
. str_replace('\\', DIRECTORY_SEPARATOR, $classeComNamespace)
. '.php';
if (file_exists($caminho)) {
require_once $caminho;
}
}
}