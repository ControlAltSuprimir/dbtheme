<?php
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}



function template_styles()
{
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', false, '4.4.1', 'all');
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css?family=Montserrat&display=swap', false, '', 'all');
    wp_enqueue_style('main-style', get_stylesheet_uri(), array('bootstrap', 'montserrat'), '1.0', 'all');

    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', false, true);
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery', 'popper'), true);


    /*Selector de año de artículos*/
    wp_enqueue_script('custom', get_template_directory_uri() . "/../dbtheme/assets/js/custom.js", false, "1.1", true);
    wp_localize_script('custom', 'selectyear', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    /*Sidebar*/
    wp_enqueue_script('sidebar', get_template_directory_uri() . "/../dbtheme/assets/js/sidebar.js", false, "1.1", true);
    wp_localize_script('sidebar', 'optionssidebar', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    /*Profile*/
    wp_enqueue_script('profile', get_template_directory_uri() . "/../dbtheme/assets/js/profile.js", false, "1.1", true);
    wp_localize_script('profile', 'profile', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    /*Show working list*/
    wp_enqueue_script('workingList', get_template_directory_uri() . "/../dbtheme/assets/js/test.js", false, "1.1", true);
    wp_localize_script('workingList', 'workingList', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}


add_action('wp_enqueue_scripts', 'template_styles');
add_theme_support('post-thumbnails');



// Haciendo un excerpt en espagnol

function custom_child_init()
{
    remove_filter('excerpt_more', 'ascend_excerpt_more');
    remove_filter('get_the_excerpt', 'ascend_custom_excerpt_more');
}
add_action('init', 'custom_child_init');

// Función de filtraje de artículos por año
add_action("wp_ajax_nopriv_filterYear", "filterYear");
add_action("wp_ajax_filterYear", "filterYear");

function filterYear()
{

    $pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba;charset=utf8', 'root', '');
    $statement = $pdo->prepare('SELECT bad_authors,bad_title FROM bad_articles WHERE bad_year = ? ');
    $statement->execute(
        array(
            $_POST["year"]
        )
    );
    $return = array();
    while ($result = $statement->fetch()) {
        $return[] = array(
            'bad_authors'    => $result['bad_authors'],
            'bad_title' => $result['bad_title']
        );
    }

    wp_send_json($return);
}

//Funcion de sidebar

add_action("wp_ajax_nopriv_filterSidebar", "filterSidebar");
add_action("wp_ajax_filterSidebar", "filterSidebar");

function filterSidebar()
{
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba;charset=utf8', 'root', '');


    $statement = $pdo->prepare('SELECT * FROM ' . $_POST["selection"] . ' ORDER BY last_name');
    $statement->execute();


    $return = array();
    while ($result = $statement->fetch()) {
        if ($_POST["selection"] == 'test_members') {
            $return[]  =  array(
                'id_test_members'   =>  $result['id_test_members'],
                'first_name'    =>   $result['first_name'],
                'last_name'     =>   $result['last_name'],
                'email'         =>   $result['email'],
                'grade'         =>   $result['grade'],
                'personal_url'  =>   $result['personal_url'],
                'university'    => $result['university'],
                'field'         =>  $result['field'],
                'grade_year'    => $result['grade_year'],
                'position'  => $result['position'],
                'current'   => $curPageName
            );
        } else {
            $return[] = array(
                'id_graduates'  =>   $result['id_graduates'],
                'first_name'    =>   $result['first_name'],
                'last_name'     =>   $result['last_name'],
                'email'         =>   $result['email'],
                'grade'         =>   $result['grade'],
                'personal_url'  =>   $result['personal_url'],
                'current'   => $curPageName
            );
        }
    }

    wp_send_json($return);
}

//filterProfile

add_action("wp_ajax_nopriv_filterProfile", "filterProfile");
add_action("wp_ajax_filterProfile", "filterProfile");

function filterProfile()
{

    $pdo = new PDO('mysql:host=127.0.0.1;dbname=db-de-prueba;charset=utf8', 'root', '');


    $statement = $pdo->prepare('SELECT * FROM test_members WHERE id_test_members = ? ');
    $statement->execute(
        array(
            (int)$_POST["selection"]
        )
    );
    $statement->execute();


    $return = array();
    while ($result = $statement->fetch()) {

        $return[]  =  array(
            'id_test_members'   =>  $result['id_test_members'],
            'first_name'    =>   $result['first_name'],
            'last_name'     =>   $result['last_name'],
            'email'         =>   $result['email'],
            'grade'         =>   $result['grade'],
            'personal_url'  =>   $result['personal_url'],
            'university'    => $result['university'],
            'field'         =>  $result['field'],
            'grade_year'    => $result['grade_year'],
            'position'  => $result['position']
        );
    }

    wp_send_json($return);
}


add_action("wp_ajax_nopriv_showList", "showList");
add_action("wp_ajax_showList", "showList");

function showList(){

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
            echo '<a class="profile" val="3">';
            echo $result['first_name'] . " " . $result['last_name'];
            echo '</a>';
        } else {
            echo "<a class='profile' val='3'>" . $result['first_name'] . " " . $result['last_name'] . "</a>.";
        }
        echo ". " . $result['grade'] . ", " . $result['university'] . ". Contacto: " . $result['email'] . "</p>";
    endwhile;
}
