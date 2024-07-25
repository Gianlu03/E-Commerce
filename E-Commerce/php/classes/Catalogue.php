<?php

class Catalogue{
    private $product = array();

    public function __construct($product){
        $this->product = $product;
    }

    public function getProducts(){
        return $this->product;
    }

    public function addProduct($newProduct){
        array_push($this->product, $newProduct);
    }

    public function delProduct($index){
        array_splice($this->product, $index, 1);
    }

    //Ognuno deve avere la propria stampa
    public function printProductList(){
        if(count($this->product) > 0)
            for($i = 0; $i < count($this->product); $i++){
                $this->product[$i]->printInCatalogue($i);
                echo "<hr>";
            }
        else
            echo "<h1 id = 'Message'>The marketplace is empty!</h1>";
    }


}