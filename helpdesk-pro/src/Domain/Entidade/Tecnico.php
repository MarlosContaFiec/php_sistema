<?php

class Tecnico extends Usuario
{
    public function __construct(
        string $nome, string $email, string $senha,
        private string $especialidade
    ) {
        parent::__construct($nome, $email, $senha);
    }


    // OBRIGADO a implementar getPermissao()
    public function getPermissao(): string
    {
        return 'TECNICO';
    }


    // OBRIGADO a implementar exibirPerfil()
    public function exibirPerfil(): void
    {
        echo "[TÉCNICO] {$this->nome} | {$this->email} | {$this->especialidade}\n";
    }
}