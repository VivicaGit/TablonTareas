<?php

class TareaRepaso extends Tarea {

    private $comentario;

    public function __construct($titulo, $asignatura, $descripcion, $fecha, $comentario, $id=0 ) {
        parent::__construct($id, $titulo, $asignatura, $descripcion, $fecha);
        $this->comentario = $comentario;
    }

    // polimorfismo
    public function getEtiqueta() {
        return "Repaso";
    }

    public function getComentario() { return $this->comentario; }
    public function setComentario($comentario) { $this->comentario = $comentario; }
}
