<link href="web/css/marketplace.css" rel="stylesheet" type="text/css">

<?php
    include 'php/view/marketplace.view.php';

    
    ?><div id = "ListBar"><?php
        //=======TITOLO=======//
        showTitle();   
        //====================//

        showBoxDetails();

        //=====CATALOGUE + PRINT====//
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
            $_SESSION['nProducts'] = 0;
            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];
            $catalogue->printProductList();
        }
        else{
            $catalogue = $_SESSION['catalogue'];
            $cart = $_SESSION['cart'];

            if(isset($_POST['quantityToCart']) && $_POST['quantityToCart'] != null && $_POST['quantityToCart'] > 0 && isset($_POST['indexToCart'])){
                $catalogue = $_SESSION['catalogue'];
                $cart = $_SESSION['cart'];
                $cartLen = count($cart->getProducts());
                $index = $_POST['indexToCart'];
                $quantity = $_POST['quantityToCart'];
                echo "$index _ $quantity";

                if($cartLen > 0){
                    $found = false;
                    echo ">0";
                    for($i = 0; $i < $cartLen; $i++)
                        if($cart->getProducts()[$i]->getCode() == $catalogue->getProducts()[$index]->getCode()){
                            echo "add=";
                            $cart->getProducts()[$i]->setQuantity($cart->getProducts()[$i]->getQuantity() + $quantity);
                            $catalogue->getProducts()[$index]->setQuantity($catalogue->getProducts()[$index]->getQuantity() - $quantity);
                            $found = true;
                            break;
                        }

                        if(!$found){
                            echo "add!=";
                            $cart->addProduct($catalogue->getProducts()[$index]);
                            $cart->getProducts()[$cartLen - 1]->setQuantity($quantity);
                            $catalogue->getProducts()[$index]->setQuantity($catalogue->getProducts()[$index]->getQuantity() - $quantity);
                        }
                }
                else{
                    echo "=0";
                    //$_SESSION['cart'] = new Cart();
                    $cart->addProduct($catalogue->getProducts()[$index]);
                    $cart->getProducts()[0]->setQuantity($quantity);
                }

                $_SESSION['totalPrice'] = $cart->calculateImport();
                $_SESSION['nProducts'] = $cart->totProduct();
                $_SESSION['catalogue'] = $catalogue;
                $_SESSION['cart'] = $cart;
                $catalogue->printProductList();

                $_POST['quantityToCart'] = null;
            }
        }

        //==========================//
        $catalogue->printProductList();
        showCartBtn();

        ?>
    </div>
