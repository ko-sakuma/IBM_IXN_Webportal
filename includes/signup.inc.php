<?php

if (isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    // open connection to ixnportal db
    $link= mysqli_connect('localhost','root','root','ixnportal');
    require_once 'functions.inc.php';

    //check if any input fields are empty
    if(emptyInputsSignup($name, $email, $pwd, $pwdRepeat) !== false) {
        header("location: ../Admin_SignUp.php?error=empty_input");
        exit();
    }
    //check if the email is invalid
    if(invalidEmail($email) !== false) {
        header("location: ../Admin_SignUp.php?error=invalid_email");
        exit();
    }
    //check if $pwd and $pwdRepeat match
    if(pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../Admin_SignUp.php?error=pwdNotMatch");
        exit();
    }
    //check if the email is already registered in the admin
    if(emailExists($link, $email) !== false) {
        header("location: ../Admin_SignUp.php?error=email_exists");
        exit();
    }
    //create a new admin user
    createAdmin($link, $name, $email, $pwd);
    echo $name;
    // RUN mail() here

}
else {
    header("location: ../Admin_SignUp.php");
    exit();
}
