<?php
//Template Name: Formulario
get_header();
//$fields = get_fields();


include 'connection.php';
$statement = $pdo->prepare('SELECT DISTINCT bad_year FROM bad_articles ORDER BY bad_year DESC');
$statement->execute();

$years = array();
while ($result = $statement->fetch()) {
	array_push($years, $result['bad_year']);
}
?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">


		<div id="main">
			<h1>Agregar Docente</h1>
			<p>Los campos con * son obligatorios</p>
			<div id="login">
				<hr />
				<form action="" method="post">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Primer Nombre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="first_name" id="first_name" required="required" placeholder="Juan">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Primer Apellido</label>
						<div class="col-sm-8">
							<input type="text" name="last_name" id="last_name" class="form-control" required="required" placeholder="Perez">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="text" name="email" id="email" class="form-control" required="required" placeholder="juan@email.com">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Posición</label>
						<div class="col-sm-8">
							<input type="text" name="position" id="position" class="form-control" required="required" placeholder="juan@email.com">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Universidad</label>
						<div class="col-sm-8">
							<input type="text" name="university" id="university" class="form-control" required="required" placeholder="Universidad de Chile">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Grado</label>
						<div class="col-sm-8">
							<input type="text" name="grade" id="grade" class="form-control" required="required" placeholder="Doctorado">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Año</label>
						<div class="col-sm-8">
							<input type="year" name="year" id="year" class="form-control" required="required" placeholder="2020">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Área de Investigación</label>
						<div class="col-sm-8">
							<input type="text" name="field" id="field" class="form-control" required="required" placeholder="Álgebra">
						</div>
					</div>
					<br /><br />
					<input type="submit" value=" Submit " name="submit" /><br />
				</form>
			</div>


		</div>
		<?php
		if (isset($_POST["submit"])) {
			$hostname = 'localhost';
			$username = 'root';
			$password = '';

			try {
				$dbh = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba', 'root', '');

				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
				$sql = "INSERT INTO test_members (last_name,first_name,position,university,grade,grade_year,field,email)
VALUES ('" . $_POST["last_name"] . "','" . $_POST["first_name"] . "','" . $_POST["position"] . "','" . $_POST["university"] . "','" . $_POST["grade"] . "','" . $_POST["year"] . "','" . $_POST["field"] . "','" . $_POST["email"] . "')";
				if ($dbh->query($sql)) {
					echo "<script type= 'text/javascript'>alert('Docente agregado con éxito :)');</script>";
				} else {
					echo "<script type= 'text/javascript'>alert('No pudo agregarse nuevos datos.');</script>";
				}

				$dbh = null;
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		?>

	</main>
</div>





<?php
/**
 * Hook - education_soul_action_sidebar.
 *
 * @hooked: education_soul_add_sidebar - 10
 */
do_action('education_soul_action_sidebar');
?>

<?php get_footer();
