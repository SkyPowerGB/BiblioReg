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
<div class="sg-content">
    <div class="sg-sidebar">

    <div class="sg-sidebar-btn-container">
          <h1 class="sg-sidebar-h1">Izmjeni</h1>
    </div>

        <div class="sg-sidebar-btn-container">
            <button id="editName">Osobni Podaci</button>
        </div>

        <div class="sg-sidebar-btn-container">
            <button id="editEmail">Email</button>
        </div>

        <div class="sg-sidebar-btn-container">
            <button id="editPassword">Lozinka</button>
        </div>

        <div class="sg-sidebar-btn-container">
            <button id="deactivateAccount">Deaktiviraj Račun</button>
        </div>


    </div>

    <div class="sg-content-mid">

    </div>

</div>


<?php
include("../dijelovi/podnozje.php");
?>