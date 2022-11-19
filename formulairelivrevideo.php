<html lang="fr">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <title>Ma petite bibliotheque</title>
</head>
<body>
<div id="principal">

    <div id="sidebar">
        <h2>navigation</>
        <hr/>
        <ul class="ulsidebar">
            <li class="lisidebar"><a href="index.php" style="target-new: tab" class="bouton">Page principale</a></li>
        </ul>
    </div>
    <div id="entête">
        <h1>MA PETITE BIBLIOTHEQUE</h1>
    </div>

    <div id="contenu">
        <h1>AJOUTER UN LIVRE </H1>
        <?php
        require("coderbarrereader/codebarre.html");
        ?>


        <?php
        require "conexxion2.php";
        require("apigoogle.php");


        if ( isset($_GET['isbn']) && isset($infos['titre']) ) {
            ?>
            <form action="formulairelivrevideo.php" method="post" enctype="multipart/form-data">
                isbn: <input type="number" name="isbn" value="<?php
                echo $isbn ?>" required/><br>
                numero de l'album: <input type="number" min="1" name="numero"/ required><br>
                titre: <input type="text" name="titre" value="<?php
                echo $infos['titre'] ?>" required/><br>
                auteur:<input type="text" name="auteur" value="<?php
                echo $infos['auteur'] ?>" required/><br>
                edition: <select name="edition"><br>
                    <?php
                    $req = "SELECT DISTINCT edition from edition";
                    $result = $conn->query($req);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php
                        echo $row['edition'] ?>"><?php
                            echo $row['edition'] ?></option> <?php
                    }

                    ?>
                </select>
                <br>
                année: <input type="number" name="annee" value="<?php
                echo $infos['publication'] ?>"/><br>
                serie: <select name="serie"><br>
                    <?php
                    $req = "SELECT DISTINCT serie from serie";
                    $result = $conn->query($req);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php
                        echo $row['serie'] ?>"><?php
                            echo $row['serie'] ?></option> <?php
                    }
                    $conn = null;
                    ?>
                </select>
                <br>
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" name="envoi" class="bouton" value="Envoyer">
            </form>
            <?php
        } elseif ( isset($results) ) {
            if ( $results->totalItems < 1 ) {
                echo "livre introuvable";
            }
        } ?>

        <?php
        if ( isset($_POST['envoi']) ) {
            echo $_POST['isbn'];
            echo $_POST['numero'];
            echo $_POST['titre'];
            echo $_POST['auteur'];
            echo $_POST['edition'];
            echo $_POST['annee'];
            echo $_POST['serie'];
            $isbn = $_POST['isbn'];
            $numero = $_POST['numero'];
            $titre = ucfirst(strtolower($_POST['titre']));
            $auteur = ucwords(strtolower($_POST['auteur']));
            $edition = $_POST['edition'];
            $annee = $_POST['annee'];
            $serie = $_POST['serie'];
            require "conexxion2.php";
            try {
                $sql = $conn->prepare(
                    "SELECT DISTINCT isbn, titre FROM biblio WHERE isbn LIKE :isbn OR titre LIKE :titre"
                );
                $status = $sql->execute(array(
                    ':isbn' => $isbn,
                    ':titre' => $titre,

                ));
                if ( ($status) == true && ($sql->rowCount() > 0) ) {
                    echo "ce livre existe deja";

                } else {

                    $serie=strtolower($serie);
                    $isbn2="'$isbn'";
                    $target_dir = "image/'$serie'/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $target_file = $target_dir . $isbn2 .'.'.$imageFileType;
// Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }

// Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

// Check file size
                    if ($_FILES["fileToUpload"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

// Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" && $imageFileType != "svg") {
                        echo "Sorry, only JPG, JPEG, PNG, SVG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

// Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    $sql = $conn->prepare(
                        "INSERT INTO biblio(isbn, numero,titre,auteur, edition, annee, serie) VALUES (:isbn, :numero, :titre,:auteur, :edition, :annee, :serie)"
                    );
                    $sql->execute(array(
                        ':isbn' => $isbn,
                        ':numero' => $numero,
                        ':titre' => $titre,
                        ':auteur' => $auteur,
                        ':edition' => $edition,
                        ':annee' => $annee,
                        ':serie' => $serie
                    ));

                }
            } catch (Exception $e) {
                die ('Erreur : ' . $e->getMessage());
            }

            $conn = null;
        }

        ?>

    </div>
    <div id="pied">
        <h3>FIN DU SITE</h3>
    </div>

</div>

</body>
</html>
	