<?php

    // Initialisation
    include "connection.php";
    $conn = openConnection();
    $categories = $conn->query("SELECT * FROM Category");

    // if something should be added
    if(isset($_POST['url']) && !empty($_POST['url']) && isset($_POST['category']) && !isset($_POST['deleteID'])) {

        if(isset($_POST['fav'])) {
            $conn->query("INSERT INTO Link (url, category, fav) VALUES (\"".$_POST['url']."\",".$_POST['category'].",1)");
        } else {
            $conn->query("INSERT INTO Link (url, category) VALUES (\"".$_POST['url']."\",".$_POST['category'].")");
        }

    // if something should be deleted
    } elseif(isset($_POST['deleteID'])) {

        $conn->query("DELETE FROM Link WHERE id=".$_POST['deleteID']);

    }

    closeConnection($conn);

    // redirect back to index
    header("Location: index.php");
    die();

?>