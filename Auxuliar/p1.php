<?php


// ---- CLASSE PAI ----
class Usuario
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


    public function verificarSenha(string $senhaDigitada): bool
    {
        return password_verify($senhaDigitada, $this->senha);
    }


    public function exibirPerfil(): void
    {
        echo "ID: {$this->id} | Nome: {$this->nome} | Email: {$this->email}\n";
    }
}


// ---- CLASSE FILHA: Tecnico ----
class Tecnico extends Usuario
{
    private array $chamadosAtendidos = [];


    public function __construct(
        string $nome,
        string $email,
        string $senha,
        private string $especialidade,
        private string $nivelCertificacao // 'Junior', 'Pleno', 'Senior'
    ) {
        parent::__construct($nome, $email, $senha);
    }


    public function getEspecialidade():      string { return $this->especialidade;      }
    public function getNivelCertificacao():  string { return $this->nivelCertificacao;  }
    public function getChamadosAtendidos():  array  { return $this->chamadosAtendidos;  }


    public function registrarAtendimento(int $idChamado): void
    {
        $this->chamadosAtendidos[] = $idChamado;
        echo "Técnico {$this->nome} registrou atendimento do chamado #{$idChamado}\n";
    }


    #[\Override]
    public function exibirPerfil(): void
    {
        parent::exibirPerfil(); // exibe dados do Usuario
        echo "Especialidade: {$this->especialidade} | Nível: {$this->nivelCertificacao}\n";
        echo "Chamados atendidos: " . count($this->chamadosAtendidos) . "\n";
    }
}


// ---- CLASSE FILHA: Cliente ----
class Cliente extends Usuario
{
    private array $chamadosAbertos = [];


    public function __construct(
        string $nome,
        string $email,
        string $senha,
        private string $empresa,
        private string $cnpj
    ) {
        parent::__construct($nome, $email, $senha);
    }


    public function getEmpresa(): string { return $this->empresa; }


    public function abrirChamado(int $idChamado): void
    {
        $this->chamadosAbertos[] = $idChamado;
        echo "Cliente {$this->nome} abriu o chamado #{$idChamado}\n";
    }


    #[\Override]
    public function exibirPerfil(): void
    {
        parent::exibirPerfil();
        echo "Empresa: {$this->empresa} | CNPJ: {$this->cnpj}\n";
        echo "Chamados em aberto: " . count($this->chamadosAbertos) . "\n";
    }
}


// --- USANDO ---
$tec  = new Tecnico('Carlos Silva', 'carlos@helpdesk.com', '123456', 'Redes', 'Senior');
$cli  = new Cliente('Ana Lima', 'ana@empresa.com', 'abc123', 'Tech Ltda', '12.345.678/0001-90');


$tec->exibirPerfil();
$cli->abrirChamado(1001);
$tec->registrarAtendimento(1001);
