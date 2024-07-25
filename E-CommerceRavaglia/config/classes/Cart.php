<?php

class Cart{
    private $product = array();

    public function __construct(){ 
        $product = array();
    }

    

    public function getProducts(){
        return $this->product;
    }

    public function buyCart(){
        $this->product = array();
    }

    public function addProduct(Product $newProduct){
        /*switch(get_class($newProduct)){
            case "Book":
                //new Book($newProduct->get);
                break;
            case "Cd":
                break;
            case "Dvd":
                break;
            default:
                echo "object not usable";
                break;
        }*/
        array_push($this->product, clone $newProduct);
    }

    public function delProduct($index){
        array_slice($this->product, $index, 1);
    }

    public function printProductList(){
        if(count($this->product) > 0)
            for($i = 0; $i < count($this->product); $i++){
                $this->product[$i]->printInCart($i);
                echo "<hr>";
            }
        else
            echo "<h1 id = 'Message'>Your Cart is empty!</h1>";
    }

    public function calculateImport(){
        $total = 0.0;
        for($i = 0; $i < count($this->product); $i++){
            $total += $this->product[$i]->getPrice() * $this->product[$i]->getQuantity();
        }
        return $total;
    } 

    public function totProduct(){
        $total = 0;
        for($i = 0; $i < count($this->product); $i++){
            $total += $this->product[$i]->getQuantity();
        }
        return $total;
    }

}