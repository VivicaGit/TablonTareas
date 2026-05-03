<?php $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff'; ?>
<?php $esOscuro = $colorFondo === '#1a1a1a'; ?>
<!DOCTYPE html>
<html>
<head><title>Registro</title></head>
<body style="background-color: <?= $colorFondo ?>; color: <?= $esOscuro ? '#f0f0f0' : '#000000' ?>;">

    <h1>Crear cuenta</h1>

    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required minlength="4"><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <br>
    <a href="index.php?accion=login">Ya tengo cuenta</a> |
    <a href="index.php">Volver</a>

</body>
</html>