<?php
require_once './__init__.php';

// Vemos si se esta mandando el form o se está recibiendo
$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
if ($request_method  === 'POST') {
  // Se está recibiendo datos para el login
  // Aquí se tendría que buscar el id del usuario en la BDD con el mail y la contraseña

  $email = $_POST['email'];

  $statement = $DB->prepare("SELECT COUNT(1) AS valor FROM usuario WHERE mail = :email;");
  $statement->execute(array('email' => $email));
  $resultado = $statement->fetch(PDO::FETCH_ASSOC);

  if ($resultado['valor'] == 1) {
    // El nombre de usuario ingresado ya existe
    $_SESSION['message'] = 'TIPO2';
    go_home();
  }

  else {
    // agregamos usuario a bd
    $name = $_POST['name'];
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    $statement = $DB->prepare("SELECT MAX(user_id) AS max_id FROM usuario;");
    $statement->execute(array('email' => $email));
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    $user_id = $resultado['max_id'] + 1;

    $_SESSION['name'] = $name;
    $_SESSION['user_name'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['user_id'] = $user_id;
    go_home();
  }

  
  // Se guardan estos valores en la sesión


  // Mandamos al usuario al inicio
} elseif ($request_method === 'GET') {
  // En este caso, que se trata de obtener la página de inicio de sesión
  // y no hay una sesión iniciada, se muestra el form

  include './templates/header.php'; ?>
  <!-- https://bulma.io/documentation/columns -->
  <section class="section">

    <div class="columns is-mobile is-centered is-vcentered cover-all">
      <div class="column is-half">
        <!-- https://bulma.io/documentation/form/general/ -->
        <form method="POST">
          <div class="field">
            <h4 class="title is-4" align="center"> Registrarse <?php ?></h4>
            <div class="control">
              <label for="html">Nombre:</label>
              <input class="input" type="text" name="name" >
            </div>
            <br>
            <div class="control">
              <label for="html">Nombre de Usuario:</label>
              <input class="input" type="text" username="username" >
            </div>
            <br>
            <div class="control">
            <label for="html">Email:</label>
              <input class="input" type="email" email="email" >
            </div>
            <br>
            <div class="control">
              <label for="html">Password:</label>
              <input class="input" type="password" password="password" >
            </div>
          <br>
          <br>
          </div>
          <button class="button is-primary" type="submit" name="login">Confirmar</button>
        </form>
      </div>
    </div>
  </section>
<?php include './templates/footer.php';
} ?>