<?php
require_once "src/model/database.php";
$db = getDb();
session_start();
function cryptPassword($text)
{
    return password_hash($text, PASSWORD_DEFAULT);
}


if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    echo "Il manque des champs";
} else {
    $defaultPerms = "user";

    /**
     * PB 1 => SECURITE DE CHAMPS
     * PB 2 => MOT DE PASSE NON SECURE !!!!
     */
    //Resolution PB1 : htmlspecialchars()
    $username = htmlspecialchars($_POST['username']);
    $password = cryptPassword(htmlspecialchars($_POST['password']));
    $email = htmlspecialchars($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Valid";
    }else{
        echo "unvalid";
    }

    //Resolution PB 2 ?
    // on va vouloir utiliser un algorithme de hash il en existe plusieurs :
    // md5 (Pas conseiller du tout et très faible) SHA-1 SHA-256 etc...
    // on va comme pour symfony utiliser bcrypt


    /**
     * PB 3 LE CHAMP username EST IL DEJA REMPLI PAR QQN  ?
     * PB 4 Le CHAMP email EST IL DEJA REMPLI PAR QQN ?
     */

    $sqlInsertProduct = "INSERT INTO user (username, password, email, permission) VALUES(?, ?, ?, ?)";
    $reqInsertProduct = $db->prepare($sqlInsertProduct);
    $reqInsertProduct->bindParam(1, $username);
    $reqInsertProduct->bindParam(2, $password);
    $reqInsertProduct->bindParam(3, $email);
    $reqInsertProduct->bindParam(4, $defaultPerms);
    try {
        $reqInsertProduct->execute();
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['permission'] = $defaultPerms;
        header('Location: index.php');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


}
