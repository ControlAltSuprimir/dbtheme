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



if (isset($_GET['member']) and isset($_GET['type'])) {

// Realizando la solicitud GET
$type=$_GET['type'];
$pdo_get = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba', 'root', '');
$statement_get = $pdo_get->prepare('SELECT * FROM '.$_GET['type'].' ORDER BY last_name');
$statement_get->execute(
    array()
);
$members_get = array();
foreach ($statement_get as $state_get) {
    array_push($members_get, $state_get);
}
$miembro_get = array();


    foreach ($members_get as $member_get) {

      if (($member_get['id_test_members']==$_GET['member']) or ($member_get['id_graduates']==$_GET['member'])) {
            $miembro_get = $member_get;
            break;
        }
      
    }
}

?>

<!-- Esta parte es para comprender la ruta en la que nos encontramos, tratando de sustraer los parámetros en la url-->
<?php

//$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
$url = $base_url . $_SERVER["REQUEST_URI"];

$currentUrl = basename($_SERVER['REQUEST_URI']);
//echo 'El sitio actual es ' . $currentUrl . '<br>';
//echo 'La dirección completa es ' . $url.'<br>';
$url = strtok($url, '&');
//echo $url;

?>





<div class="container-fluid" id="full-guidth">
  <div class="row content">
    <div class="col-sm-9" id="left-content">





      <?php

if ($member_get) {
    ?>
            <h2><?php echo $member_get['first_name'] . ' ' . $member_get['last_name']; ?></h2>
        <div class="row">

<div class="col-3">
  FOTO
</div>
<div class="col-9">

  <?php echo $member_get['grade']; ?> . <?php echo $member_get['university']; ?> , <?php echo $member_get['grade_year']; ?>.<br>
  <?php echo $member_get['position']; ?><br>
  <?php echo $member_get['email']; ?> <br>
  <?php echo "Área de Investigación: " . $member_get['field']; ?><br>

  <?php
if ($member_get['personal_url']) {
        echo "<a href=" . $member_get['personal_url'] . " target='_blank'> Página Personal </a><br>";?>
        <?php
}?>
</div>
</div>
    <?php
} else {?>
    <div class="row">
      <h1>Personas</h1>

<p>Contamos con un equipo de Académicos todos con grado de Doctor en las mejores universidades extranjeras y nacionales, con una gran trayectoria y con distintas especialidades. Además con un gran equipo humano de soporte para los docentes y estudiantes</p>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
    <?php }
?>


    </div>



    <div class="col-sm-3">

      <ul class="nav nav-tabs md-tabs tabs-right b-none" role="tablist">
        <!-- Primer Bloque Derecha -->
        <li class="nav-item">
          <a class="nav-link active clickme-sidebar-member" data-toggle="tab"  value="test_members" value1="<?php echo strtok($currentUrl,'&'); ?>" href="#docentes" role="tab">Docentes</a>
          <div class="slide"></div>
        </li>

        <!-- Fin Primer Bloque Derecha -->
        <!--Segundo Bloque Derecha -->
        <li class="nav-item">
          <a class="nav-link clickme-sidebar-member" data-toggle="tab" value="graduates" value1="<?php echo strtok($currentUrl,'&'); ?>" href="#funcionarios" role="tab">Postgrado</a>
          <div class="slide"></div>
        </li>

      </ul>
    </div>

  </div>

</div><!-- primary -->



<?php get_footer();
