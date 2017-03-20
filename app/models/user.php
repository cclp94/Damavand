<?php
    class User{
        var $userName, $password, $permission;

        function User($userName, $password, $permission){
            $this->$userName = $userName;
            $this->$password = $password;
            $this->$permission = $permission;
        }

        function getUser($userName, $password){
            // Get from db
        }

        function getUserMock($userName, $password){
            // Get from db
            if($userName == 'manager001'){
                return new User($userName, $password, 1);
            } elseif($userName = 'client001'){
                return new User($userName, $password, 0);
            }
            
        }
    }
?>