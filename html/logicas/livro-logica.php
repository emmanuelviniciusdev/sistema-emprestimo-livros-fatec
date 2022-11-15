<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');
require_once(__DIR__ . '/../modelos/Livro.php');

class LivroLogica
{
    private $conexaoBD;

    public function __construct()
    {
        $this->conexaoBD = new ConexaoBD();
    }

    public function obterTodosLivros()
    {
        $query = $this->conexaoBD->mysqli->query("SELECT * FROM tb_livro");

        $resultados = $query->fetch_all(MYSQLI_ASSOC);

        $livros = [];

        foreach($resultados as $r) {
            $livro = new Livro(
                $r['id'],
                $r['autor'],
                $r['titulo'],
                $r['area'],
                $r['ano'],
                $r['tombo'],
            );

            array_push($livros, $livro);
        }

        return $livros;
    }
}
