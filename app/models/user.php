<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/connection.php';
    class User{
        var $userName, $password, $permission;

        function User($userName, $password, $permission){
            $this->userName = $userName;
            $this->password = $password;
            $this->permission = $permission;
        }

        public static function fromRow($row){
            $userName = $row["userName"];
            $password = $row["password"];
            $permission = $row["permission"];
            if(isset($userName))
                return new User($userName, $password, $permission);
            else
                return null;
        }

        function put() {
            $conn = connect();
            $hash = md5($this->password);
            $permission = $this->permission == 0 ? 'client': 'manager';
            $sql = "INSERT INTO Users VALUE('$this->userName', '$hash', '$permission');";
            if ($conn->query($sql) == TRUE) {
                echo '<div class="alert alert-success" role="alert">New user created!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error ' . $sql . ': '. $conn->error.'</div>';
            }
        }

        public static function getUser($userName, $password){
            $conn = connect();
            $sql = "SELECT * FROM Users WHERE userName = '" . $userName . "' AND password = '". hash("md5", $password) ."';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return User::fromRow($row);
        }

        public static function getUserMock($userName, $password){
            // Get from db
            if($userName === 'manager001'){
                return new User($userName, $password, 1);
            } elseif($userName === 'client001'){
                return new User($userName, $password, 0);
            }
            return null;
        }

        public static function updatePassword($userName, $password){
            $conn = connect();
            $sql = "UPDATE Users SET password = '".hash("md5", $password)."' WHERE userName = '$userName';";
            $result = $conn->query($sql);
        }

        public function getUserName(){
            return $this->userName;
        }

        public function isAdmin(){
            return ($this->permission === 'manager' ? true : false);
        }

        public function __toString()
        {
            return $this->userName;
        }
    }
?>