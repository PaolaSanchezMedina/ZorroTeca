<?php 
include('connection.php');

$ruta_archivo = $_POST['ruta_archivo'];
$titulo = $_POST['titulo'];
$id_autor = $_POST['id_autor'];
$fecha_publicacion = $_POST['fecha_publicacion'];
$genero = $_POST['genero'];
$sipnosis = $_POST['sipnosis'];
$num_paginas = $_POST['num_paginas'];
$idioma = $_POST['idioma'];

$sql = "INSERT INTO `libro` (`ruta_archivo`,`titulo`,`id_autor`,`fecha_publicacion`,`genero`,`sipnosis`,`num_paginas`,`idioma`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssisssis", $ruta_archivo, $titulo, $id_autor, $fecha_publicacion, $genero, $sipnosis, $num_paginas, $idioma);

    if (mysqli_stmt_execute($stmt)) {
        $data = array(
            'status' => 'true',
        );
        echo json_encode($data);
    } else {
        $data = array(
            'status' => 'false',
        );
        echo json_encode($data);
    }

    mysqli_stmt_close($stmt);
} else {
    $data = array(
        'status' => 'false',
    );
    echo json_encode($data);
}

mysqli_close($con);
?>
