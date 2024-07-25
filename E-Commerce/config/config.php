<?php

    require_once 'php/classes/Product.php';  
    require_once 'php/classes/Cd.php';
    require_once 'php/classes/Dvd.php';
    require_once 'php/classes/Book.php';
    require_once 'php/classes/Catalogue.php';
    require_once 'php/classes/Cart.php';

    /*
        INSTAURO SESSIONE, CON MODIFICA DEL TEMPO DI EXPIRE
    */
    $lifetime = strtotime("1 day");
    session_start();
    //Sovrascrivo al cookie di sessione il tempo di expire
    setcookie(session_name(), session_id(), $lifetime);

    //includo le classi

    


