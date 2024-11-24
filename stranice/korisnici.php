<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/userTable.php");

session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: prijava.php");
}

$users = new UserTable($conn);
$korisnik = new Korisnik($conn);
$imePrezime = "Korisnika";
$userIdtoDelete = 0;
$korisnik->readUserData($_SESSION["userId"]);

if(!$korisnik->isAdmin){
    header("Location:pocetna.php");}

if (isset($_POST["deleteUAC"])) {
    $uid = $_POST["userToDelete"];
  $userIdtoDelete=$uid;
 
    $korisnik->readUserData($uid);
    if ($korisnik->isAdmin) {
            
        if (!$korisnik->aktivan){
          
            $korisnik->deleteUser($uid);
            
        }

    } else {

        $korisnik->deleteUser($uid);
        header("Location: korisnici.php");
    }

    if($uid==$_SESSION["userId"]){
      header("Location: logout.php");
    }

}

?>

<div id="confirmDeactivateForm" class="sg-confirm-action-form-container sg-hide-div ">
    <h1>Jeste li sigurni da žeilite izbrisati <?php echo ($imePrezime) ?></h1>
    <div class="sg-confirm-action-form-container-buttons">
        <button id="sgConfirmActionBtnCancel">odustani</button>
        <form method="POST" action="korisnici.php">
            <input id="userToDelete" type="hidden" name="userToDelete" value="<?php echo($userIdtoDelete) ?>">
            <button name="deleteUAC" id="sgConfirmActionBtnOk">Izbriši </button>
        </form>
    </div>

</div>



<?php
include("../dijelovi/univerzalni/navbar.php");



?>
<div class="sg-user-table-container">
<?php
$users->displayUsersTable();
?>
</div>

<script src="../funkcionalnost/korisnici/korisnici.js"></script>

<?php
include("../dijelovi/podnozje.php");
?>