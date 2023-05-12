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

// obtener los datos del cuerpo de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// obtener los valores de los campos
$nombre = $data['nombre'];
$alias = $data['alias'];
$rut = $data['rut'];
$email = $data['email'];
$region = $data['region'];
$comuna = $data['comuna'];
$candidato = $data['candidato'];
$opcion1 = boolval($data['opcion1']) ? 1 : 0;
$opcion2 = boolval($data['opcion2']) ? 1 : 0;
$opcion3 = boolval($data['opcion3']) ? 1 : 0;
$opcion4 = boolval($data['opcion4']) ? 1 : 0;

// consulta SQL para buscar el rut en la tabla
$sql = "SELECT COUNT(*) FROM votaciones WHERE rut = '$rut'";

// ejecutar la consulta
$result = mysqli_query($conn, $sql);

// obtener el resultado de la consulta
$count = mysqli_fetch_array($result)[0];

// si el contador es cero, el rut no existe en la tabla, se puede insertar
if ($count == 0) {
    // consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO votaciones (nombre, alias, rut, email, region, comuna, candidato, opcion_web, opcion_tv, opcion_redes_sociales, opcion_amigo) VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', $opcion1, $opcion2, $opcion3, $opcion4)";

    // ejecutar la consulta y verificar si se guardaron los datos correctamente
    if (mysqli_query($conn, $sql)) {
        $response = array('status' => 'success', 'message' => 'Los datos se han guardado correctamente en la tabla');
    } else {
        $response = array('status' => 'error', 'message' => mysqli_error($conn));
    }
} else {
    // el rut ya existe en la tabla, no se puede insertar
    $response = array('status' => 'error', 'message' => 'El rut ya se encuentra en la base de datos');
}

// cerrar la conexión a la base de datos
mysqli_close($conn);

// devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>