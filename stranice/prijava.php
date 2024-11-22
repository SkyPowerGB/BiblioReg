
<?php 
session_start();
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");

$korisnik = new Korisnik($conn);

$email;
$password;


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
                   
                  

            }

               

        };
       


      
      
       
    }



?>


<div class="sg-autentificaiton-form-container-div">
    <h1>Prijava</h1>
    <form method="POST" action="prijava.php">
      
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