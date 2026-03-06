<!-- Ex. 06 — Repositório em Memória — Chamados
Com base no exemplo da Seção 7 da aula, implemente o ChamadoRepositorioMemoria
que implementa ChamadoRepositorioInterface:
   buscarPorId, buscarTodos, salvar, atualizar, deletar (da interface base),
   buscarPorStatus, buscarPorTecnico, buscarPorCliente.
Use a classe Chamado criada nas aulas anteriores (com status, titulo, etc).
Crie o método contarPorStatus(): array que retorna um array associativo
   com ['aberto' => 3, 'em_andamento' => 1, ...].
Popule o repositório com 6 chamados (status variados, técnicos variados).
Demonstre todos os métodos de busca e exiba o relatório contarPorStatus().
 -->
<!-- Ex. 07 — Interface CanalNotificacao — Helpdesk Completo
Retome o exemplo da Seção 6 (CanalNotificacao) e expanda-o:
Adicione à interface o método: getHistoricoEnvios(): array.
Implemente EmailChannel, SmsChannel e SlackChannel com armazenamento
interno dos envios realizados (array com ['destinatario', 'mensagem', 'data']).
Crie a interface Logavel com: log(string $nivel, string $mensagem): void
   e getLogs(): array. Níveis: 'INFO', 'WARN', 'ERROR'.
Faça o ServicoNotificacao implementar Logavel, registrando log a cada
notificação enviada (sucesso → INFO, falha → ERROR).
Monte um cenário com 5 notificações disparadas por todos os canais.
Ao final, exiba: histórico por canal e log completo do ServicoNotificacao. -->

<!-- 🏆 DESAFIO 01 — Arquitetura Completa de Repositórios do Helpdesk
Construa a camada de persistência completa do Helpdesk Pro usando interfaces:
1) Defina a interface base RepositorioInterface com os 5 métodos CRUD.
2) Defina UsuarioRepositorioInterface extends RepositorioInterface com:
   → buscarPorEmail(string $email): ?Usuario
   → buscarTecnicosDisponiveis(): array
   → contarPorPermissao(): array
3) Defina ChamadoRepositorioInterface extends RepositorioInterface com:
   → buscarPorStatus(string $status): array
   → buscarAbertosDoCliente(int $idCliente): array
   → buscarAtribuidosAoTecnico(int $idTecnico): array
   → estatisticas(): array (retorna total, por status, por tipo)
4) Implemente UsuarioRepositorioMemoria e ChamadoRepositorioMemoria.
5) Crie a classe ServicoChamado que recebe NO CONSTRUTOR:
   → ChamadoRepositorioInterface $chamadoRepo
   → UsuarioRepositorioInterface $usuarioRepo
   Implemente os métodos:
   → abrirChamado(int $idCliente, string $titulo, string $descricao): Chamado
   → atribuirTecnico(int $idChamado, int $idTecnico): void
   → fecharChamado(int $idChamado, string $resolucao): void
   → gerarRelatorio(): void (exibe estatísticas completas)
6) Monte um cenário com 3 técnicos, 4 clientes e 8 chamados.
   Atribua técnicos, feche alguns chamados e chame gerarRelatorio().
   O código deve funcionar sem erros e exibir dados coerentes. -->

