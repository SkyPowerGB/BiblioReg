<div class="sg-nav-bar-container">
      <?php
      $korisnik = new Korisnik($conn);
      $korisnik->readUserData($_SESSION["userId"]);
      ?>

      <div class="sg-nav-logo">
         <a href="pocetna.php"><img src="../izgled/slike/logo.png"></a>
      </div>
      <ul>
         <li class="sg-nav-bar-item"><a href="pocetna.php">Početna</a></li>
         <li class="sg-nav-bar-item"><a href="mojeKnjige.php">Moje knjige</a></li>
         <?php
         if ($korisnik->isAdmin) {
            ?>
            <li class="sg-nav-bar-item"><a>Korisnici</a></li>
            <?php
         }
         ?>
      </ul>
      <div class="sg-nav-account">

         <button id="showAccountOptions">
            <?php
            echo ($korisnik->ime);
            echo (" ");
            echo ($korisnik->prezime);

            ?>
         </button>
      </div>


      <div class="sg-nav-collapsed">
         <button id="showCollapsedNavbar">V</button>
      </div>

   </div>

   <div id="collapsedNavbar" class="nav-bar-container-collapsed  nav-bar-hide   nav-bar-collapsed">

      <ul>
         <li class="sg-nav-bar-item-c"><a href="postavke.php">Postavke</a></li>
         <li class="sg-nav-bar-item-c"><a href="pocetna.php">Početna</a></li>
         <li class="sg-nav-bar-item-c"><a href="mojeKnjige.php">Moje knjige</a></li>
         <li class="sg-nav-bar-item-c"><a>Korisnici</a></li>
         <li class="sg-nav-bar-item-c"><a href="logout.php">Odjava</a></li>
      </ul>



   </div>

   <div id="accountOptionsBar" class="account-options nav-bar-hide  nav-bar-wide">
      <ul>
         <li class="sg-nav-bar-item-c"><a href="postavke.php">Postavke</a></li>
         <li class="sg-nav-bar-item-c"><a href="logout.php">Odjava</a></li>
      </ul>

   </div>

   <script src="../funkcionalnost/univerzalna/navbar.js"></script>
