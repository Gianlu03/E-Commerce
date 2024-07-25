<?php

    class Product{
        protected static int $nProduct = 0;
        protected int $code = 0;
        protected string $title = "";
        protected string $description = "";
        protected string $picture = "";
        protected int $year = 0;
        protected float $price = 0.0;
        protected int $quantity = 0;
        protected int $actualQuantity = 0;

        public function __construct($title, $description, $picture, $year, $price, $quantity){
            $this->title = $title;
            $this->description = $description;
            $this->picture = $picture;
            $this->year = $year;
            $this->price = $price;
            $this->quantity = $quantity;
            self::$nProduct++;
            $this->code = self::$nProduct;
            $this->actualQuantity = $quantity;
        }

        public function setCode($code) {$this->code = $code;}
        public function setTitle($title) {$this->title = $title;}
        public function setDescription($description) {$this->description = $description;}
        public function setPicture($picture) {$this->picture = $picture;}
        public function setYear($year) {$this->year = $year;}
        public function setPrice($price) {$this->price = $price;}
        public function setQuantity($quantity) {$this->quantity = $quantity;}
        public function setActualQuantity($actualQuantity) {$this->actualQuantity = $actualQuantity;}

        public function getCode() {return $this->code;}
        public function getTitle() {return $this->title;}
        public function getDescription() {return $this->description;}
        public function getPicture() {return $this->picture;}
        public function getYear() {return $this->year;}
        public function getPrice() {return $this->price;}
        public function getQuantity() {return $this->quantity;}
        public function getActualQuantity() {return $this->actualQuantity;}

        public function print(){
            echo "<b>Titolo:</b> " . $this->title . "<br>";
            echo "<b>Categoria:</b> " . strtoupper(get_class($this)) . "<br>";
            echo "<b>Descrizione:</b> <br>" . $this->description;
        }

    }