<?php /** @var string $colorFondo */ ?>
<?php /** @var object $tarea */ ?>
<?php /** @var bool $esOscuro */ ?>
<?php $esOscuro = $colorFondo === '#1a1a1a'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarea</title>
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

    <h1>Editar Tarea</h1>

    <form method="POST">
        Título:<br>
        <input type="text" name="titulo" value="<?= $tarea->getTitulo() ?>" required><br><br>

        Asignatura:<br>
        <input type="text" name="asignatura" value="<?= $tarea->getAsignatura() ?>" required><br><br>

        Descripción:<br>
        <textarea name="descripcion"><?= $tarea->getDescripcion() ?></textarea><br><br>

        Fecha de entrega:<br>
        <input type="date" name="fecha" value="<?= $tarea->getFecha() ?>" required><br><br>

        <?php if ($tarea instanceof TareaEvaluable): ?>
            Nota mínima:<br>
            <input type="number" step="0.01" name="notaMinima" value="<?= $tarea->getNotaMinima() ?>" required><br><br>
        <?php endif; ?>

        <?php if ($tarea instanceof TareaRepaso): ?>
            Comentario:<br>
            <input type="text" name="comentario" value="<?= $tarea->getComentario() ?>"><br><br>
        <?php endif; ?>

        <button type="submit">Actualizar</button>
    </form>

    <br><a href="index.php">Volver</a>
</body>
</html>
