<?php

namespace Domain\Repositorio;
use Domain\Entidade\Chamado;

interface ChamadoRepositorioInterface extends RepositorioInterface
{
    
public function buscarPorId(int $id): ?Chamado;
// === === === Filtros por status === === ===
public function buscarPorStatus(string $status): array;
public function buscarAbertos(): array;

// === === === Filtros por ator === === ===
public function buscarPorCliente(int $idCliente): array;
public function buscarPorTecnico(int $idTecnico): array;
public function buscarAbertosDoTecnico(int $idTecnico): array;

// === === === Filtros por classificação === === ===
public function buscarPorTipo(string $tipo): array;
public function buscarPorPrioridade(string $prioridade): array;

// === === === Estatísticas === === ===
public function contarPorStatus(): array;
public function contarPorPrioridade(): array;
}