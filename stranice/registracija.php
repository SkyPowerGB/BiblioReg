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
    <form  method="POST" action="registracija.php">
        <div class="sg-autentification-row">

            <div class="sg-autentification-col">
                <label>Ime*:</label>
                <input type="text" name="nameInput">
            </div>

            <div class="sg-autentification-col">
                <label>Prezime*:</label>
                <input type="text" name="sNameInput">
            </div>

        </div>


        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <label>Email*:</label>
                <input type="text" name="emailInput">
            </div>
        </div>

        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <label>Lozinka*:</label>
                <input type="password" name="pswrdInput">

                <label>Ponoviti Lozinku*:</label>
                <input type="password" name="pswrdRptInput">

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
        <button class="sg-autentification-scnd-btn">Prijava</button>
    </div>
</div>


<script src="../funkcionalnost/registracija/registracija.js"></script>



<?php
include("../dijelovi/podnozje.php");
?>