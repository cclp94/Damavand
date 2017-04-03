<?php
    function connect() {
        $servername = "rsc353_4.encs.concordia.ca";
        $username = "rsc353_4";
        $password = "aardvark";
        $db_name = "rsc353_4";

        $conn = mysqli_connect($servername, $username, $password, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
?>