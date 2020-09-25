<?php 
//Template Name: Alumnos de postgrado
get_header(); 


include 'connection.php';

$statement = $pdo->prepare('SELECT * FROM graduates ORDER BY last_name');
$statement-> execute();
//$query = mysqli_query($mysqli, "SELECT * FROM graduates ORDER BY last_name")
?>


<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

    <h2>Magíster</h2>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <tr>
    <th>Nombre</th>
    <th>Email</th>
    </tr>
    <?php 
        while($result = $statement->fetch()) {
            if($result['grade']=='magister'){
            echo "<tr>
            <td>".$result['first_name']." ".$result['last_name']."</td>
            <td>".$result['email']."</td>
            </tr>";}
    };?>
    </table>

    <h2>Doctorado</h2>

    <table>
    <tr>
    <th>Nombre</th>
    <th>Email</th>
    </tr>
    <?php
    $statement = $pdo->prepare('SELECT * FROM graduates ORDER BY last_name');
    $statement-> execute();
        while($result = $statement->fetch()) {
            if($result['grade']=='doctorado'){
                echo "<tr>
                    <td>";
                    if($result['url']==NULL){
                        echo $result['first_name']." ".$result['last_name'];
                    }
                    else{
                        echo "<a href=".$result['url']." target='_blank'>".$result['first_name']." ".$result['last_name']."</a>";
                    }
                    echo "</td><td>".$result['email']."</td>
                    </tr>";
                }
                /**
                 if($result['url']==NULL){
                    echo "<tr>
                    <td>".$result['first_name']." ".$result['last_name']."</td>
                    <td>".$result['email']."</td>
                    </tr>";}
                else{
                    echo "<tr>
                    <td><a href=".$result['url']." target='_blank'>".$result['first_name']." ".$result['last_name']."</a></td>
                    <td>".$result['email']."</td>
                    </tr>";
                }
                 */
            
    }?>
    </table>

    </main><!-- #main -->


</div><!-- #primary -->


<?php
	/**
	 * Hook - education_soul_action_sidebar.
	 *
	 * @hooked: education_soul_add_sidebar - 10
	 */
	do_action( 'education_soul_action_sidebar' );
?>

<?php get_footer();