<?php
require_once('src/model/database.php');

getDb();

// /!\ ETAPE IMPORTANTE A METTRE SUR TOUTES LES PAGES
session_start();

//A PARTIR D'ICI ON PEUT ACCEDER ET UTILISER $_SESSION
//POUR SET UNE SESSION ON FERRA : $_SESSION['laClé'] = $laValeur
//ONT PEUT DEFINIR AUTEMPS DE CLE QUE L ON VEUX
// $_SESSION['CLE1']
// $_SESSION['CLE2']
// $_SESSION['CLE3']
// $_SESSION['CLEn...']
// session_destroy(); => PERMET D'EFFACER LES SESSIONS


?>
<!DOCTYPE html>
<html>
<head>
    <title>Secu Login</title>
</head>
<body>

<?php if (isset($_SESSION['username'])) {
    ?>
    <h1>Bienvenue <?= $_SESSION['username'] ?></h1>

    <a href="logout.php">Deconnexion</a>

    <?php
} else {
    ?>

    <h1>Inscription</h1>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="username"><br><br>
        <input type="email" name="email" placeholder="email"><br><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <br>
        <input type="submit" value="Inscription">

    </form>

    <br><br><br>
    <h1>Connexion</h1>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="username"><br><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <br>
        <input type="submit" value="Connexion">

    </form>
    <?php
}
?>

</body>
</html>