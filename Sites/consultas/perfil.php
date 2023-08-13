<?php
require_once './../__init__.php';

$statement = $DB->prepare("SELECT * FROM usuario WHERE id_usuario = :id;");
$statement->execute(array('id' => $_SESSION['user_id']));
$resultado = $statement->fetch(PDO::FETCH_ASSOC);
?>

<?php include './../templates/header.php' ?>

<section class="section">
  <h1 class="title is-1">Perfil</h1>
  <h2 class="title is-1">Username: <?php echo $resultado['username'] ?>!</h2>
  <?php  ?>
</section>

<?php include './../templates/footer.php' ?>