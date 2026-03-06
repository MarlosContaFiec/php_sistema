<?php

use PSpell\Dictionary;

interface Repositoriolnterface 
{

    public function buscarPorId(int $id): ?object;
    
    public function buscarTodos() : array;

    public function salvar(object $entidade) : bool;

    public function atualizar(object $entidade) : ?bool;

    public function deletar(int $id) : ?bool;

    public function contar() : int;
}

interface UsuarioRepositoryInterface extends Repositoriolnterface 
{
    public function buscarPorId(int $id) : ?Usuario;

    public function buscarPorEmail(string $email) : ?Usuario;

    public function buscarPorPermissao(string $permissao) : array;

    public function buscarTecnicoAtivos(): array;

    public function emailJaCadastrado(string $email) : bool; 


}

interface ChamadoRepositoryInterface extends Repositoriolnterface 
{
    public function buscarPorId(int $id): ?Chamado;
//filtro status
    public function buscarPorStatus(string $status): array;
    
    public function buscarAbertos(): array;

//filtro por ator
    public function buscarPorCliente(int $idCliente): array;
    
    public function buscarPorTecnico(int $idTecnico): array;
    
    public function buscarAbertosDoTecnico(int $idTecnico): array;

//filtro por classificação
    public function buscarPorTipo(string $tipo): array;
    
    public function buscarPorPrioridade(string $prioridade): array;
    
//estatistica
    public function contarChamadoDoMes(string $mes): int;
    
    public function contarPorStatus(): array;
    
    public function contarPorPrioridade(): array;
}

class UsuarioRepositoryMemoria implements UsuarioRepositorioInterface{
    /** @var Usuario[] */
    private array $storage = [];

    //lindo crud

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
        if (!$usuario instanceof Usuario)
        {
            throw new \InvalidArgumentException("Esperado um objeto Usuario");
        }
        if ($this->emailJaCadastrado($usuario->getEmail())) 
        {
            throw new \RuntimeException("Email já cadastrado");
        }

        $this->storage[$usuario->getId()] = $usuario;
        return true;
    }

}