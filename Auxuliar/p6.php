<?php


// Interface base — leitura
interface Repositorio
{
    public function buscarPorId(int $id): ?object;
    public function buscarTodos(): array;
}


// Interface estendida — leitura + escrita
interface RepositorioGravavel extends Repositorio
{
    public function salvar(object $entidade): bool;
    public function atualizar(object $entidade): bool;
    public function deletar(int $id): bool;
}


// Quem implementa RepositorioGravavel DEVE implementar os 5 métodos
class ChamadoRepositorio implements RepositorioGravavel
{
    private array $dados = [];


    public function buscarPorId(int $id): ?object
    {
        return $this->dados[$id] ?? null;
    }


    public function buscarTodos(): array
    {
        return array_values($this->dados);
    }


    public function salvar(object $entidade): bool
    {
        $id = $entidade->getId();
        $this->dados[$id] = $entidade;
        echo "Chamado #{$id} salvo.\n";
        return true;
    }


    public function atualizar(object $entidade): bool
    {
        $id = $entidade->getId();
        if (!isset($this->dados[$id])) return false;
        $this->dados[$id] = $entidade;
        echo "Chamado #{$id} atualizado.\n";
        return true;
    }


    public function deletar(int $id): bool
    {
        if (!isset($this->dados[$id])) return false;
        unset($this->dados[$id]);
        echo "Chamado #{$id} removido.\n";
        return true;
    }
}


// Posso declarar parâmetro com a interface BASE — mais genérico
function listarItens(Repositorio $repo): void
{
    $todos = $repo->buscarTodos();
    echo count($todos) . " item(s) encontrado(s).\n";
}
