<?php include('connection.php');
$id_libro = $_POST['id_libro'];
$sql = "SELECT * FROM libro WHERE id_libro='$id_libro' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
