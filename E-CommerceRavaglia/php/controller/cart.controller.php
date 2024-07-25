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

        if(!isset($_SESSION['catalogue']) && !isset($_SESSION['cart'])){
            $p = array();
            $p[0] = new Book('Metro', 'Mondo postapocalittico ambientato nelle metropolitane', 'web/img/libri.jpg', 2001, 14.99, 10, 'Sghi', 'Feltrinelli', 290);
            $p[1] = new Cd('Hola', 'Musica Hawaiana', 'web/img/cd.jpg', 2003, 16.99, 19, 'Gian', 'Zanichelli', 120);
            $p[2] = new Dvd('Nemo', 'Mondo sottomarino bellissimo', 'web/img/dvd.jpg', 2004, 12.99, 2, 'Luca', 'Bombardelli', 142);
            $p[3] = new Book('Scienze', 'Studia la natura con Leonardo', 'web/img/libri.jpg', 2005, 34.99, 3, 'Leonardo', 'Banana Blu', 100);
            $p[4] = new Cd('Spyro', 'Fantasy ricco di draghi', 'web/img/cd.jpg', 2006, 24.99, 5, 'Kabir', 'Activision', 111);
            $p[5] = new Dvd('Cars 3', 'Mondo postapocalittico ambientato nelle metropolitane', 'web/img/dvd.jpg', 2010, 4.99, 6, 'Matteo', 'Feltrinelli', 145);
            $_SESSION['catalogue'] = new Catalogue($p);
            $_SESSION['cart'] = new Cart();
            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];
        }
        else{
            if(isset($_POST['buy'])){
                $cart = $_SESSION['cart'];
                $cart->buyCart();
                $_SESSION['totalPrice'] = $cart->calculateImport();
                $_SESSION['nProducts'] = $cart->totProduct();
                //$_SESSION['catalogue'] = $catalogue;
                $_SESSION['cart'] = $cart;
                //$cart->printProductList();
                $_POST['quantityToMarket'] = null;
            }

                $catalogue = $_SESSION['catalogue'];
                $cart = $_SESSION['cart'];

                if(isset($_POST['quantityToMarket']) && $_POST['quantityToMarket'] != null && $_POST['quantityToMarket'] > 0 && isset($_POST['indexToMarket'])){
                    $catalogue = $_SESSION['catalogue'];
                    $cart = $_SESSION['cart'];
                    $catLen = count($catalogue->getProducts());
                    $index = $_POST['indexToMarket'];
                    $quantity = $_POST['quantityToMarket'];
                    echo "$index _ $quantity";

                    $found = false;
                    
                    for($i = 0; $i < $catLen; $i++)
                        if($catalogue->getProducts()[$i]->getCode() == $cart->getProducts()[$index]->getCode()){
                            echo "add=";
                            $catalogue->getProducts()[$i]->setQuantity($catalogue->getProducts()[$i]->getQuantity() + $quantity);
                            $cart->getProducts()[$index]->setQuantity($cart->getProducts()[$index]->getQuantity() - $quantity);
                            $found = true;
                            break;
                        }
                    }

                    $_SESSION['totalPrice'] = $cart->calculateImport();
                    $_SESSION['nProducts'] = $cart->totProduct();
                    $_SESSION['catalogue'] = $catalogue;
                    $_SESSION['cart'] = $cart;
                    $cart->printProductList();
                    $_POST['quantityToMarket'] = null;

                    showBuyTotal();
            }

    
        
        /*
        else{

        $catalogue = $_SESSION['catalogue'];
        $cart = $_SESSION['cart'];
        
        $cartLen = count($cart->getProducts());

        //rimozione dal carrello
        if(isset($_POST['indexToMarket']) && isset($_POST['quantityToMarket']) && $_POST['quantityToMarket'] > 0){
            $index = $_POST['indexToMarket'];
            $quantity = $_POST['quantityToMarket'];
            
            //$cartLen = count($cart->product);
            
            if($cart->getProducts()[$index]->getQuantity() > $quantity)
                $cart->getProducts()[$index]->setQuantity($cart->getProducts()[$index]->getQuantity() - $quantity);
            else
                $cart->delProduct($index);
        }

        $_SESSION['totalPrice'] = $cart->calculateImport();
        $cart->printProductList();
        $_SESSION['catalogue'] = $catalogue;
        $_SESSION['cart'] = $cart;
        $_POST['quantityToCart'] = null;
    }
    */
        

        //=======btn=========//
        showMarketPlaceBtn();
        //showBuyTotal();

        ?>
    </div>