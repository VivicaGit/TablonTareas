<?php /** @var string $colorFondo */ ?>
<?php /** @var bool $esOscuro */ ?>
<?php $esOscuro = $colorFondo === '#1a1a1a'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Nueva Tarea</title>
    <style>
    input, textarea, select { 
        background-color: <?= $esOscuro ? '#333' : '#fff' ?>; 
        color: <?= $esOscuro ? '#f0f0f0' : '#000' ?>;
        border: 1px solid <?= $esOscuro ? '#666' : '#ccc' ?>;
    }
    a { color: <?= $esOscuro ? '#90c8ff' : 'blue' ?>; }
    </style>
</head>
<body style="background-color: <?= $colorFondo ?>; color: <?= $esOscuro ? '#f0f0f0' : '#000000' ?>;">

    <h1>Nueva Tarea</h1>

    <form method="POST">
        Tipo:<br>
        <select name="tipo" required>
            <option value="TareaEvaluable">Evaluable</option>
            <option value="TareaRepaso">Repaso</option>
        </select><br><br>

        Título:<br>
        <input type="text" name="titulo" required><br><br>

        Asignatura:<br>
        <input type="text" name="asignatura" required><br><br>

        Descripción:<br>
        <textarea name="descripcion"></textarea><br><br>

        Fecha de entrega:<br>
        <input type="date" name="fecha" required><br><br>

        Nota mínima (solo evaluables):<br>
        <input type="number" step="0.01" name="notaMinima"><br><br>

        Comentario (solo repaso):<br>
        <input type="text" name="comentario"><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br><a href="index.php">Volver</a>
</body>
</html>
