<?php
include 'connection.php';


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

function get_product_details_by_id($id){
    global $con;
    $ret=array();
    $sql = $con->query("SELECT * FROM libro WHERE id_libro ='$id'");
    while($ar = mysqli_fetch_assoc($sql)){
        $ret[] = $ar;
    }
    return $ret;
}
function get_autor_by_id($autor){
    global $con;
    $ret=array();
    $sql = $con->query("SELECT nombre_autor FROM autor WHERE id_autor ='$autor'");
    while($ar = mysqli_fetch_assoc($sql)){
        $ret[] = $ar;
    }
    return $ret;
}
?>