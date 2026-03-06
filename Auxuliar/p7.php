<?php


interface StatusChamado
{
    // Constantes disponíveis em qualquer classe que implementar
    const ABERTO        = 'aberto';
    const EM_ANDAMENTO  = 'em_andamento';
    const AGUARDANDO    = 'aguardando_cliente';
    const RESOLVIDO     = 'resolvido';
    const CANCELADO     = 'cancelado';


    // Status finais (fechados)
    const STATUS_FINAIS = [self::RESOLVIDO, self::CANCELADO];


    public function getStatus(): string;
    public function estaFechado(): bool;
}


class Chamado implements StatusChamado
{
    private string $status;


    public function __construct(
        private int    $id,
        private string $titulo
    ) {
        $this->status = self::ABERTO; // usa a constante da interface
    }


    public function avancarStatus(): void
    {
        if ($this->estaFechado()) {
            throw new \LogicException('Chamado já está fechado.');
        }
        $fluxo = [
            self::ABERTO       => self::EM_ANDAMENTO,
            self::EM_ANDAMENTO => self::AGUARDANDO,
            self::AGUARDANDO   => self::RESOLVIDO,
        ];
        $this->status = $fluxo[$this->status] ?? $this->status;
        echo "Chamado #{$this->id}: status → {$this->status}\n";
    }


    public function getStatus(): string { return $this->status; }


    public function estaFechado(): bool
    {
        return in_array($this->status, self::STATUS_FINAIS);
    }
}


// Também posso acessar as constantes diretamente pela interface
echo StatusChamado::ABERTO;        // 'aberto'
echo StatusChamado::EM_ANDAMENTO;  // 'em_andamento'


$c = new Chamado(1, 'Impressora não imprime');
$c->avancarStatus(); // → em_andamento
$c->avancarStatus(); // → aguardando_cliente
$c->avancarStatus(); // → resolvido
echo $c->estaFechado() ? 'Fechado' : 'Aberto'; // Fechado
