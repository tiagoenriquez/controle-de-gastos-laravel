<?php

namespace App\Models;

class LancamentoPorGenero {
    public string $genero;
    public float $soma;

    public function __construct($genero, $soma)
    {
        $this->genero = $genero;
        $this->soma = $soma;
    }
}