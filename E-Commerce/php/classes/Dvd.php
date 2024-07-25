<?php
    //includo la superclasse

    class Dvd extends Product{
        private $director = "";
        private $productor = "";
        private $duration = 0;

        public function __construct(... $par){
            //1 parameter: OBJECT
            if(func_num_args() == 1 && get_class(func_get_arg(0)) == "Dvd"){
                //Will be used to transfer in the Cart
                $dvd = func_get_arg(0);
                $this->code = $dvd->code;
                $this->title = $dvd->title;
                $this->description = $dvd->description;
                $this->picture = $dvd->picture;
                $this->year = $dvd->year;
                $this->price = $dvd->price;
                $this->quantity = $dvd->quantity;
                $this->director = $dvd->director;
                $this->productor = $dvd->productor;
                $this->duration = $dvd->duration;
            }
            //9 parameters: VALUES
            elseif(func_num_args() == 9){
                parent::__construct(
                    func_get_arg(0),
                    func_get_arg(1),
                    func_get_arg(2),
                    func_get_arg(3),
                    func_get_arg(4),
                    func_get_arg(5),
                );
                $this->director = func_get_arg(6);
                $this->productor = func_get_arg(7);
                $this->duration = func_get_arg(8);
            }
        }

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
                . ", " . $this->actualQuantity
                . ", '" . $this->director
                . "', '" . $this->productor 
                . "', " . $this->duration . ")";
            ?>
                <div class = "product" onclick = "<?php echo $strOnClick;?>">
                    <div id = "productLeft">
                        <img src = "<?php echo $this->picture;?>" class = "imgProduct"><br>
                        <form action="" method = "post">
                        <input type = 'submit' class = "btnCart" value = "Add to cart"
                            <?php if($this->getActualQuantity() <= 0) echo "disabled";?>>
                            
                            <select name="quantityToCart" class = "selectQuantity"
                            <?php if($this->getActualQuantity() <= 0) echo " disabled";?>>
                                <?php
                                    echo "<option value = '0'>0</option>";
                                    for($i = 1; $i <= $this->actualQuantity; $i++)
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