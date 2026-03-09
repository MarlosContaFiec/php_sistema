<?php

namespace Domain\Repositorio;
use Domain\Entidade\Usuario;

interface UsuarioRepositorioInterface extends RepositorioInterface
{

public function buscarPorId(int $id): ?Usuario;

public function buscarPorEmail(string $email): ?Usuario;

public function buscarPorPermissao(string $permissao): array;

public function buscarTecnicosAtivos(): array;

public function emailJaCadastrado(string $email): bool;

public function contarPorPermissao(): array;
}