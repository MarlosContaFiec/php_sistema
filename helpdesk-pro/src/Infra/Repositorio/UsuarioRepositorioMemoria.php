<?php

namespace Infra\Repositorio;
use Domain\Entidade\Usuario;
use Domain\Repositorio\UsuarioRepositorioInterface;

class UsuarioRepositorioMemoria implements UsuarioRepositorioInterface
{
/** @var Usuario[] */
private array $storage = [];
// === === ===CRUD Base === === ===
public function buscarPorId(int $id): ?Usuario
{
return $this->storage[$id] ?? null;
}
public function buscarTodos(): array
{
return array_values($this->storage);
}
public function salvar(object $usuario): bool
{
if (!$usuario instanceof Usuario) {
throw new \InvalidArgumentException('Esperado um objeto Usuario.');
}
if ($this->emailJaCadastrado($usuario->getEmail())) {
throw new \RuntimeException("E-mail '{$usuario->getEmail()}' já cadastrado.");
}
$this->storage[$usuario->getId()] = $usuario;
return true;
}
public function atualizar(object $usuario): bool
{
if (!isset($this->storage[$usuario->getId()])) {

return false;
}
$this->storage[$usuario->getId()] = $usuario;
return true;
}
public function deletar(int $id): bool
{
if (!isset($this->storage[$id])) {
return false;
}
unset($this->storage[$id]);
return true;
}
public function contar(): int
{
return count($this->storage);
}
// === === === Buscas específicas de Usuário === === ===
public function buscarPorEmail(string $email): ?Usuario
{
foreach ($this->storage as $usuario) {
if (strtolower($usuario->getEmail()) === strtolower($email)) {
return $usuario;
}
}
return null;
}
public function buscarPorPermissao(string $permissao): array
{
return array_values(array_filter(
$this->storage,
fn(Usuario $u) => $u->getPermissao() === $permissao
));
}
public function buscarTecnicosAtivos(): array
{
return array_values(array_filter(
$this->storage,
fn(Usuario $u) => $u->getPermissao() === 'tecnico' && $u->isAtivo()
));
}
public function emailJaCadastrado(string $email): bool
{
return $this->buscarPorEmail($email) !== null;
}
public function contarPorPermissao(): array
{
$resultado = [];
foreach ($this->storage as $usuario) {
$perm = $usuario->getPermissao();
$resultado[$perm] = ($resultado[$perm] ?? 0) + 1;
}
return $resultado;
}
}