<?php
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

// Consulta para obtener las imágenes y la información del formulario
$sql = "SELECT tipo_objeto, marca, descripcion, imagen, tipo_imagen, ubicacion FROM objetos_perdidos";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Muestra los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<div class='imagen-vertical'>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'"/>';
        echo "<div class='informacion'>";
        echo "<h2>Tipo de Objeto: " . $row["tipo_objeto"]. "</h2>";
        echo "<p><strong>Marca:</strong> " . $row["marca"]. "</p>";
        echo "<p><strong>Descripción:</strong> " . $row["descripcion"]. "</p>";
        echo "<p><strong>Ubicación:</strong> " . $row["ubicacion"]. "</p>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No se encontraron registros";
}

$conn->close();
?>
