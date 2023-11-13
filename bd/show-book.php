<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM libro ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_libro',
	1 => 'ruta_archivo',
	2 => 'titulo',
	3 => 'id_autor',
	4 => 'fecha_publicacion',
	5 => 'genero',
	6 => 'sipnosis',
	7 => 'num_paginas',
	8 => 'idioma',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE ruta_archivo like '%".$search_value."%'";
	$sql .= " OR titulo like '%".$search_value."%'";
	$sql .= " OR id_autor like '%".$search_value."%'";
	$sql .= " OR fecha_publicacion like '%".$search_value."%'";
	$sql .= " OR genero like '%".$search_value."%'";
	$sql .= " OR sipnosis like '%".$search_value."%'";
	$sql .= " OR num_paginas like '%".$search_value."%'";
	$sql .= " OR idioma like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id_libro desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id_libro'];
	$sub_array[] = $row['ruta_archivo'];
	$sub_array[] = $row['titulo'];
	$sub_array[] = $row['id_autor'];
	$sub_array[] = $row['fecha_publicacion'];
	$sub_array[] = $row['genero'];
	$sub_array[] = $row['sipnosis'];
	$sub_array[] = $row['num_paginas'];
	$sub_array[] = $row['idioma'];
	$sub_array[] = '<a href="javascript:void();" data-id_libro="'.$row['id_libro'].'"  class="btn editbtn" ><i role="button" class="fa-solid fa-user-pen text-primary"></i></a><a href="javascript:void();" data-id_libro="'.$row['id_libro'].'"  class="btn deleteBtn" ><i role="button" class="fa-solid fa-user-xmark text-danger"></i></a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
