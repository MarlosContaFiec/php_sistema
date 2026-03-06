<?php


// ── Interfaces independentes ────────────────────────────────────────


interface Exportavel
{
    public function exportarJSON(): string;
    public function exportarCSV(): string;
}


interface Auditavel
{
    public function getCreatedAt(): string;
    public function getUpdatedAt(): string;
    public function getLog(): array;
}


interface Notificavel
{
    public function getDestinatarioNotificacao(): string;
    public function getMensagemNotificacao(): string;
}


// ── Classe que implementa DUAS interfaces ────────────────────────────


class Chamado implements Exportavel, Auditavel
{
    private array  $log       = [];
    private string $createdAt;
    private string $updatedAt;


    public function __construct(
        private int    $id,
        private string $titulo,
        private string $descricao,
        private string $status = 'aberto'
    ) {
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = $this->createdAt;
        $this->log[]     = "Chamado #{$id} criado em {$this->createdAt}";
    }


    public function atualizarStatus(string $novoStatus): void
    {
        $this->status    = $novoStatus;
        $this->updatedAt = date('Y-m-d H:i:s');
        $this->log[]     = "Status alterado para '{$novoStatus}' em {$this->updatedAt}";
    }


    // ── Exportavel ───────────────────────────────────────────────────
    public function exportarJSON(): string
    {
        return json_encode([
            'id'       => $this->id,
            'titulo'   => $this->titulo,
            'descricao'=> $this->descricao,
            'status'   => $this->status,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    public function exportarCSV(): string
    {
        return "{$this->id},{$this->titulo},{$this->descricao},{$this->status}";
    }


    // ── Auditavel ────────────────────────────────────────────────────
    public function getCreatedAt(): string { return $this->createdAt; }
    public function getUpdatedAt(): string { return $this->updatedAt; }
    public function getLog():       array  { return $this->log;       }
}


// ── Função polimórfica: aceita QUALQUER Exportavel ──────────────────
function exportarDados(Exportavel $obj): void
{
    echo "=== JSON ===\n" . $obj->exportarJSON() . "\n";
    echo "=== CSV  ===\n" . $obj->exportarCSV()  . "\n";
}


// ── Função de auditoria: aceita QUALQUER Auditavel ──────────────────
function exibirAuditoria(Auditavel $obj): void
{
    echo "Criado em: " . $obj->getCreatedAt() . "\n";
    echo "Atualizado: " . $obj->getUpdatedAt() . "\n";
    echo "Log:\n";
    foreach ($obj->getLog() as $entrada) {
        echo "  » {$entrada}\n";
    }
}


$chamado = new Chamado(1001, 'Sistema fora do ar', 'Servidor de produção inacessível.');
$chamado->atualizarStatus('em_andamento');


exportarDados($chamado);
exibirAuditoria($chamado);
