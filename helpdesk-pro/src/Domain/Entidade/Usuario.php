<?php

namespace Domain\Entidade;

abstract class Usuario
{
    private static int $contadorId = 0;
    private int        $id;


    public function __construct(
        protected string $nome,
        protected string $email,
        protected string $senha
    ) {
        self::$contadorId++;
        $this->id    = self::$contadorId;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function getId():    int    { return $this->id;    }
    public function getNome():  string { return $this->nome;  }
    public function getEmail(): string { return $this->email; }

    public function verificarSenha(string $senhaDigitada): bool {
        return password_verify($senhaDigitada, $this->senha);
    }

    abstract public function getPermissao(): string;
    abstract public function exibirPerfil(): void;
}


// $usuarios = [
//     new Tecnico('Carlos', 'carlos@hd.com', '123', 'Redes'),
//     new Cliente('Ana', 'ana@emp.com', 'abc', 'Tech Ltda'),
//     new Tecnico('Mariana', 'mari@hd.com', '456', 'Suporte'),
// ];


// foreach ($usuarios as $usuario) {
//     $usuario->exibirPerfil();
//     echo "Permissão: " . $usuario->getPermissao() . "\n\n";
// }
