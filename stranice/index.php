


<?php 
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
session_start();
if (isset($_SESSION["userId"])) {
    header("Location: pocetna.php");
}
?>

<div class="biblioReg-index-content">

<div class="biblioReg-index-content-box">
    <h1>BiblioReg</h1>
    <div class="biblioReg-index-container">
    <div class="biblioReg-index-button-div">
        <a href="prijava.php">> Prijava</a>
    </div>

    <div class="biblioReg-index-button-div">
        <a href="registracija.php">> Registracija</a>
    </div>
    </div>


    </div>
    </div>

<?php 
include("../dijelovi/podnozje.php");
?>