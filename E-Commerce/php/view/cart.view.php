<?php

function showTitle(){
    ?>
        <hr>
            <h1 id = "title" >Your Cart</h1>
        <hr>
    <?php 
}

function showBoxDetails(){
    ?>
        <div id = "DetailsBox">
            Click a product to visualize details!
        </div>
    <?php 
}

function showMarketPlaceBtn(){
    ?>
        <div id = "gotoMarketPlace" onclick="goToMarketPlace()">

        </div>
    <?php
}

function showBuyTotal(){
    ?>
        <div id = "totDiv">
            <form action="" method = "post">
                <input type = "text" disabled id = "totCost" name = "totCost" value = "<?php Echo $_SESSION['cart']->calculateImport() . "€"; ?>">
                <input type = "submit" value = "Buy cart" id = "buyBtn" <?php if($_SESSION['cart']->calculateImport() <= 0) echo "disabled"; ?>>
                <input type = "text" disabled id = "totProducts" name = "nProducts" value = "<?php Echo $_SESSION['cart']->totProduct() . " products"; ?>">
                <input type = "hidden" name = "buy" value = "1">
                <br>
                <br>
            </form>
        </div>
    <?php   
}