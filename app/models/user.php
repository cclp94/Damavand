<?php
    class User{
        var $userName, $password, $permission;

        function User($userName, $password, $permission){
            $this->userName = $userName;
            $this->password = $password;
            $this->permission = $permission;
        }

        public static function getUser($userName, $password){
            // Get from db
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

        public function getUserName(){
            return $this->userName;
        }

        public function isAdmin(){
            return $this->permission;
        }

        public function __toString()
        {
            return $this->userName;
        }
    }
?>