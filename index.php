<?php include('bd/connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <title>ZorroTeca</title>
  <!--Font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                            <a class="nav-link fs-5 fw-bold" href="libros.php">Libros</a>
                        </li>


                    </ul>
                </div>
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item li-bg-cierre">
                            <a class="nav-link active" href="logout.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--CUERPO DE PÁGINA-->
    <div class="container mt-5">
        <div class="d-flex justify-content-between text-light">
            <h2>Libros</h2>
            <button type="button" class="btn btn-light text-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modal_libros">Nuevo Libro</button>
        </div>
        <!--Tabla-->
        <div class="row">
            <div class="col">
                <div class="tabla mt-2">
                    <table id="tablaLibros" class="table table-striped dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Ruta</th>
                                <th scope="col">Título</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Género</th>
                                <th scope="col">Año de publicación</th>
                                <th scope="col">Sinopsis</th>
                                <th scope="col"># Páginas</th>
                                <th scope="col">Idioma</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <script type="text/javascript">
    //Mostrar libros
    $(document).ready(function() {
      $('#tablaLibros').DataTable({
        language: {
        //Cambia el idioma a español
        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json',
        },
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id_libro', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'bd/show-book.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [9]
          },

        ]
      });
    });
    //Agregar libros
    $(document).on('submit', '#addBook', function(e) {
      e.preventDefault();
      var ruta_archivo = $('#inputRuta').val();
      var titulo = $('#inputTitulo').val();
      var id_autor = $('#inputAutor').val();
      var fecha_publicacion = $('#inputPublicacion').val();
      var genero = $('#inputGenero').val();
      var sipnosis = $('#inputSinopsis').val();
      var num_paginas = $('#inputPaginas').val();
      var idioma = $('#inputIdioma').val();
      if (ruta_archivo != '' && titulo != '' && id_autor != '' && fecha_publicacion != '' && genero != '' && sipnosis != '' && num_paginas != '' && idioma != '') {
        $.ajax({
          url: "bd/add_book.php",
          type: "post",
          data: {
            ruta_archivo: ruta_archivo,
            titulo: titulo,
            id_autor: id_autor,
            fecha_publicacion: fecha_publicacion,
            genero: genero,
            sipnosis: sipnosis,
            num_paginas: num_paginas,
            idioma: idioma
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#tablaLibros').DataTable();
              mytable.draw();
              $('#modal_libros').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Llenar todos los campos');
      }
    });
    //Actualizar Libro
    $(document).on('submit', '#updateBook', function(e) {
      e.preventDefault();
      var ruta_archivo = $('#updateRuta').val();
      var titulo = $('#updateTitulo').val();
      var id_autor = $('#updateAutor').val();
      var fecha_publicacion = $('#updatePublicacion').val();
      var genero = $('#updateGenero').val();
      var sipnosis = $('#updateSinopsis').val();
      var num_paginas = $('#updatePaginas').val();
      var idioma = $('#updateIdioma').val();

      var trid_libro = $('#trid_libro').val();
      var id_libro = $('#id_libro').val();
      if (ruta_archivo != '' && titulo != '' && id_autor != '' && fecha_publicacion != '' && genero != '' && sipnosis != '' && num_paginas != '' && idioma != '') {
        $.ajax({
          url: "bd/update_book.php",
          type: "post",
          data: {
            ruta_archivo: ruta_archivo,
            titulo: titulo,
            id_autor: id_autor,
            fecha_publicacion: fecha_publicacion,
            genero: genero,
            sipnosis: sipnosis,
            num_paginas: num_paginas,
            idioma: idioma,
            id_libro: id_libro
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              $('#ActualizarModal').modal('hide');
              table = $('#tablaLibros').DataTable();
              var button = '<td><a href="javascript:void();" data-id_libro="' + id_libro + '" class="btn editbtn" ><i role="button" class="fa-solid fa-user-pen text-primary"></i></a> <a href="#!"  data-id_libro="' + id_libro + '"  class="btn deleteBtn" ><i role="button" class="fa-solid fa-user-xmark text-danger"></i></a></td>';
              var row = table.row("[id_libro='" + trid_libro + "']");
              row.row("[id_libro='" + trid_libro + "']").data([id_libro, ruta_archivo, titulo, id_autor, fecha_publicacion, genero, sipnosis, num_paginas, idioma]);
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Llenar todos los campos');
      }
    });
    //Editar
    $('#tablaLibros').on('click', '.editbtn ', function(event) {
      var table = $('#tablaLibros').DataTable();
      var trid_libro = $(this).closest('tr').attr('id_libro');
      var id_libro = $(this).data('id_libro');
      $('#ActualizarModal').modal('show');

      $.ajax({
        url: "bd/edit-book.php",
        data: {
          id_libro: id_libro
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#updateRuta').val(json.ruta_archivo);
          $('#updateTitulo').val(json.titulo);
          $('#updateAutor').val(json.id_autor);
          $('#updatePublicacion').val(json.fecha_publicacion);
          $('#updateGenero').val(json.genero);
          $('#updateSinopsis').val(json.sipnosis);
          $('#updatePaginas').val(json.num_paginas);
          $('#updateIdioma').val(json.idioma);
          $('#id_libro').val(id_libro);
          $('#trid_libro').val(trid_libro);
        }
      })
    });
    //Eliminar Libro
    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#tablaLibros').DataTable();
      event.preventDefault();
      var id_libro = $(this).data('id_libro');
      if (confirm("¿Deseas eliminar este libro? ")) {
        $.ajax({
          url: "bd/delete_book.php",
          data: {
            id_libro: id_libro
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id_libro).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }



    })
  </script>
  <!-- Actualizar Libro Modal -->
  <div class="modal fade" id="ActualizarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar Libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateBook">
            <input type="hidden" name="id_libro" id="id_libro" value="">
            <input type="hidden" name="trid_libro" id="trid_libro" value="">
            <div class="row">
            <div class="col">
              <label for="" class="fw-semibold">Ruta</label>
              <input type="text" class="form-control" id="updateRuta" name="updateRuta">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Título</label>
              <input type="text" class="form-control" id="updateTitulo" name="updateTitulo">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Autor</label>
              <input type="text" class="form-control" id="updateAutor" name="updateAutor">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Año de Publicación</label>  
              <input type="text" class="form-control" id="updatePublicacion" name="updatePublicacion">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="fw-semibold">Género</label>
              <input type="text" class="form-control" id="updateGenero" name="updateGenero">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Número de Páginas</label>
              <input type="text" class="form-control" id="updatePaginas" name="updatePaginas">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Idioma</label>
              <input type="text" class="form-control" id="updateIdioma" name="updateIdioma">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="fw-semibold">Sinopsis</label>
              <textarea class="form-control" id="updateSinopsis" rows="3"></textarea>
            </div>
          </div>
            <div class="text-center pt-3">
              <button type="submit" class="btn btn-primary">Actualizar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Añadir Libro Modal -->
  <div class="modal fade" id="modal_libros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addBook" action="">
          <div class="row">
            <div class="col">
              <label for="" class="fw-semibold">Ruta</label>
              <input type="text" class="form-control" id="inputRuta" name="inputModelo">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Título</label>
              <input type="text" class="form-control" id="inputTitulo" name="inputSO">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Autor</label>
              <input type="text" class="form-control" id="inputAutor" name="inputCPU">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Año de Publicación</label>  
              <input type="text" class="form-control" id="inputPublicacion" name="inputVelCPU">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="fw-semibold">Género</label>
              <input type="text" class="form-control" id="inputGenero" name="inputModelo">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Número de Páginas</label>
              <input type="text" class="form-control" id="inputPaginas" name="inputCPU">
            </div>
            <div class="col">
              <label for="" class="fw-semibold">Idioma</label>
              <input type="text" class="form-control" id="inputIdioma" name="inputVelCPU">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="fw-semibold">Sinopsis</label>
              <textarea class="form-control" id="inputSinopsis" rows="3"></textarea>
            </div>
          </div>
            <div class="text-center pt-3">
              <button type="submit" class="btn btn-primary">Agregar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">
</script>