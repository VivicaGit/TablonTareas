CREATE DATABASE TablonTareas;
USE TablonTareas;

CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipoTarea ENUM('TareaEvaluable', 'TareaRepaso') NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    asignatura VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha DATE NOT NULL,

    notaMinima DECIMAL(4,2) NULL,

    comentario VARCHAR(255) NULL
);

CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);