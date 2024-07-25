<link href="web/css/marketplace.css" rel="stylesheet" type="text/css">

<?php
    include 'php/view/marketplace.view.php';

    
    ?>
    <div id = "ListBar">
    <?php
        //=======TITOLO=======//
        showTitle();   
        //====================//

        showBoxDetails();

        //=====CATALOGUE + PRINT====//

        // ? In caso non fossero settate le variabili di sessione, inizializzo i prodotti
        if(!isset($_SESSION['catalogue']) && !isset($_SESSION['cart'])){
            $p = array();
            $p[0] = new Book('Metro', 'Mondo postapocalittico ambientato nelle metropolitane', 'web/img/libri.jpg', 2001, 14.99, 10, 'Walter', 'Feltrinelli', 290);
            $p[1] = new Cd('Hola', 'Musica Hawaiana', 'web/img/cd.jpg', 2003, 16.99, 15, 'Gianluca R.', 'Zanichelli', 120);
            $p[2] = new Dvd('Nemo', 'Mondo sottomarino', 'web/img/dvd.jpg', 2004, 12.99, 5, 'Luca Raimondi', 'Bombardelli', 142);
            $p[3] = new Book('Scienze', 'Studia la natura con Leonardo', 'web/img/libri.jpg', 2005, 34.99, 10, 'Leonardo R.', 'Banana Blu', 100);
            $p[4] = new Cd('Spyro', 'Fantasy ricco di draghi', 'web/img/cd.jpg', 2006, 24.99, 5, 'Paolo S.', 'Activision', 111);
            $p[5] = new Dvd('Cars 3', 'Corse', 'web/img/dvd.jpg', 2010, 4.99, 10, 'Matteo F.', 'Feltrinelli', 145);
            $_SESSION['catalogue'] = new Catalogue($p);
            $_SESSION['cart'] = new Cart();
            $_SESSION['nProducts'] = 0;
            //Copio i prodotti e il carrello vuoto nella sessione
            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];
            //stampo il catalogo inizializzato
            $catalogue->printProductList();
        }
        else{   
            // ? Carrello e catalogo sono già inizializzati

            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];

            //L'aggiunta al carrello avviene solo con quantità maggiori di 0
            if(isset($_POST['quantityToCart']) && $_POST['quantityToCart'] != null 
            && $_POST['quantityToCart'] > 0 && isset($_POST['indexToCart'])){
                $cartLen = count($cart->getProducts());
                $index = $_POST['indexToCart'];
                $quantity = $_POST['quantityToCart'];

                // ? Se il carrello non è vuoto:
                if($cartLen > 0){
                    //variabile per controllo corrispondenza
                    $found = false;
                    
                    for($i = 0; $i < $cartLen; $i++)
                        if($cart->getProducts()[$i]->getCode() == $catalogue->getProducts()[$index]->getCode()){
                            /*
                                se trovo corrispondenza nel codice:
                                - aggiungo la quantità al prodotto già presente
                                - Cambio quantità attuale nel catalogo
                            */      
                            //Se invio quantità che mi fanno superare la quantità dell'originale (POST SPORCO) non sommo
                            if($cart->getProducts()[$i]->getQuantity() + $quantity <= $catalogue->getProducts()[$index]->getQuantity()){
                                $cart->getProducts()[$i]->setQuantity($cart->getProducts()[$i]->getQuantity() + $quantity);
                                $catalogue->getProducts()[$index]->setActualQuantity($catalogue->getProducts()[$index]->getActualQuantity() - $quantity);
                                $_SESSION['nProducts'] = $_SESSION['nProducts'] + $quantity;
                            }
                            //In caso la quantità dovesse diventare negativa diventa 0
                            if($catalogue->getProducts()[$index]->getActualQuantity() < 0) //Per raggirare mantenimento POST
                                $catalogue->getProducts()[$index]->setActualQuantity(0);
                            
                            $found = true;
                            
                            break;
                        }
                        
                    if(!$found){
                        /* 
                            se trovo corrispondenza nel codice:
                            - aggiungo l'elemento al carrello con la quantità inviata
                            - Cambio quantità attuale nel catalogo
                        */
                        $cart->addProduct($catalogue->getProducts()[$index]);
                        $cartLen = count($cart->getProducts());
                        $cart->getProducts()[$cartLen - 1]->setQuantity($quantity);
                        $catalogue->getProducts()[$index]->setActualQuantity($catalogue->getProducts()[$index]->getActualQuantity() - $quantity);
                        $_SESSION['nProducts'] = $_SESSION['nProducts'] + $quantity;
                    }
                }
                else{
                    /* 
                        se il carrello è vuoto:
                        - aggiungo direttamente l'elemento al carrello con la quantità inviata
                        - Cambio quantità attuale nel catalogo
                    */
                    $cart->addProduct($catalogue->getProducts()[$index]);
                    $cart->getProducts()[0]->setQuantity($quantity);
                    $catalogue->getProducts()[$index]->setActualQuantity($catalogue->getProducts()[$index]->getActualQuantity() - $quantity);
                    $_SESSION['nProducts'] = $_SESSION['nProducts'] + $quantity;
                }

                //Carrello aggiornato

            }

            //Aggiorno le variabili di sessione e stampo il catalogo
            $_SESSION['catalogue'] = $catalogue;
            $_SESSION['cart'] = $cart;
            $catalogue->printProductList();

            $_POST = array();
        }
        
        showCartBtn();

        ?>
    </div>
