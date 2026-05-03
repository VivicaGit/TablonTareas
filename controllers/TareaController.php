<?php

class TareaController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $tareas = $this->gestor->listar();
        $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';
        $esOscuro = $colorFondo === '#1a1a1a';
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            $titulo = $_POST['titulo'];
            $asignatura = $_POST['asignatura'];
            $descripcion = $_POST['descripcion'];
            $fecha = $_POST['fecha'];

            if ($tipo === 'TareaEvaluable') {
                $tarea = new TareaEvaluable($titulo, $asignatura, $descripcion, $fecha, $_POST['notaMinima']);
            } else {
                $tarea = new TareaRepaso($titulo, $asignatura, $descripcion, $fecha, $_POST['comentario']);
            }

            $this->gestor->agregar($tarea);
            header("Location: index.php");
            exit;
        }
        $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';
        include "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $tarea = $this->gestor->buscar($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tarea->setTitulo($_POST['titulo']);
            $tarea->setAsignatura($_POST['asignatura']);
            $tarea->setDescripcion($_POST['descripcion']);
            $tarea->setFecha($_POST['fecha']);

            if ($tarea instanceof TareaEvaluable) {
                $tarea->setNotaMinima($_POST['notaMinima']);
            } else {
                $tarea->setComentario($_POST['comentario']);
            }

            $this->gestor->actualizar($tarea);
            header("Location: index.php");
            exit;
        }
        $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';
        include "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}
