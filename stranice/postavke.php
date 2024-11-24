<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/validator.php");

session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: prijava.php");
}

$userIdtoEdit = $_SESSION["userId"];
$adminEdit = false;
$dispUserDataHeader = "Uredi račun";

$showForm = null;

$korisnik = new Korisnik($conn);
$validator = new Validator();
$isUserAdmin=$korisnik->readUserData($userIdtoEdit);



if (isset($_POST["uid"])) {
    $userIdtoEdit = $_POST["uid"];


}
if (isset(($_POST["adminEdit"]))) {

    $adminEdit = $_POST["adminEdit"];
    $dispUserDataHeader = "Uredi Korisnika";

}
// TO DO zamijeniti admin edit sa korisnik->isAdmin($id)  (treba napraviti metodu isAdmin($id))
if ($userIdtoEdit != $_SESSION["userId"] && !$adminEdit) {
    header("Location: pocetna.php");
}


$korisnik->readUserData($userIdtoEdit);

$update = false;




// validator FormInput vars
$fNameInput;
$lNameInput;
$emailInput;
$pswrdInput;
$pswrdRptInput;
// validator FormInput vars prepare   , if-> za zatvoriti dijelove
if (true) {
    //ime
    if (true) {
        $fNameInput = new FormInput(
            "idFnameInput",
            "idFnameLbl",
            "ime",
            "text",
            $korisnik->ime,
            "Ime:",
            null,
            null

        );
    }
    //prezime
    if (true) {
        $lNameInput = new FormInput(
            "idLnameInput",
            "idLnameLbl",
            "prezime",
            "text",
            $korisnik->prezime,
            "Prezime:",
            null,
            null
        );
    }
    //email
    if (true) {
        $emailInput = new FormInput(
            "idEmailInput",
            "idEmailLbl",
            "email",
            "text",
            $korisnik->email,
            "Email*:",
            null,
            null
        );
    }
    //pswrd
    if (true) {
        $pswrdInput = new FormInput(
            "idPswrdInput",
            "idPswrdLbl",
            "pswrd",
            "password",
            "",
            "Lozinka*:",
            null,
            null
        );
    }
    //pswrdRpt
    if (true) {

        $pswrdRptInput = new FormInput(
            "idRptPswrdInput",
            "idRptPswrdLbl",
            "paswrdRpt",
            "password",
            "",
            "Ponoviti Lozinku*:",
            null,
            null
        );
    }
}

$validationOk = true;
if (isset($_POST["saveFLnames"])) {
    $showForm = "saveFLnames";
    $update = true;
    $newFirstName = filter_input(INPUT_POST, "ime", FILTER_SANITIZE_STRING);
    $newLastName = filter_input(INPUT_POST, "prezime", FILTER_SANITIZE_STRING);

    if (!$korisnik->validacijeImePrezime($newFirstName) && $validationOk) {
        $validationOk = false;
        $validator->showValidationMsg($fNameInput, $korisnik->getValidationMsg());
    }
    if (!$korisnik->validacijeImePrezime($newLastName) && $validationOk) {
        $validator->showValidationMsg($lNameInput, $korisnik->getValidationMsg());
        $validationOk = false;
    }
    echo ("yas" . $update . "/" . $validationOk);
    $korisnik->ime = $newFirstName;
    $korisnik->prezime = $newLastName;

    $korisnik->email = null;
    $korisnik->aktivan = true;
    $korisnik->password = null;
}

if (isset($_POST["pswrdChng"])) {
    $showForm = "pswrdChng";
    $update = true;
    $korisnik->ime = null;
    $korisnik->prezime = null;
    $korisnik->aktivan = null;
    $korisnik->email = null;

    $pswrd = filter_input(INPUT_POST, "pswrd", FILTER_SANITIZE_STRING);
    $pswrdRpt = filter_input(INPUT_POST, "paswrdRpt", FILTER_SANITIZE_STRING);

    if (!$korisnik->validacijaSifre($pswrd, $pswrdRpt) && $validationOk) {
        $validator->showValidationMsg($pswrdInput,$korisnik->getValidationMsg());
        $validationOk = false;

    }

    $pswrd = password_hash($pswrd, PASSWORD_DEFAULT);
    $korisnik->password = $pswrd;



}

if (isset($_POST["chngEmail"])) {
    $showForm = "chngEmail";
    $update = true;
    $korisnik->ime = null;
    $korisnik->prezime = null;
    $korisnik->aktivan = null;
    $korisnik->password = null;
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    if (!$korisnik->validacijaEmail($email) && $validationOk) {
        $validationOk = false;
        $validator->showValidationMsg($emailInput,$korisnik->getValidationMsg());
    }

    $korisnik->email = $email;

}

