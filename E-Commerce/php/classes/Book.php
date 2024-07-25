<?php
    //includo la superclasse

    class Book extends Product{
        private string $author = "";
        private string $editor = "";
        private int $nPages = 0;

        public function __construct(... $par){
            //1 parameter: OBJECT
            if(func_num_args() == 1 && get_class(func_get_arg(0)) == "Book"){
                //Will be used to transfer in the Cart
                $book = func_get_arg(0);
                $this->code = $book->code;
                $this->title = $book->title;
                $this->description = $book->description;
                $this->picture = $book->picture;
                $this->year = $book->year;
                $this->price = $book->price;
                $this->quantity = $book->quantity;
                $this->author = $book->author;
                $this->editor = $book->editor;
                $this->nPages = $book->nPages;
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
                $this->editor = func_get_arg(7);
                $this->nPages = func_get_arg(8);
            }
        }

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
                . ", " . $this->actualQuantity
                . ", '" . $this->author
                . "', '" . $this->editor 
                . "', " . $this->nPages . ")";
            ?>
                <div class = "product" onclick = "<?php echo $strOnClick;?>">
                    <div id = "productLeft">
                        <img src = "<?php echo $this->picture;?>" class = "imgProduct"><br>
                        <form action="" method = "post">
                        <input type = 'submit' class = "btnCart" value = "Add to cart"
                            <?php if($this->getActualQuantity() <= 0) echo " disabled";?>>
                            
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