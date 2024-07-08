<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Iniciar Sesión
    </title>
</head>
<body>

<?php
// Incluye el archivo de conexión a la base de datos
include('../php/conexión.php');

// Inicializa la sesión
session_start();

// Variable para almacenar el mensaje de error
$error_msg = '';

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_matricula = $_POST['correo_matricula'];
    $contraseña = $_POST['contraseña'];

    // Busca el usuario en la base de datos por correo o matrícula
    $sql = "SELECT * FROM usuarios WHERE correo='$correo_matricula' OR matricula='$correo_matricula'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    // Verifica si se encontró el usuario y la contraseña es correcta
    if ($count == 1 && password_verify($contraseña, $row['contraseña'])) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];

        // Verifica si el correo del usuario es el de administrador
        if ($row['correo'] == 'ta_kaxkik@utrivieramaya.edu.mx') {
            header("location: ../pruebas/index_beta.html"); // Redirige a la página de administrador
        } else {
            header("location: ../html/index.html"); // Redirige a la página de perfil normal
        }
        exit;
    } else {
        // Establece el mensaje de error
        $error_msg = "Correo/Matrícula o Contraseña incorrectos.";
    }
}
?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">
                                Iniciar Sesión
                            </h2>

                            <!-- Muestra el mensaje de error en una alerta si existe -->
                            <?php if ($error_msg) : ?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <?php echo $error_msg; ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="correo_matricula" name="correo_matricula" class="form-control form-control-lg" required>
                                    <label class="form-label" for="correo_matricula">
                                        Correo/Matricula
                                    </label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="contraseña" name="contraseña" class="form-control form-control-lg" required>
                                    <label class="form-label" for="contraseña">
                                        Contraseña
                                    </label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">
                                    Iniciar Sesión
                                </button>
                            </form>
                        </div>

                        <div>
                            <p class="mb-0">
                                No estás registrado?
                                <a href="../php/registro_usuario.php" class="text-white-50 fw-bold">
                                    Registrarse
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
