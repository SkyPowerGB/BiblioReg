<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: prijava.php");
}

?>


<?php
include("../dijelovi/univerzalni/navbar.php");

?>

<div>

    <div></div>
    <div></div>


</div>


<?php
include("../dijelovi/podnozje.php");

?>