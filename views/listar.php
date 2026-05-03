<?php /** @var string $colorFondo */ ?>
<?php /** @var array $tareas */ ?>
<?php /** @var bool $esOscuro */ ?>
<?php $esOscuro = $colorFondo === '#1a1a1a'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tablón de Tareas DAW</title>
    <style>
    table { border-collapse: collapse; }
    th { background-color: <?= $esOscuro ? '#444' : '#ddd' ?>; }
    a { color: <?= $esOscuro ? '#90c8ff' : 'blue' ?>; }
    </style>
</head>
<body style="background-color: <?= $colorFondo ?>; color: <?= $esOscuro ? '#f0f0f0' : '#000000' ?>;">

    <div style="background: <?= $esOscuro ? '#333' : '#eee' ?>; padding:10px; margin-bottom:20px;">
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
            <th>Detalle</th>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>

        <?php foreach ($tareas as $tarea): ?>
            <?php
                $dias = $tarea->getDiasRestantes();
                $colorFila = ($dias <= 3) ? 'background-color:#ffcccc; color:#000000;' : '';
            ?>
            <tr>
                <td><?= $tarea->getId() ?></td>
                <td><?= $tarea->getEtiqueta() ?></td>
                <td><?= $tarea->getTitulo() ?></td>
                <td><?= $tarea->getAsignatura() ?></td>
                <td style="white-space: pre-wrap; max-width:200px"><?= $tarea->getDescripcion() ?></td>
                <td><?= $tarea->getFecha() ?></td>
                <td style="<?= $colorFila ?>"><?= $dias ?> días</td>
                <td>
                    <?php if ($tarea instanceof TareaEvaluable): ?>
                        <b>Nota mínima:</b> <?= $tarea->getNotaMinima() ?>
                    <?php else: ?>
                        <b>Comentario:</b> <?= $tarea->getComentario() ?>
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
