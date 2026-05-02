<!DOCTYPE html>
<html>
<head>
    <title>Tablón de Tareas DAW</title>
</head>
<body style="background-color: <?= $colorFondo ?>">

    <div style="background:#eee; padding:10px; margin-bottom:20px;">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            Hola, <b><?= $_SESSION['usuarioEmail'] ?></b> |
            <a href="index.php?accion=preferencias">Color de fondo</a> |
            <a href="index.php?accion=logout">Cerrar sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login">Iniciar sesión</a> |
            <a href="index.php?accion=alta">Registrarse</a>
        <?php endif; ?>
    </div>

    <h1>Tablón de Tareas DAW</h1>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="index.php?accion=crear">+ Nueva tarea</a><br><br>
    <?php endif; ?>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Título</th>
            <th>Asignatura</th>
            <th>Descripción</th>
            <th>Fecha entrega</th>
            <th>Días restantes</th>
            <th>Extra</th>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>

        <?php foreach ($tareas as $tarea): ?>
            <?php
                $dias = $tarea->getDiasRestantes();
                // Rojo si quedan 3 días o menos (o ya pasó)
                $colorFila = ($dias <= 3) ? 'background-color:#ffcccc;' : '';
            ?>
            <tr style="<?= $colorFila ?>">
                <td><?= $tarea->getId() ?></td>
                <td><?= $tarea->getEtiqueta() ?></td>
                <td><?= $tarea->getTitulo() ?></td>
                <td><?= $tarea->getAsignatura() ?></td>
                <td><?= $tarea->getDescripcion() ?></td>
                <td><?= $tarea->getFecha() ?></td>
                <td><?= $dias ?> días</td>
                <td>
                    <?php if ($tarea instanceof TareaEvaluable): ?>
                        Nota mín: <?= $tarea->getNotaMinima() ?>
                    <?php else: ?>
                        <?= $tarea->getComentario() ?>
                    <?php endif; ?>
                </td>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <td>
                        <a href="index.php?accion=editar&id=<?= $tarea->getId() ?>">Editar</a>
                        <a href="index.php?accion=eliminar&id=<?= $tarea->getId() ?>">Eliminar</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
