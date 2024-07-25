<?php

    include 'classes/Product.php';  
    include 'config/classes/Cd.php';
    include 'config/classes/Dvd.php';
    include 'config/classes/Book.php';
    include 'config/classes/Catalogue.php';
    include 'config/classes/Cart.php';

    /*
        INSTAURO SESSIONE, CON MODIFICA DEL TEMPO DI EXPIRE
    */
    $lifetime = strtotime("1 day");
    session_start();
    //Sovrascrivo al cookie di sessione il tempo di expire
    setcookie(session_name(), session_id(), $lifetime);

    //includo le classi

    


