<?php

include('connection.php');


$targetName = basename($_FILES["ruta_archivo"]["name"]);
$ruta_destino = '';

 if ($_FILES['ruta_archivo']['error'] === UPLOAD_ERR_OK) {
    $ruta_destino = 'pdfs/' . $_POST['titulo'] . '.pdf';
    if (move_uploaded_file($_FILES['ruta_archivo']['tmp_name'], $ruta_destino)) {
        echo 'Archivo subido correctamente';
    } else {
        echo 'Error al mover el archivo';
    }
} else {
    echo 'Error en la carga del archivo';
}

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
    mysqli_stmt_bind_param($stmt, "ssisssis", $ruta_destino, $titulo, $id_autor, $fecha_publicacion, $genero, $sipnosis, $num_paginas, $idioma);

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
