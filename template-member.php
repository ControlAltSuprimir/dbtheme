<?php
//Template Name: Member
get_header();

include "connection.php";




$statement = $pdo->prepare('SELECT * FROM test_members ORDER BY last_name');
$statement->execute(
  array()
);
?>


<?php

// Realizando la solicitud GET
$pdo_get = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba', 'root', '');
$statement_get = $pdo_get->prepare('SELECT * FROM test_members ORDER BY last_name');
$statement_get->execute(
  array()
);
$members_get = array();
foreach ($statement_get as $state_get) {
  array_push($members_get, $state_get);
}


$miembro_get = array();

if (isset($_GET['nombre']) and isset($_GET['apellido'])) {

  foreach ($members_get as $member_get) {
    if ($member_get['first_name'] == $_GET['nombre']) {
      $miembro_get = $member_get;
      break;
    }
  }
}
?>






<div class="container-fluid" id="full-guidth">
  <div class="row content">
    <div class="col-sm-9" id="left-content">


      <h1>Académicos</h1>




      <?php

      while ($result = $statement->fetch()) :

        echo '<p>';
        if ($result['personal_url'] == NULL) {
          echo '<a value="test_members" class="clickme-sidebar-member" >';
          echo $result['first_name'] . " " . $result['last_name'];
          echo '</a>';
        } else {
          echo "<a href=" . $result['uchile_web'] . " target='_blank'>" . $result['first_name'] . " " . $result['last_name'] . "</a>.";
        }
        echo ". " . $result['grade'] . ", " . $result['university'] . ". Contacto: " . $result['email'] . "</p>";
      endwhile;
      ?>

      <a class="profile" value="3">Hola</a><br>
      <a class="click" value="3">Hola list</a>

      <?php 
      if($member_get){
        echo 'Se recone el get cuyo nombre es'.$_GET["nombre"];
      }
      ?>
    </div>



    <div class="col-sm-3">

      <ul class="nav nav-tabs md-tabs tabs-right b-none" role="tablist">
        <!-- Primer Bloque Derecha -->
        <li class="nav-item">
          <a class="nav-link active clickme-sidebar-member" data-toggle="tab" value="test_members" href="#docentes" role="tab">Docentes</a>
          <div class="slide"></div>
        </li>

        <!-- Fin Primer Bloque Derecha -->
        <!--Segundo Bloque Derecha -->
        <li class="nav-item">
          <a class="nav-link clickme-sidebar-member" data-toggle="tab" value="graduates" href="#funcionarios" role="tab">Postgrado</a>
          <div class="slide"></div>
        </li>

      </ul>
    </div>

  </div>
</div><!-- primary -->



<?php get_footer();
