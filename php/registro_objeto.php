<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $tipo_objeto = $_POST['tipo_objeto'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion']; // Recoge los datos de ubicación

    // Conexión a la base de datos (reemplaza los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ta_kaxkik";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Procesa cada archivo cargado
    for ($i = 0; $i < count($_FILES['imagen']['name']); $i++) {
        $imagen_nombre = $_FILES['imagen']['name'][$i];
        $imagen_tipo = $_FILES['imagen']['type'][$i];
        $imagen_temp = $_FILES['imagen']['tmp_name'][$i];
        $imagen_contenido = addslashes(file_get_contents($imagen_temp)); // Lee el contenido del archivo

        // Inserta los datos en la tabla objetos_perdidos
        $sql = "INSERT INTO objetos_perdidos (tipo_objeto, marca, descripcion, imagen, tipo_imagen, ubicacion) 
                VALUES ('$tipo_objeto', '$marca', '$descripcion', '$imagen_contenido', '$imagen_tipo', '$ubicacion')"; // Incluye la ubicación en la consulta SQL

        if ($conn->query($sql) === TRUE) {
            // Asegúrate de que no se envíe ninguna salida antes de esta línea
            ob_start();
            header("Location: ../pruebas/index_beta.html");
            exit;
        } else {
            echo "Error al registrar los datos: " . $conn->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
