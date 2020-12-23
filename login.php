<?php
require_once "src/model/database.php";
$db = getDb();
session_start();

function checkPassword($text, $password)
{
    return password_verify($text, $password);
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    echo "Il manque des champs";
} else {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sqlSelect = "SELECT * FROM user WHERE username = ? ";
    $reqSelect = $db->prepare($sqlSelect);
    $reqSelect->bindParam(1, $username);
    $reqSelect->execute();
    $userData = $reqSelect->fetchObject();

    if ($userData === false) {
        echo "Invalid credentials";
    } else {
        if (checkPassword($password, $userData->password)) {
            $_SESSION['username'] = $userData->username;
            $_SESSION['email'] = $userData->email;
            $_SESSION['permission'] = $userData->permission;
            header('Location: index.php');
        } else {
            echo "Invalid credentials";
        }
    }


}