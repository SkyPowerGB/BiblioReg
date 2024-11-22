<?php


class Bookshelf
{
    /**  @var mysqli */

    public $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function displayAllBooks($uid)
    {
        $sql = "SELECT idKnjiga,naslov,izdavac,godina,datumDodavanja,ime,prezime,idKorisnik
                 FROM knjiga JOIN korisnici ON autorId=idKorisnik where aktivan=1 ORDER BY datumDodavanja";
           if($uid!=null){
                
                       $sql= "SELECT idKnjiga,naslov,izdavac,godina,datumDodavanja,ime,prezime,idKorisnik
                 FROM knjiga JOIN korisnici ON autorId=idKorisnik  where autorId=? and aktivan=1 ORDER BY datumDodavanja";

           }

        echo (' <div class="sg-book-shelf">');

        $stmt = $this->conn->prepare($sql);
        $knjige = null;
        if($uid!=null){
            $stmt->bind_param("d",$uid);
        }
        if ($stmt->execute()) {
            $knjige = $stmt->get_result();
            $stmt->close();

        }
        if ($knjige != null) {
            while (($row = $knjige->fetch_assoc()) != null) {

                echo ('<div class="sg-book-container">');
                echo ('<form method="POST" action="prikazKnjige.php">');
                echo ('<input name="idKnjige" type="hidden"' . 'value=' . $row["idKnjiga"] . ' >');

                echo ('<button class="sg-book-button">');
                echo ("<h1>");
                echo ($row["naslov"]);
                echo ("</h1>");
                echo ("<h4>");
                echo ($row["ime"]);
                echo (" ");
                echo ($row["prezime"]);
                echo ("</h4>");
                echo ("<h5>");
                echo ($row["izdavac"]);
                echo ("</h5>");
                echo ("<h6>");
                echo ($row["godina"]);
                echo ("</h6>");

                echo ("</button>");
                echo ("</form>");



                echo ("</div>");
            }
        }





        echo ('</div>');



    }

}




?>
