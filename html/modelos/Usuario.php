<?php

class Usuario
{
    private int $id;
    private string $email;
    private int $nivel;

    public function __construct(int $id, string $email, int $nivel)
    {
        $this->id = $id;
        $this->email = $email;
        $this->nivel = $nivel;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * NÍVEL 1 => ALUNO
     * NÍVEL 2 => BIBLIOTECÁRIO
     * NÍVEL 3 => ADMINISTRADOR
     */
    public function getPermissao()
    {
        if ($this->nivel == 1) {
            return "ALUNO";
        } else if ($this->nivel == 2) {
            return "BIBLIOTECÁRIO";
        } else if ($this->nivel == 3) {
            return "ADMINISTRADOR";
        }
    }
}
