<?php
   require_once ( dirname ( __FILE__ ) . '/config.php' );

function the_title () {
    global $title;
    echo $title;    
}

function the_category () {
    global $category;
    echo $category;    
}

function the_date () {
    global $date;
    echo $date;    
}

function the_autor () {
    global $autor;
    echo $autor;    
}

function the_image () {
    global $image;
    echo $image;    
}

function home_url () {
    echo ABS_URL;
}