<?php

class TareaEvaluable extends Tarea {

    private $notaMinima;

    public function __construct($titulo, $asignatura, $descripcion, $fecha, $notaMinima, $id=0 ) {
        parent::__construct($id, $titulo, $asignatura, $descripcion, $fecha);
        $this->notaMinima = $notaMinima;
    }

    // polimorfismo
    public function getEtiqueta() {
        return "Evaluable";
    }

    public function getNotaMinima() { return $this->notaMinima; }
    public function setNotaMinima($notaMinima) { $this->notaMinima = $notaMinima; }
}
