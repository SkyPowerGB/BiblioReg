<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
$korisnik = new Korisnik($conn);
$firstName;
$lastName;
$email;
$password;
$passwordRpt;

if (isset($_POST["registerSubmit"])) {

    $firstName = filter_input(INPUT_POST, "nameInput", FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, "sNameInput", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "emailInput", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "pswrdInput", FILTER_SANITIZE_STRING);
    $passwordRpt = filter_input(INPUT_POST, "pswrdRptInput", FILTER_SANITIZE_STRING);

    $validationOk = true;

    $validationOk = $korisnik->validacijeImePrezime($firstName);
    $validationOk = $korisnik->validacijeImePrezime($lastName);
    $validationOk = $korisnik->validacijaEmail($email);
    $validationOk = $korisnik->validacijaSifre($password, $passwordRpt);

    if ($validationOk) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $korisnik->registerNewUser($firstName, $lastName, $email, $password);
        Header("Location: prijava.php");
    }

}



?>



<div class="sg-autentificaiton-form-container-div">
    <h1>Registracija</h1>
    <form id="jsAutValidate" method="POST" action="registracija.php">
        <div class="sg-autentification-row">

            <div class="sg-autentification-col">
                <label id="idFnameLbl" >Ime*:</label>
                <input id="idFnameInput" type="text" name="nameInput">
            </div>

            <div class="sg-autentification-col">
                <label id="idLnameLbl" >Prezime*:</label>
                <input id="idLnameInput" type="text" name="sNameInput">
            </div>

        </div>


        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <label id="idEmailLbl" >Email*:</label>
                <input id="idEmailInput" type="text" name="emailInput">
            </div>
        </div>

        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <label id="idPswrdLbl" >Lozinka*:</label>
                <input id="idPswrdInput" type="password" name="pswrdInput">

                <label id="idRptPswrdLbl">Ponoviti Lozinku*:</label>
                <input id="idRptPswrdInput" name="pswrdRptInput">

            </div>

        </div>

        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <div class="sg-autentification-form-btn">
                    <button name="registerSubmit" value="reg">Registracija</button>
                </div>
            </div>

        </div>



    </form>
    <div class="sg-autentification-scnd-btn-div">
        <button id="gotoLoginPageBtn" class="sg-autentification-scnd-btn">Prijava</button>
    </div>
</div>


<script src="../funkcionalnost/autentifikacija/registracija.js"></script>



<?php
include("../dijelovi/podnozje.php");
?>