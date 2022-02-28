<?php

if (isset($_POST["submit"])) {

    $email = $_POST['email'];
    $pwd = $_POST["pwd"];

    // open connection to ixnportal db
    $link = mysqli_connect('localhost', 'root', 'root', 'ixnportal');
    require_once 'functions.inc.php';

    //check if any input fields are empty
    if (emptyInputsLogin($email, $pwd) !== false) {
        header("location: ../login.php?error=empty_input");
        exit();
    }

    //log in as admin
    loginAdmin($link, $email, $pwd);
    }
    else {
        header("location: ../login.php");
        exit();
    }
