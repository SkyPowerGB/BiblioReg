<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");

session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: prijava.php");
}
$userIdtoEdit = $_SESSION["userId"];
$adminEdit = false;

$korisnik = new Korisnik($conn);

if (isset($_POST["uid"])  ) {
    $userIdtoEdit = $_POST["uid"];
    
    
}
if(isset(($_POST["adminEdit"]))){

    $adminEdit = $_POST["adminEdit"];
}




$korisnik->readUserData($userIdtoEdit);

$update = false;
$validationNotOk=false;
if (isset($_POST["saveFLnames"])) {
    $update = true;
    $newFirstName = filter_input(INPUT_POST, "ime", FILTER_SANITIZE_STRING);
    $newLastName = filter_input(INPUT_POST, "prezime", FILTER_SANITIZE_STRING);

    $validationNotOk=!$korisnik->validacijeImePrezime($newFirstName);
    $validationNotOk=!$korisnik->validacijeImePrezime($newLastName);
   
   $korisnik->ime=$newFirstName;
   $korisnik->prezime=$newLastName;
  
    $korisnik->email=null;
    $korisnik->aktivan=true;
    $korisnik->password=null;
}
if (isset($_POST["pswrdChng"])) {
    $update = true;
    $korisnik->ime=null;
    $korisnik->prezime=true;
    $korisnik->aktivan=null;


    
}
if (isset($_POST["chngEmail"])) {
    $update = true;
}
if (isset($_POST["chngRole"])) {
    $update = true;
}
if (isset($_POST["deactivateUAC"])) {
    $update = true;



}

if ($update&& !$validationNotOk) {
  
 if($korisnik->updateUserData()){
     header("Location:postavke.php");
 }


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
            <button id="editPassword">Uloga</button>
        </div>


        <div class="sg-sidebar-btn-container">
            <button id="deactivateAccount">Deaktiviraj Račun</button>
        </div>


    </div>

    <div class="sg-content-mid">

        <!--Ime / Prezime -->
        <div class="sg-autentificaiton-form-container-div">

            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <label>Ime:</label>

                    <input name="ime" value="<?php echo ($korisnik->ime) ?>">
                </div>

                <div class="sg-autentification-col">
                    <label>Prezime:</label>
                    <input name="prezime" value="<?php echo ($korisnik->prezime) ?>">
                </div>

                <div class="sg-autentification-col sg-settings-save-btn">

                    <button name="saveFLnames">Spremi promjene</button>
                </div>

            </form>

        </div>

        <!--Lozinka -->
        <div class="sg-autentificaiton-form-container-div">

            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <label>Nova lozinka:</label>
                    <input name="pswrd">
                </div>

                <div class="sg-autentification-col">
                    <label>Ponovi Lozinku:</label>
                    <input name="paswrdRpt">
                </div>
                <div class="sg-autentification-col sg-settings-save-btn">
                    <button name="pswrdChng">Promjeni lozinku</button>
                </div>
            </form>

        </div>

        <!--email -->
        <div class="sg-autentificaiton-form-container-div">

            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <label>Email adresa</label>
                    <input name="email" value="<?php echo ($korisnik->email) ?>">
                </div>

                <div class="sg-autentification-col sg-settings-save-btn">
                    <button name="chngEmail">Promjeni Email</button>
                </div>

            </form>

        </div>

        <!--role -->
        <div class="sg-autentificaiton-form-container-div">

            <form class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <label>Uloga:</label>
                    <input name="role">
                </div>

                <div class="sg-autentification-col sg-settings-save-btn">
                    <button name="chngRole">Promjeni ulogu</button>
                </div>

            </form>

        </div>

        <!--deactivate -->
        <div class="sg-confirm-action-form-container sg-hide-div ">
            <h1>Jeste li sigurni da žeilite deaktivirati račun</h1>
            <div class="sg-confirm-action-form-container-buttons">
                <button id="sgConfirmActionBtnCancel">odustani</button>
                <form method="POST" action="postavke.php">
                    <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                    <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                    <button name="deactivateUAC" id="sgConfirmActionBtnOk">Deaktiviraj </button>
                </form>
            </div>

        </div>




    </div>

</div>


<?php
include("../dijelovi/podnozje.php");
?>