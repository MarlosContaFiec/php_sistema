<?php
// src/Domain/Repositorio/UsuarioRepositorioInterface.php
namespace Domain\Repositorio;
use Domain\Entidade\Usuario;
/**
* Contrato específico para repositório de Usuários.
* Estende o CRUD base com buscas próprias de Usuario.
*/
interface UsuarioRepositorioInterface extends RepositorioInterface
{
// Refinamento de tipo: retorna Usuario (não object genérico)
public function buscarPorId(int $id): ?Usuario;
/**
* Busca um usuário pelo endereço de e-mail (campo único no sistema).
* Usado no processo de login e validação de cadastro.
*/
public function buscarPorEmail(string $email): ?Usuario;
/**
* Retorna todos os usuários de uma permissão específica.
* Ex: buscarPorPermissao('tecnico') → todos os técnicos.
*/
public function buscarPorPermissao(string $permissao): array;
/**
* Retorna apenas os técnicos que estão com status ativo.
* Usado para atribuição de chamados.
*/
public function buscarTecnicosAtivos(): array;
/**
* Verifica se já existe um usuário com o e-mail informado.
* Mais eficiente que buscarPorEmail() quando só precisamos saber se existe.
*/
public function emailJaCadastrado(string $email): bool;
/**
* Retorna um array com contagem agrupada por permissão.
* Ex: ['tecnico' => 5, 'cliente' => 12]
*/
public function contarPorPermissao(): array;
}