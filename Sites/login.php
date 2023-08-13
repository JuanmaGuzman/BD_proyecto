<?php
require_once './__init__.php';

// Vemos si se esta mandando el form o se está recibiendo
$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
if ($request_method  === 'POST') {
  // Se está recibiendo datos para el login
  // Aquí se tendría que buscar el id del usuario en la BDD con el mail y la contraseña

  $email = $_POST['email'];
  $password = $_POST['password'];

  $statement = $DB->prepare("SELECT COUNT(1) AS valor FROM usuario WHERE mail = :email;");
  $statement->execute(array('email' => $email));
  $resultado = $statement->fetch(PDO::FETCH_ASSOC);

  if ($resultado['valor'] == 1) {

    $statement = $DB->prepare("SELECT username AS username, id_usuario AS id FROM usuario WHERE mail = :email;");
    $statement->execute(array('email' => $email));
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    $username = $resultado['username'];
    $user_id = $resultado['id'];

    $_SESSION['email'] = $email;
    $_SESSION['user_name'] = $username;
    $_SESSION['user_id'] = $user_id;

    go_home();
  }

  else {
    $_SESSION['message'] = 'TIPO1';
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
          <h4 class="title is-4" align="center"> Iniciar sesión <?php ?></h4>
            <div class="control">
              <label for="html">Email:</label>
              <input class="input" type="email" name="email" >
            </div>
            <br>
            <div class="control">
              <label for="html">Password:</label>
              <input class="input" type="password" name="password" >
            </div>
          </div>
          <br>
          <button class="button is-primary" type="submit" name="login">Confirmar</button>
        </form>
      </div>
    </div>
  </section>
<?php include './templates/footer.php';
} ?>