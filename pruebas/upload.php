<?php
// Verifica si se ha enviado algún archivo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
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

    $archivo_nombre = $_FILES["imagen"]["name"];
    $archivo_tipo = $_FILES["imagen"]["type"];
    $archivo_temp = $_FILES["imagen"]["tmp_name"];
    $archivo_tamaño = $_FILES["imagen"]["size"];

    // Verifica si el archivo es una imagen
    $permitidos = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($archivo_tipo, $permitidos)) {
        // Lee el contenido del archivo
        $contenido_imagen = file_get_contents($archivo_temp);

        // Escapa el contenido para evitar inyecciones SQL
        $contenido_imagen = $conn->real_escape_string($contenido_imagen);

        // Guarda la imagen en la base de datos
        $sql = "INSERT INTO objetos_perdidos (Imagen, tipo_imagen) VALUES ('$contenido_imagen', '$archivo_tipo')";
        if ($conn->query($sql) === TRUE) {
            echo "La imagen se ha subido correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Solo se permiten archivos de imagen JPEG, PNG o GIF.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    echo "No se ha enviado ninguna imagen.";
}
?>
