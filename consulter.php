<html lang="fr">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style.css">
    <title>Ma petite bibliotheque</title>
</head>
<body>
<div id="principal">

    <div id="sidebar">
        <h2>navigation</>
        <hr/>
        <ul class="ulsidebar">
            <li class="lisidebar"><a href="index.php" class="bouton">Page principale</a></li>
        </ul>
    </div>
    <div id="entête">
        <h1>MA PETITE BIBLIOTHEQUE</h1>
    </div>

    <div id="contenu">

        <?php
        require "conexxion2.php";
        ?>
        <form method="GET" action="recherche.php" style="background-color: #0a4b78">

            <?php
            $req = "SHOW COLUMNS FROM biblio";
            $result = $conn->query($req);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                if ( $row['Field'] == 'serie' ) {
                    { ?> <div>



                            <p><?php
                                echo $row['Field'];?></p><?php
                                $req = "SELECT DISTINCT " . $row['Field'] . " from biblio ";
                                $e = $row['Field'];
                                $result = $conn->query($req);
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                           <br> <input type="checkbox" name="<?php echo $e.'[]';?>" value="<?php
                            echo $row["$e"] ?>"><?php
                                echo $row["$e"] ?>
                           <?php
                            } ?></div> <?php
                    }
                }
            }


            $req = "SHOW COLUMNS FROM biblio";
            $result = $conn->query($req);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                if ( $row['Field'] == 'edition' ) {
                    { ?><div>



                            <p><?php
                                echo $row['Field'];?></p><?php
                                $req = "SELECT DISTINCT " . $row['Field'] . " from biblio ";
                                $e = $row['Field'];
                                $result = $conn->query($req);
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                           <br> <input type="checkbox" name="<?php echo $e.'[]';?>" value="<?php
                            echo $row["$e"] ?>"><?php
                                echo $row["$e"] ?></input>
                            <?php
                            } ?></div> <?php
                    }
                }
            }

            $req = "SHOW COLUMNS FROM biblio";
            $result = $conn->query($req);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                if ( $row['Field'] == 'auteur' ) {
                    { ?><div>



                           <p> <?php
                               echo $row['Field'];?></p><?php
                                $req = "SELECT DISTINCT " . $row['Field'] . " FROM biblio ORDER BY " .$row['Field'] .
                                    " ASC";
                                $e = $row['Field'];
                                $result = $conn->query($req);
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                              <br>  <input type="checkbox" name="<?php echo $e.'[]';?>" value="<?php
                                echo $row["$e"] ?>"><?php
                                echo $row["$e"] ?></input>
                            <?php
                            } ?></div><?php
                    }
                }
            }
            ?>

            <input type="submit" value="valider">
        </form>


        <?php
        require "pied.php";

        ?>