if (isset($_POST["chngRole"])) {

    $showForm = "chngRole";
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

if ($update && $validationOk) {

    if ($korisnik->updateUserData() && !$adminEdit) {
        header("Location:postavke.php");
    } else {
        header("Location:korisnici.php");
    }


} else {
    unset($_POST["saveFLnames"]);
    unset($_POST["pswrdChng"]);
    unset($_POST["chngEmail"]);
    unset($_POST["chngRole"]);

}


if (isset($_POST["deactivateUAC"])) {

    $update = true;
    $korisnik->aktivan = false;
    $korisnik->password = null;
    $korisnik->email = null;
    if (!$korisnik->isAdmin) {
        $korisnik->updateUserData();
    }
    if ($korisnik->userId == $_SESSION["userId"]) {
        header("Location: logout.php");
    }
    if ($adminEdit) {
        Header("Location: korisnici.php");
    } else {
        Header("Location: logout.php");
    }


}


?>


<?php
include("../dijelovi/univerzalni/navbar.php");
$korisnik->readUserData($userIdtoEdit);
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

        <?php if ($adminEdit||$isUserAdmin) { ?>
            <div class="sg-sidebar-btn-container">
                <button id="editRole">Uloga</button>
            </div>
        <?php } ?>

        <div class="sg-sidebar-btn-container">
            <button id="deactivateAccount">Deaktiviraj Račun</button>
        </div>


    </div>

    <div class="sg-content-mid">

        <!-- Display-->
        <div id="setingsDisplayUserData">
            <div class="sg-set-disp-user-data-main-container">
                <div class="sg-set-disp-user-data-sub-container">

                    <div class="sg-disp-user-data-container-section">

                        <h1> <?php echo ($dispUserDataHeader) ?></h1>
                    </div>

                    <div class="sg-disp-user-data-container-section">
                        <h2>Prezime Ime:</h1>
                            <h3><?php echo ($korisnik->prezime . " " . $korisnik->ime) ?></h3>
                    </div>

                    <div class="sg-disp-user-data-container-section">
                        <h2>Email:</h2>
                        <h3><?php echo ($korisnik->email) ?></h3>
                    </div>


                    <div class="sg-disp-user-data-container-section">
                        <h2>Uloga:</h2>
                        <h3><?php echo ($korisnik->roleName) ?></h3>
                    </div>
                </div>
            </div>



        </div>

        <!--Ime / Prezime -->
        <div id="nameSFform" class="sg-autentificaiton-form-container-div sg-hide-div">

            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <?php $fNameInput->generateInput(); ?>

                </div>

                <div class="sg-autentification-col">
                    <?php $lNameInput->generateInput(); ?>
                </div>

                <div class="sg-autentification-col sg-settings-save-btn">

                    <button name="saveFLnames">Spremi promjene</button>
                </div>

            </form>

        </div>

        <!--email -->
        <div id="emailForm" class="sg-autentificaiton-form-container-div sg-hide-div">

            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <?php $emailInput->generateInput(); ?>
                </div>

                <div class="sg-autentification-col sg-settings-save-btn">
                    <button name="chngEmail">Promjeni Email</button>
                </div>

            </form>

        </div>


        <!--Lozinka -->
        <div id="pswrdForm" class="sg-autentificaiton-form-container-div sg-hide-div">

            <form method="POST" action="postavke.php" class="sg-account-sttings-form">
                <input type="hidden" name="uid" value="<?php echo ($userIdtoEdit) ?>">
                <input type="hidden" name="adminEdit" value="<?php echo ($adminEdit) ?>">
                <div class="sg-autentification-col">
                    <?php $pswrdInput->generateInput(); ?>
                </div>

                <div class="sg-autentification-col">
                    <?php $pswrdRptInput->generateInput(); ?>
                </div>
                <div class="sg-autentification-col sg-settings-save-btn">
                    <button name="pswrdChng">Promjeni lozinku</button>
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
<script>

    <?php
    switch ($showForm) {
        case "saveFLnames":
            echo ("openNameSFform();");
            break;
        case "pswrdChng":
            echo ("openPswrdSFform();");
            break;
        case "chngEmail":
            echo ("openEmailForm();");
            break;

        case "chngRole":
            echo ("openRoleForm();");
            break;
    }

    ?>



</script>
<?php




include("../dijelovi/podnozje.php");
?>