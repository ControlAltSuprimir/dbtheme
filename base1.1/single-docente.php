<?php get_header(); 

include "connection.php";

$fields = get_fields();


?>

<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
    <h1><?php the_title(); ?></h1>
    <hr>

    <?php
    $statement = $pdo->prepare('SELECT * FROM test_members WHERE first_name=? AND last_name=? ');
    $statement->execute(
        array(
          $fields['first_name'],
          $fields['last_name']
         ) 
    );
    $result = $statement->fetch()
    ?>
    
    <div class="row">
        <div class="col-3">
        
        </div>
        <div class="col-9">
            <ul style="list-style-type:none;">
            <li><?php echo $result['grade'].". ".$result['university'].", ".$result['grade_year'].".";?></li>
            <li><?php echo $result['position']; ?></li>
            <li><?php echo $result['email'];?> </li>
            <li><?php echo "Área de Investigación: ".$result['field'];?></li>

            <?php
            if($result['personal_url']){
                echo "<li><a href=".$result['personal_url']." target='_blank'> Página Personal </a></li>";
                    }
            ?>   
            </ul>
        </div>
    </div>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php endwhile;?>

        
    

    <hr>
    <h4>Últimas publicaciones</h3>
    <ol>
    <?php 
    $statement = $pdo->prepare('SELECT * FROM bad_articles WHERE bad_authors LIKE ? LIMIT 5');
    $statement->execute(
      array(
        '%'.$fields['article_alias'].'%'
      ) 
    );
        while($result = $statement->fetch()) {
            ?><tr>
            <?php echo "<li>".$result['bad_authors'].". ".$result['bad_title'].". ".$result['bad_year'].".</li>";
    };?>
    </ol>


    



    </main>
</div>




<?php
	/**
	 * Hook - education_soul_action_sidebar.
	 *
	 * @hooked: education_soul_add_sidebar - 10
	 */
	do_action( 'education_soul_action_sidebar' );
?>

<?php get_footer(); ?>