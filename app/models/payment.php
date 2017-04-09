<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
    class Payment{
        var $paymentNum, $purchaseId, $date, $amount;

        function Payment($paymentNum, $purchaseId, $date, $amount){
            $this->paymentNum= $paymentNum;
            $this->purchaseId = $purchaseId;
            $this->date = $date;
            $this->amount = $amount;
        }

        public static function fromRow($row){
            $paymentNum = $row['paymentNum'];
            $purchaseId = $row['purchaseId'];
            $date = $row['date'];
            $amount = $row['amount'];

            return new Payment($paymentNum, $purchaseId, $date, $amount);
        }

        function put(){
            $conn = connect();
            $sql = "INSERT INTO Payments(purchaseId, date, amount) "
            ."VALUE($this->purchaseId, '$this->date', $this->amount);";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">Payment Made!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
            }
        }

        function getAllForPurchase($purchaseId){
            $conn = connect();
            $sql = "SELECT * from Payments WHERE purchaseId = $purchaseId;";
            $result = $conn->query($sql);
            $payments = [];
            while ($result && $row = $result->fetch_assoc()) {
                $payments[] = Payment::fromRow($row);
            }
            return $payments;
        }

        public static function getAll(){
            $conn = connect();
            $sql = "SELECT * from Payments;";
            $result = $conn->query($sql);
            $payments = [];
            while ($result && $row = $result->fetch_assoc()) {
                $payments[] = Purchase::fromRow($row);
            }
            return $payments;
        }
    }
?>