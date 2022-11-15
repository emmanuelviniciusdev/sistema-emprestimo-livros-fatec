<?php

require_once(__DIR__ . '/../banco_de_dados/conexao_bd.php');

class EmprestimoLogica
{
    private $conexaoBD;

    public function __construct()
    {
        $this->conexaoBD = new ConexaoBD();
    }

    public function obterEmprestimosVigentesTodosUsuarios()
    {
        $query = $this->conexaoBD->mysqli->query("
            SELECT * FROM tb_emprestimo
            WHERE data_devolucao IS NULL
        ");

        $resultados = $query->fetch_all(MYSQLI_ASSOC);

        $emprestimos = [];

        foreach ($resultados as $r) {
            $emprestimo = new Emprestimo(
                $r['id_livro'],
                $r['id_usuario'],
                $r['data_emprestimo'],
                $r['data_devolucao'],
            );

            array_push($emprestimos, $emprestimo);
        }

        return $emprestimos;
    }

    public function obterEmprestimosVigentesUsuario(int $idUsuario)
    {
        $query = $this->conexaoBD->mysqli->query("
            SELECT * FROM tb_emprestimo
            WHERE id_usuario = $idUsuario AND data_devolucao IS NULL
        ");

        $resultados = $query->fetch_all(MYSQLI_ASSOC);

        $emprestimos = [];

        foreach ($resultados as $r) {
            $emprestimo = new Emprestimo(
                $r['id_livro'],
                $r['id_usuario'],
                $r['data_emprestimo'],
                $r['data_devolucao'],
            );

            array_push($emprestimos, $emprestimo);
        }

        return $emprestimos;
    }
}
