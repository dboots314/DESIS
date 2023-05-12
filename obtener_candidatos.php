<?php
// establecer las opciones de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "DESIS";

// conexión a la base de datos
$conn = mysqli_connect($host, $user, $password, $dbname);

// verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// consulta SQL para obtener los nombres de los candidatos
$sql = "SELECT id, nombre FROM candidatos";

// preparar la consulta
$stmt = mysqli_prepare($conn, $sql);

// verificar si la consulta SQL fue preparada exitosamente
if (!$stmt) {
    die("Error de consulta: " . mysqli_error($conn));
}

// ejecutar la consulta y obtener los resultados
if (!mysqli_stmt_execute($stmt)) {
    die("Error al ejecutar la consulta: " . mysqli_stmt_error($stmt));
}
$resultado = mysqli_stmt_get_result($stmt);

// verificar si hay resultados disponibles
if (mysqli_num_rows($resultado) == 0) {
    die("No se encontraron resultados.");
}

// crear un array con los nombres de los candidatos
$candidatos = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $candidatos[] = array(
        'id' => $fila['id'],
        'nombre' => $fila['nombre']
    );
}

// cerrar la conexión a la base de datos
mysqli_close($conn);

// devolver el array como JSON
echo json_encode($candidatos);
?>