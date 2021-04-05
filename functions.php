<?php
function hogwarts(){
    wp_enqueue_script('uvoz-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_style('uvoz-custom-uvoz-font', 'fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('uvoz-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('hogwartsCSS', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'hogwarts');

/**/
function razne_cool_stvari() {
    add_theme_support('title-tag'); // inserting title on the specific page trouht wp_head()
    register_nav_menu('glavniMeni', 'Glavni Meni'); //dodavanje fjonalnosti da mozemo iz apperiance menus da pravimo meni
    register_nav_menu('footerLocationOne', 'Futer lokacija jedan');
    register_nav_menu('footerLocationTwo', 'Futer lokacija dva');
}

add_action('after_setup_theme', 'razne_cool_stvari'); //after_setup_theme je hook koji kaze da se okine ova akcija nakon sto se ucita tema

function Hogwarst_adjust_query($query) {
if (!is_admin() AND is_post_type_archive( 'quidditch' ) AND $query->is_main_query()) { //is main query je da li je default WP URL query a ne custom query
    /*$query-> set('posts_per_page', '1');*/
    $today = date('Ymd');
    $query->set('meta_key', 'quidditch_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(  
        array(
          'key' => 'quidditch_date', 
          'compare' => '>=',  
          'value' => $today,
          'type' => 'numeric'
        )
        ));
}
}

add_action('pre_get_posts', 'Hogwarst_adjust_query'); //just before wp sends his query to DB this function fires - kind of last word, gazi sve ostalo
?>