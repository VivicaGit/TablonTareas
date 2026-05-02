<!DOCTYPE html>
<html>
<head><title>Preferencias</title></head>
<body style="background-color: <?= $colorFondo ?>">

    <h1>Color de fondo</h1>

    <form method="POST">
        <label>
            <input type="radio" name="colorFondo" value="#ffffff"
                <?= ($colorFondo === '#ffffff') ? 'checked' : '' ?>> Blanco
        </label><br>
        <label>
            <input type="radio" name="colorFondo" value="#d0e8ff"
                <?= ($colorFondo === '#d0e8ff') ? 'checked' : '' ?>> Azul claro
        </label><br>
        <label>
            <input type="radio" name="colorFondo" value="#d0ffd8"
                <?= ($colorFondo === '#d0ffd8') ? 'checked' : '' ?>> Verde claro
        </label><br><br>

        <button type="submit">Guardar preferencia</button>
    </form>

    <br><a href="index.php">Volver</a>
</body>
</html>
