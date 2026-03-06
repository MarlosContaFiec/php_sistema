<?php

class Cliente extends Usuario
{
    public function __construct(
        string $nome, string $email, string $senha,
        private string $empresa
    ) {
        parent::__construct($nome, $email, $senha);
    }


    public function getPermissao(): string
    {
        return 'CLIENTE';
    }


    public function exibirPerfil(): void
    {
        echo "[CLIENTE] {$this->nome} | {$this->email} | {$this->empresa}\n";
    }
}