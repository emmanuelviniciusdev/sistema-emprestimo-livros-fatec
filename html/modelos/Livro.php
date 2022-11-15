<?php

class Livro
{
    private int $id;
    private ?string $autor;
    private ?string $titulo;
    private ?string $area;
    private ?int $ano;
    private ?string $tombo;

    public function __construct(int $id, ?string $autor, ?string $titulo, ?string $area, ?int $ano, ?string $tombo)
    {
        $this->id = $id;
        $this->autor = $autor;
        $this->titulo = $titulo;
        $this->area = $area;
        $this->ano = $ano;
        $this->tombo = $tombo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function getTombo()
    {
        return $this->tombo;
    }

}
