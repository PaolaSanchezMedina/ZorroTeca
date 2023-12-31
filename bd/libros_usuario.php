<?php
include 'connection.php';

if(!function_exists('get_product_details')){

    function get_product_details()
    {
        global $con;
        $ret = array();
        $sql = $con->query("SELECT * FROM libro");


        while($ar = mysqli_fetch_assoc($sql))
        {
            $ret[] = $ar;
        }
        return $ret;
    }
}

if(!function_exists('get_product_details_by_id')) {


    function get_product_details_by_id($id){
        global $con;
        $ret=array();
        $sql = $con->query("SELECT * FROM libro WHERE id_libro ='$id'");
        while($ar = mysqli_fetch_assoc($sql)){
            $ret[] = $ar;
        }
        return $ret;
    }
}
if(!function_exists('get_autor_by_id')){
    function get_autor_by_id($autor){
        global $con;
        $ret=array();
        $sql = $con->query("SELECT nombre_autor FROM autor WHERE id_autor ='$autor'");
        while($ar = mysqli_fetch_assoc($sql)){
            $ret[] = $ar;
        }
        return $ret;
    }

}

if(!function_exists('get_books_ordered_by_title')){
    function get_books_ordered_by_title() {
        global $con;
        $sql = "SELECT * FROM libro ORDER BY titulo ASC";
        $result = $con->query($sql);

        $books = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }
}


if(!function_exists('get_books_ordered_by_year_desc')){
    function get_books_ordered_by_year_desc() {
        global $con;
        $sql = "SELECT * FROM libro ORDER BY fecha_publicacion DESC";
        $result = $con->query($sql);

        $books = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

}

if(!function_exists('get_books_ordered_by_year_asc')){
    function get_books_ordered_by_year_asc() {
        global $con;
        $sql = "SELECT * FROM libro ORDER BY fecha_publicacion ASC";
        $result = $con->query($sql);

        $books = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

}

?>