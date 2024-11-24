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

if (isset($_POST["uid"])) {
    $userIdtoEdit = $_POST["uid"];


}
if (isset(($_POST["adminEdit"]))) {

    $adminEdit = $_POST["adminEdit"];
}

if ($userIdtoEdit != $_SESSION["userId"] && !$adminEdit) {
    header("Location: pocetna.php");
}

$korisnik->readUserData($userIdtoEdit);

$update = false;
$validationNotOk = false;


if (isset($_POST["saveFLnames"])) {
    $update = true;
    $newFirstName = filter_input(INPUT_POST, "ime", FILTER_SANITIZE_STRING);
    $newLastName = filter_input(INPUT_POST, "prezime", FILTER_SANITIZE_STRING);

    $validationNotOk = !$korisnik->validacijeImePrezime($newFirstName);
    $validationNotOk = !$korisnik->validacijeImePrezime($newLastName);

    $korisnik->ime = $newFirstName;
    $korisnik->prezime = $newLastName;

    $korisnik->email = null;
    $korisnik->aktivan = true;
    $korisnik->password = null;
}

if (isset($_POST["pswrdChng"])) {
    $update = true;
    $korisnik->ime = null;
    $korisnik->prezime = null;
    $korisnik->aktivan = null;
    $korisnik->email = null;

    $pswrd = filter_input(INPUT_POST, "pswrd", FILTER_SANITIZE_STRING);
    $pswrdRpt = filter_input(INPUT_POST, "paswrdRpt", FILTER_SANITIZE_STRING);

    $validationNotOk = !$korisnik->validacijaSifre($pswrd, $pswrdRpt);
    $pswrd = password_hash($pswrd, PASSWORD_DEFAULT);
    $korisnik->password = $pswrd;



}

if (isset($_POST["chngEmail"])) {
    $update = true;
    $korisnik->ime = null;
    $korisnik->prezime = null;
    $korisnik->aktivan = null;
    $korisnik->password = null;
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    $validationNotOk = !$korisnik->validacijaEmail($email);

    $korisnik->email = $email;

}

if (isset($_POST["chngRole"])) {
   
    $update = true;
    $korisnik->ime = null;
    $korisnik->prezime = null;
    $korisnik->aktivan = null;
    $korisnik->email = null;
    $korisnik->password = null;
    $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRING);
    $korisnik->roleName = $role;
    echo ($korisnik->roleName);
}

if ($update) {

    if ($korisnik->updateUserData()) {
        header("Location:postavke.php");
    }


}


if (isset($_POST["deactivateUAC"])) {
    $update = true;


    $korisnik->aktivan = false;
    $korisnik->password = null;
    $korisnik->email = null;
    if(!$korisnik->isAdmin){
    $korisnik->updateUserData();
    }
    if ($adminEdit) {

    } else {
        Header("Location: logout.php");
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

        <?php if($korisnik->isAdmin){  ?>
        <div class="sg-sidebar-btn-container">
            <button id="editRole">Uloga</button>
        </div>
        <?php } ?>

        <div class="sg-sidebar-btn-container">
            <button id="deactivateAccount" >Deaktiviraj Račun</button>
        </div>


    </div>

    <div class="sg-content-mid">

        <!--Ime / Prezime -->
        <div id="nameSFform" class="sg-autentificaiton-form-container-div sg-hide-div">

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
        <div id="pswrdForm" class="sg-autentificaiton-form-container-div sg-hide-div">

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
        <div id="emailForm" class="sg-autentificaiton-form-container-div sg-hide-div">

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
        <div id="roleForm" class="sg-autentificaiton-form-container-div sg-hide-div">


            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="">
                <div class="sg-autentification-col">
                    <label>Uloga:</label>
                    <select name="role">
                        <?php

                        $currentRole = htmlspecialchars($korisnik->roleName);
                        echo '<option value="' . $currentRole . '" selected>' . $currentRole . '</option>';


                        $sql = "SELECT nazivUloga FROM uloge";
                        $stmt = $conn->prepare($sql);

                        if ($stmt) {
                            if ($stmt->execute()) {
                                $rez = $stmt->get_result();

                                if ($rez) {
                                    while ($row = $rez->fetch_assoc()) {
                                        $role = htmlspecialchars($row["nazivUloga"]);


                                        if ($role !== $currentRole) {
                                            echo '<option value="' . $role . '">' . $role . '</option>';
                                        }
                                    }
                                }
                            } else {

                                echo '<option value="">Error fetching roles</option>';
                            }
                            $stmt->close();
                        } else {

                            echo '<option value="">Database error</option>';
                        }
                        ?>
                    </select>

                </div>

                <div class="sg-autentification-col sg-settings-save-btn">
                    <button name="chngRole">Promjeni ulogu</button>
                </div>

            </form>

        </div>

        <!--deactivate -->
        <div id="confirmDeactivateForm" class="sg-confirm-action-form-container sg-hide-div ">
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
<script src="../funkcionalnost/settings/settings.js"></script>

<?php
include("../dijelovi/podnozje.php");
?>