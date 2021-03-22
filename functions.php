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


?>