<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba;charset=utf8', 'root', '');


$statement = $pdo->prepare('SELECT * FROM test_members WHERE id_test_members = ? ');
$statement->execute(
    array(
        (int)$_POST["selection"]
    )
);
while ($result = $statement->fetch()) :

  echo '<p>';
  if ($result['personal_url'] == NULL) {
    echo '<a value="test_members" class="clickme-sidebar-member" >';
    echo $result['first_name'] . " " . $result['last_name'];
    echo '</a>';
  } else {
    echo "<a class='profile' val='3'>" . $result['first_name'] . " " . $result['last_name'] . "</a>.";
  }
  echo ". " . $result['grade'] . ", " . $result['university'] . ". Contacto: " . $result['email'] . "</p>";
endwhile;
?>