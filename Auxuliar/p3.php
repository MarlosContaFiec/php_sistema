<?php


abstract class Notificacao
{
    abstract public function enviar(string $destinatario, string $mensagem): void;


    // Método concreto compartilhado
    protected function formatarMensagem(string $msg): string
    {
        return "[" . date('d/m/Y H:i') . "] " . $msg;
    }
}


class NotificacaoEmail extends Notificacao
{
    public function enviar(string $destinatario, string $mensagem): void
    {
        $msg = $this->formatarMensagem($mensagem);
        echo "📧 Email para {$destinatario}: {$msg}\n";
    }
}


class NotificacaoSMS extends Notificacao
{
    public function enviar(string $destinatario, string $mensagem): void
    {
        $msg = $this->formatarMensagem($mensagem);
        echo "📱 SMS para {$destinatario}: {$msg}\n";
    }
}


class NotificacaoWhatsApp extends Notificacao
{
    public function enviar(string $destinatario, string $mensagem): void
    {
        $msg = $this->formatarMensagem($mensagem);
        echo "💬 WhatsApp para {$destinatario}: {$msg}\n";
    }
}


// Polimorfismo: a função não sabe QUAL tipo de notificação vai receber
// Ela sabe apenas que é UMA Notificacao e que tem o método enviar()
function disparar(Notificacao $n, string $para, string $msg): void
{
    $n->enviar($para, $msg);
}


$canais = [
    new NotificacaoEmail(),
    new NotificacaoSMS(),
    new NotificacaoWhatsApp(),
];


foreach ($canais as $canal) {
    disparar($canal, 'carlos@helpdesk.com', 'Novo chamado #1025 aberto!');
}
