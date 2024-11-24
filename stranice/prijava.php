
<?php 
session_start();
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/validator.php");
$validator = new Validator();




$korisnik = new Korisnik($conn);

$email=null;
$password=null;


$emailInput = new FormInput(
    "idEmailInput",
    "idEmailLbl",
    "emailInput",
    "text",
    $email,
    "Email:",
    null,
    null
);

$pswrdInput= new FormInput(
    "idPswrdInput",
    "idPswrdLbl",
    "pswrdInput",
    "password",
    $password,
    "Lozinka:",
    null,
    null
);


if (isset($_POST["loginSubmit"])) {

   
    $email = filter_input(INPUT_POST, "emailInput", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "pswrdInput", FILTER_SANITIZE_STRING);
  

    $validationOk = true;

 
   
  

 
      
        if($korisnik->getPasswordReadId($email)){
            $var=$korisnik->userId;
            $hash=$korisnik->password;
            
         
            if(password_verify($password,$hash)){
  
                  $_SESSION["userId"]=$var;
               header("Location: pocetna.php");
                   
                  

            }else{
                $emailInput->inputDefaultValue=$email;
                $validator->showValidationMsg($emailInput,"Neispranvno korisničko  ime ili lozinka");
                $validator->showValidationMsg($pswrdInput,"");
            }

               

        }else{
        $validator->showValidationMsg($emailInput,"Korisnik ne postoji");
        }


      
      
       
    }



?>


<div class="sg-autentificaiton-form-container-div">
    <h1>Prijava</h1>
    <form method="POST" action="prijava.php">
      
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
                ?>
         
            </div>

        </div>

        <div class="sg-autentification-row">
            <div class="sg-autentification-col">
                <div class="">
                    <button name="loginSubmit" value="log">Prijava</button>
                </div>
            </div>

        </div>



    </form>
    <div class="sg-link-register">
    <p>Nemate račun? </p>    <a href="registracija.php">  Registracija</a>
    </div>
</div>
  


<?php 
include("../dijelovi/podnozje.php");
?>