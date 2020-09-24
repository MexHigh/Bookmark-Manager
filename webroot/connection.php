<?php
    function openConnection() {
        $host = "<db-host>";
        $user = "<db-user>";
        $pass = "<db-pass>";
        $db = "<db-name>";

        $conn = new mysqli($host, $user, $pass, $db) or die("Connection failed".$conn -> error);

        return $conn;
    }
    function closeConnection($conn) {
        $conn -> close();
    }
?>
