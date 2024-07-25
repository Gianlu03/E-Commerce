<?php
    //includo la superclasse

    class Dvd extends Product{
        private $director = "";
        private $productor = "";
        private $duration = 0;

        public function __construct($title, $description, $picture, $year, $price, $quantity, 
                                    $director, $productor, $duration){
                                        
            parent::__construct($title, $description, $picture, $year, $price, $quantity);
            $this->director = $director;
            $this->productor = $productor;
            $this->duration = $duration;
        }

        /*public function __clone() {
            $this->code = ++self::$code;
        }*/

        public function setDirector($director) {$this->director = $director;}
        public function setProductor($productor) {$this->productor = $productor;}
        public function setDuration($duration) {$this->duration = $duration;}

        public function getDirector() {return $this->director;}
        public function getProductor() {return $this->productor;}
        public function getDuration() {return $this->duration;}

        public function printInCatalogue($index){
            $className = strtoupper(get_class($this));
            $strOnClick = "showDvd(" . $this->year 
                .", " . $this->price
                . ", " . $this->quantity
                . ", '" . $this->director
                . "', '" . $this->productor 
                . "', " . $this->duration . ")";
            ?>
                <div class = "product" onclick = "<?php echo $strOnClick;?>">
                    <div id = "productLeft">
                        <img src = "<?php echo $this->picture;?>" class = "imgProduct"><br>
                        <form action="" method = "post">
                        <input type = 'submit' class = "btnCart" value = "Add to cart"
                            <?php if($this->quantity == 0) echo "disabled";?>>
                            <select name="quantityToCart" class = "selectQuantity">
                                <?php
                                    echo "<option value = '0'>0</option>";
                                    for($i = 1; $i <= $this->quantity; $i++)
                                        echo "<option value = '$i'>$i</option>";
                                ?>
                            </select>
                            <input type ='hidden' name = 'indexToCart' value = <?php echo $index;?>>
                        </form>
                    </div>
                    <div id = "productRight">
                        <span class = "infoProduct">
                            <?php 
                                parent::print();
                            ?>
                        </span>
                    </div>
                </div>
            <?php
        }

        public function printInCart($index){
            $className = strtoupper(get_class($this));
            $strOnClick = "showDvd(" . $this->year 
                .", " . $this->price
                . ", " . $this->quantity
                . ", '" . $this->director
                . "', '" . $this->productor 
                . "', " . $this->duration . ")";
            ?>
                <div class = "product" onclick = "<?php echo $strOnClick;?>">
                    <div id = "productLeft">
                        <img src = "<?php echo $this->picture;?>" class = "imgProduct"><br>
                        <form action="" method = "post">
                            <input type = 'submit' class = "btnCart" value = "Remove">
                            <select name="quantityToMarket" class = "selectQuantity">
                                <?php
                                    echo "<option value = '0'>0</option>";
                                    for($i = 1; $i <= $this->quantity; $i++)
                                        echo "<option value = '$i'>$i</option>";
                                ?>
                            </select>
                            <input type ='hidden' name = 'indexToMarket' value = <?php echo $index;?>>
                        </form>
                    </div>
                    <div id = "productRight">
                        <span class = "infoProduct">
                            <?php 
                                parent::print();
                            ?>
                        </span>
                    </div>
                </div>
            <?php
        }


    }