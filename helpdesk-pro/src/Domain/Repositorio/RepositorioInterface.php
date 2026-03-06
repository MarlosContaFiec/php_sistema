<?php
// src/Domain/Repositorio/RepositorioInterface.php
namespace Domain\Repositorio;
/**
* Contrato base para todos os repositórios do sistema.
* Define as operações CRUD genéricas.
*/
interface RepositorioInterface
{
/**
* Busca uma entidade pelo seu ID.
* Retorna null se não encontrar (nunca lança exceção de 'não encontrado').
*/
public function buscarPorId(int $id): ?object;
/**
* Retorna todas as entidades do repositório.
* Array vazio se não houver nenhuma.
*/
public function buscarTodos(): array;
/**
* Persiste uma nova entidade.
* Retorna true em sucesso, false em falha.
*/
public function salvar(object $entidade): bool;
/**
* Atualiza uma entidade existente.
* Retorna false se a entidade não existir.
*/
public function atualizar(object $entidade): bool;
/**
* Remove uma entidade pelo ID.
* Retorna false se não existir.
*/
public function deletar(int $id): bool;
/**
* Retorna o total de registros no repositório.
*/
public function contar(): int;
}