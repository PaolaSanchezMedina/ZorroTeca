<?php 
include('connection.php');

$id_libro = $_POST['id_libro'];
$sql = "DELETE FROM libro WHERE id_libro='$id_libro'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>