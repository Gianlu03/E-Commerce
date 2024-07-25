<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Gianluca Ravaglia 5J</title>
    <link href="web/css/index.css" rel="stylesheet" type="text/css">
    <link href="web/css/marketplace.css" rel="stylesheet" type="text/css">
    <link href="web/css/cart.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="web/img/logo.jpg">
    <script src = "web/js/functions.js"></script>
</head>

<body>

    <?php
        include 'config/config.php';


        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action){
                case 'marketplace':
                    include 'php/controller/MarketPlace.controller.php';
                    break;
                case 'cart':
                    include 'php/controller/cart.controller.php';
                    break;
                default :
                    include 'php/controller/MarketPlace.controller.php';
                    break;
            }
        }
        else{
            include 'php/controller/MarketPlace.controller.php';
        }

    ?>

</body>

</html>