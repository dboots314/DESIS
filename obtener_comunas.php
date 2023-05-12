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

// obtener el id de la region desde la solicitud ajax
$region_id = $_GET['region_id'];

// consulta SQL para obtener las comunas de la region seleccionada
$sql = "SELECT id_comuna, nombre_comuna FROM comunas WHERE id_region = $region_id ORDER BY nombre_comuna ASC";

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

// crear un array con los nombres de los comunas
$comunas = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $comunas[] = array(
        'id' => $fila['id_comuna'],
        'nombre' => $fila['nombre_comuna']
    );
}

// cerrar la conexión a la base de datos
mysqli_close($conn);

// devolver el array como JSON
echo json_encode($comunas);
?>