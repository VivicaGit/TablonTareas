<?php /** @var string $colorFondo */ ?>
<!DOCTYPE html>
<html>
<head><title>Preferencias</title></head>
<?php $esOscuro = $colorFondo === '#1a1a1a'; ?>
<body style="background-color: <?= $colorFondo ?>; color: <?= $esOscuro ? '#f0f0f0' : '#000000' ?>;">

    <h1>Color de fondo</h1>

    <form method="POST">
        <label>
            <input type="radio" name="colorFondo" value="#ffffff"
                <?= ($colorFondo === '#ffffff') ? 'checked' : '' ?>> Claro
        </label><br>
        <label>
            <input type="radio" name="colorFondo" value="#1a1a1a"
                <?= ($colorFondo === '#1a1a1a') ? 'checked' : '' ?>> Oscuro
        </label><br><br>

        <button type="submit">Guardar preferencia</button>
    </form>

    <br><a href="index.php">Volver</a>
</body>
</html>
