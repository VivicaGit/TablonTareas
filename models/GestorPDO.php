<?php

class GestorPDO {

    private $conn;

    public function __construct() {
        // pillar la conexión por el getInstance de Connection
        $this->conn = Connection::getInstance()->getConn();
    }

    // tareas
    
    public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM tareas ORDER BY fecha ASC");
        $stmt->execute();
        
        $tareas = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tareas[] = $this->crearObjetoTarea($fila);
        }
        return $tareas;
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tareas WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fila ? $this->crearObjetoTarea($fila) : null;
    }

    public function agregar($tarea) {
        try {
            if ($tarea instanceof TareaEvaluable) {
                $sql = "INSERT INTO tareas (tipoTarea, titulo, asignatura, descripcion, fecha, notaMinima)
                        VALUES (:tipo, :titulo, :asignatura, :descripcion, :fecha, :notaMinima)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':tipo', 'TareaEvaluable');
                $stmt->bindValue(':notaMinima', $tarea->getNotaMinima() ?: null);
            } else {
                $sql = "INSERT INTO tareas (tipoTarea, titulo, asignatura, descripcion, fecha, comentario)
                        VALUES (:tipo, :titulo, :asignatura, :descripcion, :fecha, :comentario)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':tipo', 'TareaRepaso');
                $stmt->bindValue(':comentario', $tarea->getComentario());
            }

            $stmt->bindValue(':titulo', $tarea->getTitulo());
            $stmt->bindValue(':asignatura', $tarea->getAsignatura());
            $stmt->bindValue(':descripcion', $tarea->getDescripcion());
            $stmt->bindValue(':fecha', $tarea->getFecha());

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizar($tarea) {
        try {
            if ($tarea instanceof TareaEvaluable) {
                $sql = "UPDATE tareas SET titulo=:titulo, asignatura=:asignatura, descripcion=:descripcion,
                        fecha=:fecha, notaMinima=:notaMinima WHERE id=:id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':notaMinima', $tarea->getNotaMinima() ?: null);
            } else {
                $sql = "UPDATE tareas SET titulo=:titulo, asignatura=:asignatura, descripcion=:descripcion,
                        fecha=:fecha, comentario=:comentario WHERE id=:id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':comentario', $tarea->getComentario());
            }

            $stmt->bindValue(':id', $tarea->getId());
            $stmt->bindValue(':titulo', $tarea->getTitulo());
            $stmt->bindValue(':asignatura', $tarea->getAsignatura());
            $stmt->bindValue(':descripcion', $tarea->getDescripcion());
            $stmt->bindValue(':fecha', $tarea->getFecha());

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM tareas WHERE id=:id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    private function crearObjetoTarea($fila) {
        if ($fila['tipoTarea'] === 'TareaEvaluable') {
            return new TareaEvaluable(
                $fila['titulo'], $fila['asignatura'], $fila['descripcion'], $fila['fecha'], $fila['notaMinima'], $fila['id']);
        } else {
            return new TareaRepaso(
                $fila['titulo'], $fila['asignatura'], $fila['descripcion'], $fila['fecha'], $fila['comentario'], $fila['id']);
        }
    }

    // usuarios

    public function registrarUsuario(Usuario $usuario) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO Usuario (email, password) VALUES (:email, :password)");
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function buscarUsuarioPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM Usuario WHERE email = :email LIMIT 1");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fila ? new Usuario($fila['email'], $fila['password'], $fila['id']) : false;
    }
}
