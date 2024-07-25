<?php
    include 'php/view/cart.view.php';

?>
    <div id = "ListBar">
        <?php
        //=======TITOLO=======//
        showTitle();   
        //====================//
        showBoxDetails();
        //===========================//
        
        // ? In caso non fossero settate le variabili di sessione, inizializzo i prodotti
        if(!isset($_SESSION['catalogue']) && !isset($_SESSION['cart'])){
            $p = array();
            $p[0] = new Book('Metro', 'Mondo postapocalittico ambientato nelle metropolitane', 'web/img/libri.jpg', 2001, 14.99, 10, 'Sghi', 'Feltrinelli', 290);
            $p[1] = new Cd('Hola', 'Musica Hawaiana', 'web/img/cd.jpg', 2003, 16.99, 15, 'Gian', 'Zanichelli', 120);
            $p[2] = new Dvd('Nemo', 'Mondo sottomarino bellissimo', 'web/img/dvd.jpg', 2004, 12.99, 5, 'Luca', 'Bombardelli', 142);
            $p[3] = new Book('Scienze', 'Studia la natura con Leonardo', 'web/img/libri.jpg', 2005, 34.99, 10, 'Leonardo', 'Banana Blu', 100);
            $p[4] = new Cd('Spyro', 'Fantasy ricco di draghi', 'web/img/cd.jpg', 2006, 24.99, 5, 'Kabir', 'Activision', 111);
            $p[5] = new Dvd('Cars 3', 'Mondo postapocalittico ambientato nelle metropolitane', 'web/img/dvd.jpg', 2010, 4.99, 10, 'Matteo', 'Feltrinelli', 145);
            $_SESSION['catalogue'] = new Catalogue($p);
            $_SESSION['cart'] = new Cart();
            $_SESSION['nProducts'] = 0;
            //Copio i prodotti e il carrello vuoto nella sessione
            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];
            //stampo il carrello inizializzato (vuoto)
            $cart->printProductList();
        }
        else{
            // ? Carrello e catalogo sono già inizializzati
            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];
            $catLen = count($catalogue->getProducts());
            // Acquisto carrello
            if(isset($_POST['buy'])){
                //carrello svuotato
                $cart->buyCart();
                $_SESSION['cart'] = $cart;
                $_SESSION['totalPrice'] = 0;
                $_SESSION['nProducts'] = 0;

                //Cambia la reale quantità nel catalogo: la quantità reale diventa uguale alla temporanea
                for($i = 0; $i < $catLen; $i++){
                    $catalogue->getProducts()[$i]->setQuantity($catalogue->getProducts()[$i]->getActualQuantity());
                    /*
                    SE VOGLIO ELIMINARE DAL CATALOGO SCOMMENTO QUESTO IF
                    if($catalogue->getProducts()[$i]->getQuantity() <= 0){
                        //$catalogue->delProduct($i);
                        //$i = $i-1; //ritorno indietro perchè l'array cambia
                        //$catLen = count($catalogue->getProducts());
                    }
                    */
                        
                }

            }
            else if(isset($_POST['quantityToMarket']) && $_POST['quantityToMarket'] != null 
            && $_POST['quantityToMarket'] > 0 && isset($_POST['indexToMarket'])){
                $index = $_POST['indexToMarket'];
                $quantity = $_POST['quantityToMarket'];

                for($i = 0; $i < $catLen; $i++)
                    if($catalogue->getProducts()[$i]->getCode() == $cart->getProducts()[$index]->getCode()){
                        
                        //if($catalogue->getProducts()[$i]->getActualQuantity() + $quantity < $catalogue->getProducts()[$i]->getQuantity()){
                            //Posso inviare la quantità:
                        if($quantity <= $cart->getProducts()[$index]->getQuantity()){
                            $catalogue->getProducts()[$i]->setActualQuantity($catalogue->getProducts()[$i]->getActualQuantity() + $quantity);
                            $cart->getProducts()[$index]->setQuantity($cart->getProducts()[$index]->getQuantity() - $quantity);
                            //$_SESSION['nProducts'] = $_SESSION['nProducts'] - $quantity;
                        }
                        
                        //Se nel carrello la quantità è 0 lo elimino

                        //$catalogue->delProduct($i);
                        //$i = $i-1; //ritorno indietro perchè l'array cambia
                        if($cart->getProducts()[$index]->getQuantity() <= 0){
                            $cart->delProduct($index);
                            $i = $i - 1;
                        }
                        //$_SESSION['nProducts'] = $_SESSION['nProducts'] - $quantity;
                        break;
                    }
            }

            //Aggiorno i valori di sessione
            $_SESSION['cart'] = $cart;
            $_SESSION['totalPrice'] = $cart->calculateImport();
            $_SESSION['nProducts'] = $cart->totProduct();
            $_SESSION['catalogue'] = $catalogue;
            
            $cart->printProductList();
            //$_POST['quantityToMarket'] = null;

        }

        //=======btn=========//
        showMarketPlaceBtn();
        showBuyTotal();

        ?>
    </div>