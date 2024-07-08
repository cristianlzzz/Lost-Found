<?php
// Incluye el archivo de conexión a la base de datos
include('conexión.php');

// Inicializa las variables de error
$errorCorreo = "";
$errorMatricula = "";

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $carrera = $_POST['carrera']; // Captura la carrera seleccionada
    $correo = $_POST['correo'];
    $matricula = $_POST['matricula'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encripta la contraseña

    // Verifica si el correo tiene el dominio permitido
    if (strpos($correo, '@utrivieramaya.edu.mx') === false) {
        // Si el correo no tiene el dominio permitido, estable
        //ce el mensaje de error del correo
        $errorCorreo = "Correo Inválido.";
    }

    // Verifica si el correo coincide con la matrícula
    if (strpos($correo, $matricula) === false) {
        // Si el correo no coincide con la matrícula, establece el mensaje de error de la matrícula
        $errorMatricula = "El correo y la matrícula no coinciden.";
    }

    // Si no hay errores, inserta los datos en la base de datos
    if (empty($errorCorreo) && empty($errorMatricula)) {
        // Inserta los datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, carrera, correo, matricula, contraseña) VALUES ('$nombre', '$carrera', '$correo', '$matricula', '$contraseña')";

        if (mysqli_query($conn, $sql)) {
            // Redirige al usuario al formulario de inicio de sesión
            header("Location: ../php/login.php");
            exit; // Termina el script después de redirigir
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/registro_usuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>

<div class="container">
    <h2>Registro de Usuario</h2>
    <form action="../php/registro_usuario.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="carrera">Seleccione su carrera:</label>
            <select id="carrera" name="carrera" class="form-select" required>
                <option value="">Selecciona una carrera</option>
                <option value="Administración">Administración</option>
                <option value="Turismo">Turismo</option>
                <option value="Gatronomía">Gatronomía</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Terapia Física">Terapia Física</option>
                <option value="Contaduría">Contaduría</option>
                <option value="TIC Entornos Virtuales">TIC Entornos Virtuales</option>
                <option value="TIC Soft. Multiplataforma">TIC Soft. Multiplataforma</option>
                <option value="Lic. Gestión y Desarrollo Turístico">Lic. Gestión y Desarrollo Turístico</option>
                <option value="Lic. Gastronomía">Lic. Gastronomía</option>
                <option value="Lic. Gestión del Capital Humano">Lic. Gestión del Capital Humano</option>
                <option value="Lic. Contaduría">Lic. Contaduría</option>
                <option value="Ing. Desarrollo y Gestión de Software">Ing. Desarrollo y Gestión de Software</option>
                <option value="Ing. Mantenimiento">Ing. Mantenimiento</option>
                <option value="Ing Entornos Virtuales y Negocios Digitales">Ing Entornos Virtuales y Negocios Digitales</option>
            </select>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
            <?php if ($errorCorreo): ?>
                <div class="alert"><?php echo $errorCorreo; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>
            <?php if ($errorMatricula): ?>
                <div class="alert"><?php echo $errorMatricula; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Registrarse">
        </div>
    </form>
</div>

</body>
</html>
