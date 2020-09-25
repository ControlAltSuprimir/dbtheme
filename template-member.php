<?php 
//Template Name: Member
get_header(); 

include "connection.php";

$statement = $pdo->prepare('SELECT * FROM test_members ORDER BY last_name');
$statement->execute(
  array() 
);




?>




<div class="container-fluid" id="full-guidth">
  <div class="row content" >
    <div class="col-sm-9" id="left-content">
        

      <h1>Académicos</h1>

    

    
      <?php
    
        while($result = $statement->fetch()):
            
                echo '<p>';
                    if($result['url']==NULL){
                      echo '<a value="'.$result['id_test_member'].'" class="profile" >';  
                      echo $result['first_name']." ".$result['last_name'];
                      echo '</a>';
                    }
                    else{
                        echo "<a href=".$result['uchile_web']." target='_blank'>".$result['first_name']." ".$result['last_name']."</a>.";
                    }
                    echo ". ".$result['grade'].", ".$result['university'].". Contacto: ".$result['email']."</p>";
                  endwhile;
      ?>
    
    </div>



    <div class="col-sm-3">
    
      <table id="options_sidebar">
        <tr>
          <td value="graduates" class="clickme">Graduates</td>
        </tr>
        <tr>
          <td value="test_members" class="clickme">Miembros</td>
        </tr>
        <tr>
          <td>2016</td>
        </tr>
      </table>
    </div>

  </div>
</div><!-- primary -->



<?php get_footer();
