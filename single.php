<?php get_header(); 

include "connection.php";

//$fields = get_fields();

?>

<?php the_title();?>

<?php the_content();?>


<body>

<div class="container-fluid" id="full-guidth">
  <div class="row content">
    <div class="col-sm-9">
    
    <h4><small>RECENT POSTS</small></h4>
      <hr>
      <h2>I Love Food</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>
      <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <br><br>
      
      <hr>

    
    </div>
    
    <div class="col-sm-3">
    



    </div>
    
  </div>
</div>

</body>


<?php get_footer(); ?>