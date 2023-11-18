<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Hoja de estilos css-->
  <link rel="stylesheet" href="css/style.css">
  <!--Icono de la página-->
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <!--Bootstrap 5-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>ZorroTeca</title>
</head>
<body>
<div id="nav-placeholder">
        <nav class="navbar navbar-expand-lg bg-body-orange">

            <div class="container-fluid">
                <a class="navbar-logo" href="#"><img class="img-logo" src="img/zorro.png"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="mostrarlib.php">Libros</a>
                        </li>


                    </ul>
                </div>
                <div>
                    <ul class="navbar-nav">
                    <li class="nav-item li-bg-inicio">
                            <a class="nav-link active" href="login.php">Iniciar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
  <!--CUERPO DE PÁGINA-->

    <?php
    include "bd/libros_usuario.php";
    $products = get_product_details_by_id($_POST["id_libro"]);
    
    foreach ($products as $ap) {
        $name = $ap['titulo'];
        $sino= $ap['sipnosis'];
        $autor= $ap['id_autor'];
        $id= $ap['id_libro'];
        $idioma= $ap['idioma'];
        $numpag= $ap['num_paginas'];
        $ao= $ap['fecha_publicacion'];
        ?>
        
        <div class="vlibro">
            <?php
                
                echo "<object data='pdfs/".$name.".pdf' width='400px' height='600px' style='  border: 1px solid black;' ></object>" ;
            ?>
        </div>
        <div class="tlibro">
        <h1><?php echo $name; ?></h1>

            <?php
    }
    
            $autores=get_autor_by_id($autor);
            foreach($autores as $aut){
                $autor=$aut['nombre_autor'];
            }
    ?>
    <br><?php echo $autor; 
    echo "<br>".$sino;?>
    </div>
</body>
</html>