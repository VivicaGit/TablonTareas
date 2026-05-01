<?php

class Tarea {

    protected $titulo;
    protected $asignatura;
    protected $descripcion;
    protected $fecha;
    protected $id;

    public function __construct($titulo, $asignatura, $descripcion, $fecha, $id=0) {
        $this->titulo = $titulo;
        $this->asignatura = $asignatura;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha; 
        $this->id = $id;
    }

    // polimorfismo
    public function getEtiqueta() {
        return "Tarea";
    }

    public function getDiasRestantes() {
        $hoy = new DateTime();
        $entrega = new DateTime($this->fecha);
        $diferencia = $hoy->diff($entrega);
        // si la fecha pasa devuelve negativo
        return $entrega >= $hoy ? $diferencia->days : -$diferencia->days;
    }

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAsignatura() { return $this->asignatura; }
    public function getDescripcion() { return $this->descripcion; }
    public function getFecha() { return $this->fecha; }

    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAsignatura($asignatura) { $this->asignatura = $asignatura; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
}
