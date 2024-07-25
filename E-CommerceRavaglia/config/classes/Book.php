<?php
    //includo la superclasse

    class Book extends Product{
        private string $author = "";
        private string $editor = "";
        private int $nPages = 0;

        public function __construct($title, $description, $picture, $year, $price, $quantity, 
        $author, $editor, $nPages){
            parent::__construct($title, $description, $picture, $year, $price, $quantity);
            $this->author = $author;
            $this->editor = $editor;
            $this->nPages = $nPages;
        }

        /*
        public function __clone() {
            $this->code = ++self::$code;
        }
        */

        public function setAuthor($author) {$this->author = $author;}
        public function setEditor($editor) {$this->editor = $editor;}
        public function setNPages($nPages) {$this->nPages = $nPages;}

        public function getAuthor() {return $this->author;}
        public function getEditor() {return $this->editor;}
        public function getNPages() {return $this->nPages;}

        public function printInCatalogue($index){
            $className = strtoupper(get_class($this));
            $strOnClick = "showBook(" . $this->year 
                .", " . $this->price
                . ", " . $this->quantity
                . ", '" . $this->author
                . "', '" . $this->editor 
                . "', " . $this->nPages . ")";
            ?>
                <div class = "product" onclick = "<?php echo $strOnClick;?>">
                    <div id = "productLeft">
                        <img src = "<?php echo $this->picture;?>" class = "imgProduct"><br>
                        <form action="" method = "post">
                        <input type = 'submit' class = "btnCart" value = "Add to cart"
                            <?php if($this->quantity == 0) echo " disabled";?>>
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
            $strOnClick = "showBook(" . $this->year 
                .", " . $this->price
                . ", " . $this->quantity
                . ", '" . $this->author
                . "', '" . $this->editor 
                . "', " . $this->nPages . ")";
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