<?php
require_once './../__init__.php';

$resultados = $DB->query('SELECT * FROM usuario');
?>

<?php include './../templates/header.php' ?>

<section class="section">
  <h1 class="title is-1">Usuarios</h1>
  <?php table_from_query($resultados) ?>
</section>

<?php include './../templates/footer.php' ?>