<?php

function showTitle(){
    ?>
        <hr>
            <h1 id = "title" >Products</h1>
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

function showCartBtn(){
    ?>
        <div id = "gotoCart" onclick="goToCart()">

        </div>
        <div id = "nProducts"> 
            <?php echo $_SESSION['nProducts'];?> 
        </div>
    <?php
}