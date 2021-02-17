<?php 
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'crud');

    // initialize variables
    $name = "";
    $address = "";
    $emails = "";
    $id = 0;
    $update = false;

    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $emails = $_POST['emails'];

        mysqli_query($db, "INSERT INTO info (name, address, emails) VALUES ('$name', '$address', '$emails')"); 
        $_SESSION['message'] = "Contact saved !!!"; 
        header('location: index.php');
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $emails = $_POST['emails'];

        mysqli_query($db, "UPDATE info SET name='$name', address='$address', emails='$emails' WHERE id=$id");
        $_SESSION['message'] = "Contact updated !!!!"; 
        header('location: index.php');
    }
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM info WHERE id=$id");
        $_SESSION['message'] = "Contact deleted!"; 
        header('location: index.php');
    }