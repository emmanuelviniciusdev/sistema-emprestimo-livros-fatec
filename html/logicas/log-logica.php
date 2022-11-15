<?php

require_once(__DIR__ . '/../modelos/Usuario.php');
require_once(__DIR__ . '/../modelos/Livro.php');
require_once(__DIR__ . '/../modelos/Emprestimo.php');

date_default_timezone_set('America/Sao_Paulo');

class LogLogica
{
    private Usuario $usuarioLogado;

    public function __construct(Usuario $usuarioLogado)
    {
        $this->usuarioLogado = $usuarioLogado;
    }

    public function registrarLogin()
    {
        $log = $this->montarLog("realizou login no sistema");
        
        $this->salvarLogArquivoTexto($log);
    }

    public function registrarLogout()
    {
        $log = $this->montarLog("realizou logout do sistema");
        
        $this->salvarLogArquivoTexto($log);
    }

    public function registrarNovoEmprestimo(Emprestimo $emprestimo)
    {
        $usuarioEmprestimo = $emprestimo->getUsuario();
        $livroEmprestimo = $emprestimo->getLivro();

        $emailUsuarioEmprestimo = $usuarioEmprestimo->getEmail();
        $informacoesLivroEmprestimo = "{$livroEmprestimo->getTitulo()}, {$livroEmprestimo->getAutor()} ({$livroEmprestimo->getAno()})";

        $log = $this->montarLog("registrou um novo empréstimo ($informacoesLivroEmprestimo) ao usuário com e-mail $emailUsuarioEmprestimo");

        $this->salvarLogArquivoTexto($log);
    }

    public function registrarDevolucaoEmprestimo(Emprestimo $emprestimo)
    {
        $usuarioEmprestimo = $emprestimo->getUsuario();
        $livroEmprestimo = $emprestimo->getLivro();

        $emailUsuarioEmprestimo = $usuarioEmprestimo->getEmail();
        $informacoesLivroEmprestimo = "{$livroEmprestimo->getTitulo()}, {$livroEmprestimo->getAutor()} ({$livroEmprestimo->getAno()})";

        $log = $this->montarLog("registrou a devolução de um empréstimo ($informacoesLivroEmprestimo) feito pelo usuário com e-mail $emailUsuarioEmprestimo");

        $this->salvarLogArquivoTexto($log);
    }

    public function registrarInsercaoUsuario(Usuario $usuario)
    {
        $emailUsuario = $usuario->getEmail();
        
        $log = $this->montarLog("registrou um novo usuário com e-mail $emailUsuario");
        
        $this->salvarLogArquivoTexto($log);
    }

    public function registrarExclusaoUsuario(Usuario $usuario)
    {
        $emailUsuario = $usuario->getEmail();
       
        $log = $this->montarLog("deletou um usuário com e-mail $emailUsuario");
        
        $this->salvarLogArquivoTexto($log);
    }

    private function salvarLogArquivoTexto(string $log)
    {
        $arquivo = fopen(__DIR__ . '/../logs/acoes-sistema.txt', 'a');

        fwrite($arquivo, $log);
        fwrite($arquivo, "\n");

        fclose($arquivo);
    }

    private function montarLog(string $acao)
    {
        $dataHoraAtual = date('d/m/Y H:i:s');
        $emailUsuarioLogado = $this->usuarioLogado->getEmail();
        $permissaoUsuarioLogado = $this->usuarioLogado->getPermissao();

        return "[$dataHoraAtual] $emailUsuarioLogado ($permissaoUsuarioLogado) $acao";
    }
}
