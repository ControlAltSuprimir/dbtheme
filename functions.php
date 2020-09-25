<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}



function template_styles(){
   wp_register_style('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',false,'4.4.1','all');
   wp_register_style('montserrat','https://fonts.googleapis.com/css?family=Montserrat&display=swap',false,'','all');
   wp_enqueue_style('main-style', get_stylesheet_uri(), array('bootstrap','montserrat'),'1.0','all');

   wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', false, true );
   wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery','popper'), true);


   /*Selector de año de artículos*/
   wp_enqueue_script( 'custom', get_template_directory_uri()."/../dbtheme/assets/js/custom.js", false,"1.1", true );
   wp_localize_script('custom','selectyear',array(
       'ajaxurl' => admin_url('admin-ajax.php')
   ));

   /*Global Sidebar*/
   wp_enqueue_script( 'sidebar', get_template_directory_uri()."/../dbtheme/assets/js/sidebar.js", false,"1.1", true );
   wp_localize_script('sidebar','optionssidebar',array(
       'ajaxurl' => admin_url('admin-ajax.php')
   ));
   
}


add_action('wp_enqueue_scripts','template_styles');
add_theme_support( 'post-thumbnails' );

function my_custom_sidebar() {
   register_sidebar(
       array (
           'name' => __( 'Custom', 'your-theme-domain' ),
           'id' => 'custom-side-bar',
           'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
           'before_widget' => '<div class="widget-content">',
           'after_widget' => "</div>",
           'before_title' => '<h3 class="widget-title">',
           'after_title' => '</h3>',
       )
   );
}
add_action( 'widgets_init', 'my_custom_sidebar' );

//Añadiendo el Custom Post Type Docente

function docentes_type(){

   $labels = array(
       'name' => 'Docentes',
       'singular_name' => 'Docente',
       'menu_name' => 'Docentes',
   );

   $args = array(
       'label' => 'Docentes',
       'description' => 'Docentes del Departamento de Matemáticas',
       'labels' => $labels,
       'supports' => array('title','editor','thumbnail','revisions'),
       'public' => true,
       'show_in_menu' => true,
       'menu_position' => 5,
       'menu_icon' => 'dashicons-welcome-learn-more',
       'can_export' => 'true',
       'publicly_queryable' => true,
       'rewrite' => true,
       'show_in_rest' => true,
   );

   register_post_type('docente',$args);
}

add_action('init','docentes_type');

//Añadiendo el CPT Coloquios

function coloquios_type(){

    $labels = array(
        'name' => 'Coloquios',
        'singular_name' => 'Coloquio',
        'menu_name' => 'Coloquios',
    );
 
    $args = array(
        'label' => 'Coloquios',
        'description' => 'Coloquios las Palmeras',
        'labels' => $labels,
        'supports' => array('title','editor','thumbnail','revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'can_export' => 'true',
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true,
    );
 
    register_post_type('coloquio',$args);
 }
 
add_action('init','coloquios_type');

// Haciendo un excerpt en espagnol

function custom_child_init() {
    remove_filter('excerpt_more', 'ascend_excerpt_more');
    remove_filter( 'get_the_excerpt', 'ascend_custom_excerpt_more' );
    }
    add_action( 'init', 'custom_child_init' );

// Función de filtraje de artículos por año
add_action("wp_ajax_nopriv_filterYear","filterYear");
add_action("wp_ajax_filterYear","filterYear");

function filterYear(){

  $pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba;charset=utf8', 'root', '');
  $statement = $pdo->prepare('SELECT bad_authors,bad_title FROM bad_articles WHERE bad_year = ? ');
  $statement->execute(
    array(
      $_POST["year"]
    ) 
  );
   $return=array();
   while($result = $statement->fetch()){
       $return[]=array(
           'bad_authors'    => $result['bad_authors'],
           'bad_title' => $result['bad_title']
       );
      
   }

   wp_send_json($return);
   
}

//Funcion de sidebar global

add_action("wp_ajax_nopriv_filterSidebar","filterSidebar");
add_action("wp_ajax_filterSidebar","filterSidebar");

function filterSidebar(){

  $pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba;charset=utf8', 'root', '');

    
    $statement = $pdo->prepare('SELECT * FROM '.$_POST["selection"].' ORDER BY last_name');
    $statement->execute(); 
      

   $return=array();
   while($result = $statement->fetch()){
       $return[]=array(
           'first_name'    =>   $result['first_name'],
           'last_name'     =>   $result['last_name'],
           'email'         =>   $result['email'],
           'grade'         =>   $result['grade'],
           'personal_url'  =>   $result['personal_url']
       );
       
   }

   wp_send_json($return);
   
}
