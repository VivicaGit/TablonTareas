<!DOCTYPE html>
<html>
<head><title>Iniciar Sesión</title></head>
<body>

    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required><br><br>

        <input type="checkbox" name="recordarme"> Recordarme<br><br>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <a href="index.php?accion=alta">Registrarse</a> |
    <a href="index.php">Volver</a>

</body>
</html>
