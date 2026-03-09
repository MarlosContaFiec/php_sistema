<?php

namespace Domain\Repositorio;
interface RepositorioInterface
    {

    public function buscarPorId(int $id): ?object;

    public function buscarTodos(): array;

    public function salvar(object $entidade): bool;

    public function atualizar(object $entidade): bool;

    public function deletar(int $id): bool;

    public function contar(): int;
    }