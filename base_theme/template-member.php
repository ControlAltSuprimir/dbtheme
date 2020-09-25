<?php 
//Template Name: Member
get_header(); 

include "connection.php";

$fields = get_fields();


$statement = $pdo->prepare('SELECT * FROM test_members ORDER BY last_name');
$statement->execute(
  array(
    '%'.$fields['member'].'%'
  ) 
);

/*
$query_member = mysqli_query($mysqli, "SELECT * FROM bad_articles WHERE bad_authors LIKE `$nombre` ");
*/

?>

<div id="primary" class="content-area" id="full-guidth">
		<main id="main" class="site-main" role="main">

        

    <h1>Académicos</h1>

    

    
    <?php
    
        while($result = $statement->fetch()):
            
                echo "<p>";
                    if($result['url']==NULL){
                        echo $result['first_name']." ".$result['last_name'];
                    }
                    else{
                        echo "<a href=".$result['uchile_web']." target='_blank'>".$result['first_name']." ".$result['last_name']."</a>.";
                    }
                    echo ". ".$result['grade'].", ".$result['university'].". Contacto: ".$result['email']."</p>";
                  endwhile;?>
    



  </main><!-- #main -->
</div><!-- primary -->



<?php get_footer();
