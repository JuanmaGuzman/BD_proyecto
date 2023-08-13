<?php
require_once "./__init__.php";

// Hay que obtener los usuarios a elegir
$query = $DB->query('SELECT nombre FROM usuario;');
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('./templates/header.php'); ?>

<section class="hero is-success is-halfheight epicprime">
  <div class="hero-body">
    <h1 class="title">Servicios de streaming</h1>
  </div>
</section>

<section class="section">
  <?php if (isset($_SESSION['user_name'])) { ?>
    <!-- Se muestra un mensaje si hay una sesión de usuario -->
    <h2 class="title is-1"> Hola <?php echo $_SESSION['user_name'] ?></h2>
    <form class="buttons" action="/~grupo54/logout.php">
      <input class="button" type="submit" value="Cerrar Sesión">
    </form>
  <?php } elseif (isset($_SESSION['message'])) { ?>
      <?php if ($_SESSION['message'] == 'TIPO1') { ?>
        <h6 class="title is-6"> El nombre de usuario ingresado no existe. Regístrate para iniciar sesión!<?php ?></h6>
        <div class="buttons">
          <a href="/~grupo54/singup.php" class="button is-primary" >
            Registrarse
          </a>
          <a href="/~grupo54/login.php" class="button is-light" >
            Iniciar sesión
          </a>
        </div>
      <?php } else { ?>
        <h6 class="title is-6"> El nombre de usuario ingresado ya existe. Prueba con otro nombre!<?php ?></h6>
        <div class="buttons">
          <a href="/~grupo54/singup.php" class="button is-primary" >
            Registrarse
          </a>
          <a href="/~grupo54/login.php" class="button is-light" >
            Iniciar sesión
          </a>
        </div>
      <?php } ?>

  <?php } else { ?>
    <!-- En el caso que no, se muestran los botones para iniciar sesión -->
    <div class="buttons">
      <a href="/~grupo54/singup.php" class="button is-primary" >
        Registrarse
      </a>
      <a href="/~grupo54/login.php" class="button is-light" >
        Iniciar sesión
      </a>
    </div>
  <?php } ?>
</section>

<!-- https://bulma.io/documentation/layout/tiles/ -->
<main class="section">
  <!-- Aquí agregamos una parte que solo está disponible a los usuarios con sesión iniciada -->
  <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <div class="tile is-child box">
          <h2 class="title">Mi perfil</h2>
          <a href="./consultas/perfil.php" class="button is-primary">Ver mi perfil</a>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <div class="tile is-child box">
          <h2 class="title">Subscripción</h2>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <div class="tile is-child box">
          <h2 class="title">Pago unico</h2>
        </div>
      </div>
    </div>
  <?php } ?>
</main>

<?php include('./templates/footer.php'); ?>