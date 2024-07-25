<?php
    //includo la superclasse

    class Cd extends Product{
        private $author = "";
        private $executor = "";
        private $duration = 0;

        public function __construct(... $par){
            //1 parameter: OBJECT
            if(func_num_args() == 1 && get_class(func_get_arg(0)) == "Cd"){
                //Will be used to transfer in the Cart
                $cd = func_get_arg(0);
                $this->code = $cd->code;
                $this->title = $cd->title;
                $this->description = $cd->description;
                $this->picture = $cd->picture;
                $this->year = $cd->year;
                $this->price = $cd->price;
                $this->quantity = $cd->quantity;
                $this->author = $cd->author;
                $this->editor = $cd->executor;
                $this->nPages = $cd->duration;
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
                $this->author = func_get_arg(6);
                $this->executor = func_get_arg(7);
                $this->duration = func_get_arg(8);
            }
        }

        /*public function __clone() {
            $this->code = ++self::$code;
        }*/

        public function setAuthor($author) {$this->author = $author;}
        public function setExecutor($executor) {$this->executor = $executor;}
        public function setDuration($duration) {$this->duration = $duration;}

        public function getAuthor() {return $this->author;}
        public function getExecutor() {return $this->executor;}
        public function getDuration() {return $this->duration;}

        public function printInCatalogue($index){
            $className = strtoupper(get_class($this));
            $strOnClick = "showCd(" . $this->year 
                .", " . $this->price
                . ", " . $this->actualQuantity
                . ", '" . $this->author
                . "', '" . $this->executor 
                . "', " . $this->duration . ")";
            ?>
                <div class = "product" onclick = "<?php echo $strOnClick;?>">
                    <div id = "productLeft">
                        <img src = "<?php echo $this->picture;?>" class = "imgProduct"><br>
                        <form action="" method = "post">
                            <input type = 'submit' class = "btnCart" value = "Add to cart"
                            <?php if($this->getActualQuantity()<= 0) echo "disabled";?>>
                            
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
            $strOnClick = "showCd(" . $this->year 
                .", " . $this->price
                . ", " . $this->quantity
                . ", '" . $this->author
                . "', '" . $this->executor 
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