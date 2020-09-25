<?php
// CUIDADO CON EL CHAR SET!!! SIEMPRE SE ME OLVIDA Y SALEN LOS ? POR TODAS PARTES
//$pdo = new PDO('mysql:host=10.100.14.254;dbname=matemat1_db_prueba;charset=utf8', 'matemat1_trivial_db', 'hurdet-tymqoc-2mIxqe');

$pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba', 'root', '');

/*

$pdo = new PDO('mysql:host=localhost;dbname=matemat1_db_prueba;charset=utf8', 'matemat1_trivial_db', 'hurdet-tymqoc-2mIxqe');

$statement = $pdo->prepare('SELECT * FROM graduates ORDER BY last_name');
$statement-> execute();

*/