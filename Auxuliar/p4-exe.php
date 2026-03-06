<!-- Ex. 06 — Abstração no Helpdesk — Notificações
Crie a classe abstrata Notificacao com: destinatario, assunto e mensagem.
Declare o método abstrato enviar(): bool.
Implemente o método concreto registrarEnvio(): void que exibe log com data/hora.
Crie as subclasses: NotificacaoEmail, NotificacaoSMS e NotificacaoPush.
Cada enviar() deve simular o envio imprimindo uma mensagem específica do canal
e retornar true (sucesso simulado).
Crie a classe GerenciadorNotificacoes com um array de Notificacao.
Implemente dispararTodas(): void que chama enviar() e registrarEnvio() em cada.
Teste com pelo menos 2 instâncias de cada tipo adicionadas ao gerenciador.
 -->

 <!-- Ex. 07 — Integração com o Projeto — Usuário Abstrato Completo
Refatore (reescreva melhorado) o código da aula anterior:
Torne a classe Usuario abstrata com os métodos abstratos:
   → getPermissao(): string — retorna nível de acesso do usuário.
   → getAcoes(): array — retorna lista de ações permitidas ao tipo.
Mantenha os métodos concretos: verificarSenha(), getId(), getNome(), getEmail().
Recrie as classes Tecnico e Cliente herdando de Usuario.
Tecnico: getPermissao() retorna 'tecnico', getAcoes() retorna
   ['atender_chamado', 'fechar_chamado', 'visualizar_relatorio'].
Cliente: getPermissao() retorna 'cliente', getAcoes() retorna
   ['abrir_chamado', 'acompanhar_chamado', 'avaliar_atendimento'].
Crie a função verificarAcesso(Usuario $usuario, string $acao): bool
que verifica se a ação está no array de ações do usuário.
Demonstre com ao menos 3 verificações de acesso. -->

<!-- 🏆 — Sistema de Helpdesk — Chamados com Herança
Construa uma hierarquia completa de chamados para o projeto Helpdesk Pro:


1) Classe abstrata Chamado com atributos:
   → protected: id (auto-incremento), titulo, descricao, status, dataCriacao.
   → Métodos abstratos: calcularPrioridade(): string e getTipo(): string.
   → Métodos concretos: abrir(), fechar(), reabrirChamado(), exibirDetalhes().
   → fechar() só permite fechamento se status for 'aberto' ou 'em_andamento'.
2) Subclasse ChamadoIncidente extends Chamado:
   → atributos: sistemaAfetado e impacto ('baixo'|'medio'|'alto'|'critico').
   → calcularPrioridade(): critico → 'URGENTE'; alto → 'ALTA'; demais → 'NORMAL'.
   → getTipo() retorna 'INCIDENTE'.
3) Subclasse ChamadoSolicitacao extends Chamado:
   → atributos: categoriaSolicitacao e aprovadorNecessario (bool).
   → calcularPrioridade(): se aprovacao necessaria → 'ALTA'; senão → 'NORMAL'.
   → getTipo() retorna 'SOLICITACAO'.
4) Crie a classe Fila com um array de Chamado.
   → adicionarChamado(Chamado $c): void.
   → listarPorPrioridade(): void (exibe todos ordenados por prioridade).
   → contarPorTipo(): void (exibe total de incidentes e solicitações).
5) Monte uma fila com 5 chamados misturados e demonstre todos os métodos.
 -->


