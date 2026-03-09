<?php

namespace Infra\Repositorio;
use Domain\Entidade\Chamado;
use Domain\Repositorio\ChamadoRepositorioInterface;
class ChamadoRepositorioMemoria implements ChamadoRepositorioInterface
{
/** @var Chamado[] */
private array $storage = [];
// === === === CRUD Base === === ===
public function buscarPorId(int $id): ?Chamado
{
return $this->storage[$id] ?? null;
}
public function buscarTodos(): array
{
return array_values($this->storage);
}
public function salvar(object $chamado): bool
{
if (!$chamado instanceof Chamado) {
throw new \InvalidArgumentException('Esperado um objeto Chamado.');
}
$this->storage[$chamado->getId()] = $chamado;
return true;
}
public function atualizar(object $chamado): bool
{
if (!isset($this->storage[$chamado->getId()])) {
return false;
}
$this->storage[$chamado->getId()] = $chamado;
return true;
}
public function deletar(int $id): bool
{
if (!isset($this->storage[$id])) return false;
unset($this->storage[$id]);
return true;
}
public function contar(): int
{
return count($this->storage);
}
// === === === Filtros por status === === ===
public function buscarPorStatus(string $status): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->getStatus() === $status
));
}
public function buscarAbertos(): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->estaAberto()
));

}
// === === === Filtros por ator === === ===
public function buscarPorCliente(int $idCliente): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->getIdCliente() === $idCliente
));
}
public function buscarPorTecnico(int $idTecnico): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->getIdTecnico() === $idTecnico
));
}
public function buscarAbertosDoTecnico(int $idTecnico): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->getIdTecnico() === $idTecnico && $c->estaAberto()
));
}
// === === === Filtros por classificação === === ===
public function buscarPorTipo(string $tipo): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->getTipo() === $tipo
));
}
public function buscarPorPrioridade(string $prioridade): array
{
return array_values(array_filter(
$this->storage,
fn(Chamado $c) => $c->getPrioridade() === $prioridade
));
}
// === === === Estatísticas === === ===
public function contarPorStatus(): array
{
$resultado = [];
foreach ($this->storage as $chamado) {
$st = $chamado->getStatus();
$resultado[$st] = ($resultado[$st] ?? 0) + 1;
}
arsort($resultado);
return $resultado;
}
public function contarPorPrioridade(): array
{
$resultado = [];
foreach ($this->storage as $chamado) {
$pri = $chamado->getPrioridade();
$resultado[$pri] = ($resultado[$pri] ?? 0) + 1;
}
return $resultado;
}
}