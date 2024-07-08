<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/perfil.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Usuario</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="https://utrivieramaya.edu.mx/">
        <img src="../img/Logo-UTRM.png" width="50" height="50" alt="">
    </a>
    <a class="navbar-brand" href="../html/index.html" target="_self">
        TA KAXKIK?
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="../html/objetos_perdidos.html">
                Objetos Perdidos
            </a>
            <a class="nav-item nav-link active" href="../html/objetos_encontrados.html">
                Objetos Encontrados
            </a>
            <a class="nav-item nav-link active" href="../html/acerca_de.html">
                Acerca de
            </a>
            <a class="nav-item nav-link active" href="../html/contacto.html">
                Contacto
            </a>
            <a class="nav-item nav-link active" href="../php/perfil.php">
                Perfil
            </a>
        </div>
    </div>
</nav>
<div class="container">
    <h2>Datos del Usuario</h2>
    <?php
    // Inicia la sesión
    session_start();

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['id'])) {
        // Si el usuario no ha iniciado sesión, redirige al formulario de inicio de sesión
        header("Location: ../php/login.php");
        exit();
    }

    // Incluye el archivo de conexión a la base de datos
    include('../php/conexión.php');

    // Obtiene el ID del usuario que ha iniciado sesión
    $id_usuario = $_SESSION['id'];

    // Consulta los datos del usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
    $resultado = mysqli_query($conn, $sql);

    // Verifica si se encontraron resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Extrae los datos del usuario
        $usuario = mysqli_fetch_assoc($resultado);
        ?>
        <table>
            <tr>
                <th>Nombre</th>
                <td><?php echo $usuario['nombre']; ?></td>
            </tr>
            <tr>
                <th>Carrera</th>
                <td><?php echo $usuario['carrera']; ?></td> <!-- Agrega esta fila para mostrar la carrera -->
            </tr>
            <tr>
                <th>Correo</th>
                <td><?php echo $usuario['correo']; ?></td>
            </tr>
            <tr>
                <th>Matrícula</th>
                <td><?php echo $usuario['matricula']; ?></td>
            </tr>
            <!-- Agrega más campos según sea necesario -->
        </table>
        <?php
    } else {
        // Si no se encontraron resultados, muestra un mensaje de error
        echo "Error: No se encontraron datos del usuario.";
    }
    ?>
</div>

</body>
</html>
