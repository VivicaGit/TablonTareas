<!DOCTYPE html>
<html>
<head><title>Editar Tarea</title></head>
<body style="background-color: <?= $colorFondo ?>">

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
