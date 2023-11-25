<?php
include "bd/libros_usuario.php";

if(isset($_POST['orden'])) {
    $orden = $_POST['orden'];
    
    if ($orden === 'ABC') {
       
        $books = get_books_ordered_by_title();
    } elseif ($orden === 'DESC') {
    
        $books = get_books_ordered_by_year_asc();
    } elseif ($orden === 'ASC') {
    
        $books = get_books_ordered_by_year_desc();
    } else {

        $books = get_product_details();
    }

    if ($books) {
        foreach ($books as $book) {
    
        }
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
?>