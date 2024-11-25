<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/validator.php");
include("../dijelovi/klase/FileUpload.php");

$korisnik = new Korisnik($conn);
$validator = new Validator();
$fileUploader=new FileUpload();

$firstName = null;
$lastName = null;
$avatarPth=nulL;
$email = null;
$password=null;
$passwordRpt=null;

$fNameInput = new FormInput(
    "idFnameInput",
    "idFnameLbl",
    "nameInput",
    "text",
    $firstName,
    "Ime*:",
    null,
    null

);
$lNameInput = new FormInput(
    "idLnameInput",
    "idLnameLbl",
    "sNameInput",
    "text",
    $lastName,
    "Prezime*:",
    null,
    null
);
$inputAvatar =new FormInput(
    "idAvatarInput",
    "idAvatarLbl",
    "avatarImgFile",
    "file",
    null,
    "Slika:",
    null,
    null

);

$emailInput = new FormInput(
    "idEmailInput",
    "idEmailLbl",
    "emailInput",
    "text",
    $email,
    "Email*:",
    null,
    null
);

$pswrdInput= new FormInput(
    "idPswrdInput",
    "idPswrdLbl",
    "pswrdInput",
    "password",
    $password,
    "Lozinka*:",
    null,
    null
);


$pswrdRptInput=new FormInput(
    "idRptPswrdInput",
    "idRptPswrdLbl",
    "pswrdRptInput",
    "password",
    $passwordRpt,
    "Ponoviti Lozinku*:",
    null,
    null
);







?>


<script src="../funkcionalnost/autentifikacija/registracija.js"></script>

<?php

if (isset($_POST["registerSubmit"])) {

    $firstName = filter_input(INPUT_POST, "nameInput", FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, "sNameInput", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "emailInput", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "pswrdInput", FILTER_SANITIZE_STRING);
    $passwordRpt = filter_input(INPUT_POST, "pswrdRptInput", FILTER_SANITIZE_STRING);

  
    $validationOk = true;
 
    
    


    if (!$korisnik->validacijeImePrezime($firstName)) {
        $validator->showValidationMsg($fNameInput,$korisnik->getValidationMsg());
        $validationOk = false;
    }
    ;
    if (!$korisnik->validacijeImePrezime($lastName)) {
        $validationOk = false;
    }
    if (!$validationOk = $korisnik->validacijaEmail($email)) {
        $validator->showValidationMsg($emailInput,$korisnik->getValidationMsg());
        $validationOk = false;
    }
    if (!$validationOk = $korisnik->validacijaSifre($password, $passwordRpt)) {
        $validator->showValidationMsg($pswrdInput,$korisnik->getValidationMsg());
        $validationOk = false;
    }


    //ako je prosao validaciju provedi upload
    if(!$fileUploader->isFileEmpty($inputAvatar->inputName)&&$validationOk){
        if(!$fileUploader->validateImgFileUpload($inputAvatar->inputName)){
            $validationOk=false;
             $validator->showValidationMsg($inputAvatar,"neispravna datoteka");
        }else{
            if($fileUploader->UploadFile($inputAvatar->inputName)){
                $fileUploader->DeleteFile($avatarPth);
               $avatarPth=$fileUploader->lastUploadFilePath;
               $validationOk=true;
                
            }else{
                $validationOk=false;
                $validator->showValidationMsg($inputAvatar,"file upload error");
            }
        }

    }else{
        $avatarPth=$fileUploader->avatarDefaultPth;
    }
    
    echo("avatarPth:".$avatarPth);
    if ($validationOk) {
      echo("avatarPth:".$avatarPth);
        $password = password_hash($password, PASSWORD_DEFAULT);
       if( $korisnik->registerNewUserV2($firstName, $lastName, $avatarPth,$email, $password)){
      
       }
    }

}



?>



<div class="sg-autentificaiton-form-container-div">
    <h1>Registracija</h1>
    <form method="POST" action="registracija.php" enctype="multipart/form-data">
        <div class="sg-autentification-row">


            <div class="sg-autentification-col">
                <?php
                $fNameInput->generateInput();
                ?>

            </div>

            <div class="sg-autentification-col">
                <?php
                $lNameInput->generateInput();
                ?>
            </div>

        </div>
        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <?php
                $inputAvatar->generateInput();
                ?>
            </div>
        </div>


        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <?php
                $emailInput->generateInput();
                ?>
            </div>
        </div>

        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
            <?php
                $pswrdInput->generateInput();
                $pswrdRptInput->generateInput();
                ?>

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






<?php
include("../dijelovi/podnozje.php");
?>