<?php
// src/Domain/Repositorio/ChamadoRepositorioInterface.php
namespace Domain\Repositorio;
use Domain\Entidade\Chamado;
/**
* Contrato específico para repositório de Chamados.
* É a interface mais importante do projeto Helpdesk Pro.
*/
interface ChamadoRepositorioInterface extends RepositorioInterface
{
// Refinamento de tipo
public function buscarPorId(int $id): ?Chamado;
// ── Filtros por status ──────────────────────────────────────────
/**
* Retorna todos os chamados com um determinado status.
* Use as constantes: Chamado::STATUS_ABERTO, ::STATUS_RESOLVIDO, etc.
*/
public function buscarPorStatus(string $status): array;
/**
* Retorna todos os chamados ainda em aberto
* (aberto | em_andamento | aguardando_cliente).
*/
public function buscarAbertos(): array;
// ── Filtros por ator ────────────────────────────────────────────
/**
* Retorna chamados abertos por um cliente específico.
*/
public function buscarPorCliente(int $idCliente): array;
/**
* Retorna chamados atribuídos a um técnico específico.
*/
public function buscarPorTecnico(int $idTecnico): array;
/**
* Retorna chamados de um técnico que ainda não foram resolvidos.
*/
public function buscarAbertosDoTecnico(int $idTecnico): array;
// ── Filtros por classificação ───────────────────────────────────
/**
* Retorna chamados por tipo: 'incidente' ou 'solicitacao'.
*/
public function buscarPorTipo(string $tipo): array;
/**
* Retorna chamados por nível de prioridade.
*/
public function buscarPorPrioridade(string $prioridade): array;
// ── Estatísticas ────────────────────────────────────────────────
/**

* Retorna um array com a contagem de chamados por status.
* Ex: ['aberto' => 4, 'em_andamento' => 2, 'resolvido' => 10]
*/
public function contarPorStatus(): array;
/**
* Retorna um array com a contagem por prioridade.
*/
public function contarPorPrioridade(): array;
}