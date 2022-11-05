<?php

require_once(__DIR__ . '/Usuario.php');
require_once(__DIR__ . '/Livro.php');

class Emprestimo
{
    private int $idLivro;
    private int $idUsuario;
    private string $dataEmprestimo;
    private string $dataDevolucao;
    private Usuario $usuario;
    private Livro $livro;

    public function __construct(int $idLivro, int $idUsuario, string $dataEmprestimo, string $dataDevolucao)
    {
        $this->idLivro = $idLivro;
        $this->idUsuario = $idUsuario;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;

        $this->setUsuario($idUsuario);
        $this->setLivro($idLivro);
    }

    public function getIdLivro()
    {
        return $this->idLivro;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getDataEmprestimo()
    {
        return $this->dataEmprestimo;
    }

    public function getDataDevolucao()
    {
        return $this->dataDevolucao;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getLivro()
    {
        return $this->livro;
    }

    private function setUsuario(int $idUsuario)
    {
        // TODO: Fazer um SELECT do usuário
    }

    private function setLivro(int $idLivro)
    {
        // TODO: Fazer um SELECT do livro
    }
}
