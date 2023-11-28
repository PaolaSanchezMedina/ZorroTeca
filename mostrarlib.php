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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>ZorroTeca</title>
</head>

<body >
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
                            <a class="nav-link active " href="login.php">Iniciar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>



<h1 >Libros</h1>
    <div clas="mt-12">
        <div class=" d-flex justify-content-end" style="margin-right: 15px;   ">
                <div class="presentacion2 text-left" style="width: 550px;" >
                         <form action="" method="GET">
                            <select id="ordenar" name="ordenar">
                            <option value="Todos">Todo</option>
                            <option value="ABC">Abecedario</option>
                            <option value="DESC">Por año de menor a mayor</option>
                            <option value="ASC">Por año de mayor a menor</option>
                        </select>
                        <input class="btn btn-dark col-3" value="buscar" name="submit" type='submit'></input>
                        </form>
                    </div>
            </div>
        </div>

            <!--fILTRO -->

<?php   $var1="todos";
    include "bd/search_book_order.php";
?>


<div id="aqui">
<ul class="lista-libros">
<?php
    
    include "bd/libros_usuario.php";
    
    if(isset($_GET['ordenar'])){
        $var1 = $_GET['ordenar'];
        // Now you can use $file variable according to your code requirements
    }
    
    if ($var1 === 'ABC') {
       
        $books = get_books_ordered_by_title();

    } elseif ($var1 === 'DESC') {
    
        $books = get_books_ordered_by_year_asc();
    } elseif ($var1 === 'ASC') {
    
        $books = get_books_ordered_by_year_desc();
    } else {

        $books = get_product_details();
    }
        foreach ($books as $ap) {
            $name = $ap['titulo'];
            $autor = $ap['id_autor'];
            $id = $ap['id_libro'];
            ?>
            <li class="elemento-lista-libros" <?php echo "title='$name'" ?>>
                <div class="presentacion1 d-flex-center text-center">
                    <?php echo "<object data='pdfs/" . $name . ".pdf' width='170px' height='170px' style='  border: 1px solid black;' ></object>" ?>
                    <div class="elem">
                        <h5><?php echo $name; ?></h5>
                        
                    </div>
                    <?php
                    $autores = get_autor_by_id($autor);
                    foreach ($autores as $aut) {
                        $autor = $aut['nombre_autor'];
                    }
                    echo $autor; ?>
                    <form method="post" action="vista_libro.php">
                        <input type='hidden' name='id_libro' value='<?php echo $id; ?>'>
                        <input type='submit' value='Ver'>
                    </form>
                </div>
            </li>
            <?php
        }
    
    ?>
</ul>
        
</div>
</body>

</html>