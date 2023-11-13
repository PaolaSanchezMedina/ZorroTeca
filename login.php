<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Hoja de estilos css-->
  <link rel="stylesheet" href="css/style.css">
  <!--Icono de la página-->
  <link rel="shortcut icon" href="img/zorro.png" type="image/x-icon">
  <!--Bootstrap 5-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>ZorroTeca</title>
</head>

<body>
  <section class="d-flex justify-content-center pt-5">
    <div class="form-box mt-4">
      <div class="form-value">
        <form method="post" action="" class="text-center">
          <img src="img/zorro.png" class="rounded" alt="Logo" width="80" height="80">
          <h4 class="mt-3" style="color: white; text-align: center;">Iniciar sesión</h4>
          <?php
          include "bd/connection.php";
          include "bd/controlador-login.php";
          ?>
          <div class="inputbox">
            <img src="img/user.png" alt="">
            <!--Input del usuario-->
            <input type="text" required id="" name="usuario">
            <label for="">Usuario</label>
          </div>
          <div class="inputbox">
            <img src="img/pass.png" alt="">
            <!--Input de la contraseña-->
            <input type="password" required id="" name="contrasena">
            <label for="">Contraseña</label>
          </div>
          <input name="btnIniciar" class="btn text-light fw-semibold" type="submit" value="Iniciar Sesión"></input>
        </form>
      </div>
    </div>
  </section>
  <!--Bootstrap 5-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>