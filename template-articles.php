<?php 
//Template Name: Artículos
get_header(); 
//$fields = get_fields();
include 'connection.php';
$statement = $pdo->prepare('SELECT DISTINCT bad_year FROM bad_articles ORDER BY bad_year DESC');
$statement-> execute();

$years=array();
while($result = $statement->fetch()){
    array_push($years,$result['bad_year']);
}
?>

<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

        <select class="form-control" name="select-year" id="select-year">
            <option value="">Selecciona un año</option>
            <?php foreach($years as $year){
                echo '<option value="'.$year.'">'.$year.'</option>';
            }?>
        </select>
        
        <div id="articles-this-year" class="row">
        <br>
        

        </div>
    
    
    
    </main><!-- #main -->
</div><!-- primary -->


<?php
	/**
	 * Hook - education_soul_action_sidebar.
	 *
	 * @hooked: education_soul_add_sidebar - 10
	 */
	do_action( 'education_soul_action_sidebar' );
?>

<?php get_footer();
