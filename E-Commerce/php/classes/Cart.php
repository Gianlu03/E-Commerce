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

        $class = get_class($newProduct);
        switch($class){
            case "Book":
                $obj = new Book($newProduct);
                break;
            case "Cd":
                $obj = new Cd($newProduct);
                break;
            case "Dvd":
                $obj = new Dvd($newProduct);
                break;
            default:
                echo "object not usable";
        }
        array_push($this->product, $obj);        
    }

    public function delProduct($index){
        array_splice($this->product, $index, 1);
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
        if($total <= 0)
            return 0;
        return $total;
    } 

    public function totProduct(){
        $total = 0;
        for($i = 0; $i < count($this->product); $i++){
            $total += $this->product[$i]->getQuantity();
        }
        if($total <= 0)
            return 0;
        return $total;
    }

}