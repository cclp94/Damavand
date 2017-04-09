<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';

class Purchase {
    var $id, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, $amountOwed;

    function Purchase($id, $taskId, $item, $quantity, $unitType, $purchaseDate, $deliveryDate, $supplierName, $price, $amountOwed) {
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

    public static function fromRow($row) {
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

    public static function getAll($taskId){
        $sql = "SELECT *
                FROM Purchase
                WHERE taskId = $taskId";
        $result = query($sql);
        $purchases = [];
        while ($result && $row = $result->fetch_assoc()) {
            $purchases[] = Purchase::fromRow($row);
        }
        return $purchases;
    }

    function put() {
        $conn = connect();
        $deliveryDate = $this->deliveryDate ? "'$this->deliveryDate'" : "NULL";
        $sql = "INSERT INTO Purchase(taskId, item, quantity, unitType, purchaseDate, deliveryDate, supplierName, price, amountOwed)
                VALUE($this->taskId, '$this->item', $this->quantity, '$this->unitType', '$this->purchaseDate', $deliveryDate,
                      '$this->supplierName', $this->price, $this->price);";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo '<div class="alert alert-success" role="alert">New Purchase created!</div>';
        }
    }

    function update() {
        $deliveryDate = $this->deliveryDate ? "'$this->deliveryDate'" : "NULL";
        $sql = "UPDATE Purchase
                SET item = '$this->item',
                    quantity = $this->quantity,
                    unitType = '$this->unitType',
                    purchaseDate =' $this->purchaseDate',
                    deliveryDate = $deliveryDate,
                    supplierName = '$this->supplierName',
                    price = $this->price
                WHERE purchaseId = $this->id;";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo '<div class="alert alert-success" role="alert">Purchase updated!</div>';
        }
    }

    public static function get($id) {
        $sql = "SELECT *
                FROM Purchase
                WHERE purchaseId = $id";
        return Purchase::fromRow(query($sql)->fetch_assoc());
    }
}
?>