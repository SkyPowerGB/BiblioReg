<?php


class UserTable
{

    /**  @var mysqli */
    public $conn;
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function displayUsersTable()
    {
        //SELECT idKorisnik,ime,prezime,email,aktivan,nazivUloga FROM korisnici  join uloge on ulogaId=idUloga 
        $sql = "SELECT idKorisnik,ime,prezime,email,aktivan,nazivUloga FROM korisnici  join uloge on ulogaId=idUloga ";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $stmt->close();
            echo ("<table>");
            echo ("<tr>");
            echo ("<th>Id</th>");
            echo ("<th>Ime</th>");
            echo ("<th>Prezime</th>");
            echo ("<th>Email</th>");
            echo ("<th>Aktivan</th>");
            echo ("<th>Uloga</th>");
            echo ("<th>Uredi</th>");
            echo ("<th>Izbriši</th>");

            echo ("</tr>");
            while (($row = $result->fetch_assoc()) != null) {





                echo ("<tr>");
                echo("<td>".$row["idKorisnik"]."</td>");
                echo("<td>".$row["ime"]."</td>");
                echo("<td>".$row["prezime"]."</td>");
                echo("<td>".$row["email"]."</td>");
                echo("<td>".(($row["aktivan"])? "Aktivan":"Neaktivan")."</td>");
                echo("<td>".$row["nazivUloga"]."</td>");
                echo("<td>");

                echo("<form method=POST action=postavke.php>");
                echo("<input type=hidden name=adminEdit value=".true.">");
                echo("<button name='uid' value='".$row["idKorisnik"]."'>Edit</button>");
                echo("</form>");


                echo("</td>");
                echo("<td><button class=deleteUserBtn value=".$row["idKorisnik"]."> Delete</button></td>");

                echo ("</tr>");


            }
            echo ("</table>");
        }

    }
       
 

    



}