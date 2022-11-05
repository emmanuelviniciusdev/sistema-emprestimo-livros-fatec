<?php

class ConexaoBD
{
    private $host = "p:172.19.0.2:3306";
    private $usuario = "root";
    private $senha = "root";
    private $banco = "db_biblioteca";
    private $porta = 3006;

    public $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->usuario, $this->senha, $this->banco, $this->porta);
    }
}
