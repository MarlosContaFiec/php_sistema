<?php


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


    // --- Getters comuns ---
    public function getId():    int    { return $this->id;    }
    public function getNome():  string { return $this->nome;  }
    public function getEmail(): string { return $this->email; }


    public function verificarSenha(string $senhaDigitada): bool
    {
        return password_verify($senhaDigitada, $this->senha);
    }


    // --- Método abstrato: cada tipo de usuário DEVE implementar ---
    abstract public function getPermissao(): string;
    abstract public function exibirPerfil(): void;
}


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


// --- Polimorfismo: tratando todos como Usuario ---
$usuarios = [
    new Tecnico('Carlos', 'carlos@hd.com', '123', 'Redes'),
    new Cliente('Ana', 'ana@emp.com', 'abc', 'Tech Ltda'),
    new Tecnico('Mariana', 'mari@hd.com', '456', 'Suporte'),
];


foreach ($usuarios as $usuario) {
    $usuario->exibirPerfil();
    echo "Permissão: " . $usuario->getPermissao() . "\n\n";
}
