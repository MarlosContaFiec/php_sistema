<?php


// ── Contratos de notificação ────────────────────────────────────────
interface CanalNotificacao
{
    public function enviar(string $destinatario, string $mensagem): bool;
    public function getNomeCanal(): string;
}


// ── Três implementações completamente diferentes ──────────────────
class EmailChannel implements CanalNotificacao
{
    public function enviar(string $destinatario, string $mensagem): bool
    {
        echo "📧 E-mail → {$destinatario}: {$mensagem}\n";
        return true;
    }
    public function getNomeCanal(): string { return 'E-mail'; }
}


class SmsChannel implements CanalNotificacao
{
    public function enviar(string $destinatario, string $mensagem): bool
    {
        // SMS tem limite de 160 caracteres
        $msg = substr($mensagem, 0, 160);
        echo "📱 SMS → {$destinatario}: {$msg}\n";
        return true;
    }
    public function getNomeCanal(): string { return 'SMS'; }
}


class SlackChannel implements CanalNotificacao
{
    public function __construct(private string $workspace) {}


    public function enviar(string $destinatario, string $mensagem): bool
    {
        echo "💬 Slack [{$this->workspace}] → #{$destinatario}: {$mensagem}\n";
        return true;
    }
    public function getNomeCanal(): string { return "Slack ({$this->workspace})"; }
}


// ── Serviço de notificação: desacoplado de qualquer implementação ──
class ServicoNotificacao
{
    /** @var CanalNotificacao[] */
    private array $canais = [];


    // Recebe qualquer CanalNotificacao — não sabe qual é
    public function adicionarCanal(CanalNotificacao $canal): void
    {
        $this->canais[] = $canal;
        echo "Canal '{$canal->getNomeCanal()}' registrado.\n";
    }


    public function notificarTodos(string $destinatario, string $mensagem): void
    {
        echo "\n--- Disparando notificações ---\n";
        foreach ($this->canais as $canal) {
            $ok = $canal->enviar($destinatario, $mensagem);
            echo "  [" . ($ok ? 'OK' : 'FALHA') . "] via {$canal->getNomeCanal()}\n";
        }
    }
}


// ── Uso ──────────────────────────────────────────────────────────
$servico = new ServicoNotificacao();
$servico->adicionarCanal(new EmailChannel());
$servico->adicionarCanal(new SmsChannel());
$servico->adicionarCanal(new SlackChannel('helpdesk-ti'));


$servico->notificarTodos(
    'carlos@helpdesk.com',
    'Novo chamado #1025 aberto: Servidor de produção fora do ar!'
);


// Para adicionar WhatsApp? Basta criar WhatsAppChannel implements CanalNotificacao.
// O ServicoNotificacao não precisa de NENHUMA alteração. ← Princípio Aberto/Fechado
