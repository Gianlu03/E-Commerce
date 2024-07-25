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
                <input type="text" disabled name = "tot" value = "<?php Echo $_SESSION['cart']->calculateImport() . "€"; ?>">
                <input type="submit" value = "Buy cart" id = "buyBtn" <?php if($_SESSION['cart']->calculateImport() <= 0) echo "disabled"; ?>>
                <input type="hidden" name = "buy" value = "1">
            </form>
        </div>
    <?php   
}