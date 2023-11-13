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
$id_libro = $_POST['id_libro'];

$sql = "UPDATE `libro` SET  `ruta_archivo`='$ruta_archivo' , `titulo`= '$titulo', `id_autor`='$id_autor',  `fecha_publicacion`='$fecha_publicacion', `genero`='$genero' , `sipnosis`= '$sipnosis', `num_paginas`='$num_paginas',  `idioma`='$idioma' WHERE id_libro='$id_libro' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>