<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
    class Purchase{
        var $id, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, $amountOwed;

        function Purchase($id, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, $amountOwed){
            $this->id = $id;
            $this->taskId = $taskId;
            $this->item = $item;
            $this->quantity = $quantity;
            $this->unitType = $unitType;
            $this->purchaseDate = $purchaseDate;
            $this->deliveryDate = $deliveryDate;
            $this->supplierName = $supplierName;
            $this->price = $price;
            $this->amountOwed = $amountOwed;
        }

        public static function fromRow($row){
            $id = $row['purchaseId'];
            $taskId = $row['taskId'];
            $item = $row['item'];
            $quantity = $row['quantity'];
            $unitType = $row['unitType'];
            $purchaseDate = $row['purchaseDate'];
            $deliveryDate = $row['deliveryDate'];
            $supplierName = $row['supplierName'];
            $price = $row['price'];
            $amountOwed = $row['amountOwed'];

            return new Purchase($id, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, $amountOwed);
        }

        public static function getAll(){
            $conn = connect();
            $sql = "SELECT * FROM Purchase;";
            $result = $conn->query($sql);
            $purchases = [];
            while ($result && $row = $result->fetch_assoc()) {
                $purchases[] = Purchase::fromRow($row);
            }
            return $purchases;
        }

        function put(){
            $conn = connect();
            $sql = "INSERT INTO Purchase(taskId, item, quantity, unitType, purchaseDate, deliveryDate, supplierName, price, amountOwed) "
            ."VALUE($this->taskId, '$this->item', $this->quantity, '$this->unitType', '$this->purchaseDate', ".($this->deliveryDate ? "'".$this->deliveryDate."'" : "NULL").", '$this->supplierName', $this->price, $this->price);";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">New Purchase created!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
            }
        }
    }
?>