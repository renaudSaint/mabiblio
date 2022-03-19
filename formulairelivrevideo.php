<html lang="fr">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
<link href="style.css" rel="stylesheet" type="text/css"/>
<script src="html5-qrcode.min.js" type="text/javascript"></script>
<script src="highlight.min.js"></script>
<title>Ma petite bibliotheque</title>
</head>
<body>
<div id="principal">

<div id="sidebar">
			<h2>navigation</>
			<hr />
			<ul class="ulsidebar">
			<li class="lisidebar"><a href="index.php"  style="target-new: tab" class="bouton">Page principale</a></li>
			</ul>
</div>
	<div id="entête">
	<h1>MA PETITE BIBLIOTHEQUE</h1>
	</div>

<div id="contenu">
<h1>AJOUTER UN LIVRE </H1>
<?php
require("scan.php");
?>

<input type="button" value="clicker pour envoyer dans le formulaire" onclick="hello()">
<form name="chiffre" method="GET" action="formulairelivrevideo.php">

 <input type="integer" id="isbn" name="isbn">
 
<input type="submit" name="valider" value="ko">
     
 </form>  
<?php
require("apigoogle.php");
?>
 <?php
require "conexxion2.php";
?>
<form action="formulairelivrevideo.php" method="post">
isbn: <input type="number" name="isbn" value="<?php echo $isbn ?>"  required/><br>
numero de l'album: <input type="number" name="numero"/  required><br>
titre: <input type="text" name="titre" value="<?php echo $infos['titre'] ?>" required/><br>
auteur:<input type="text" name="auteur" value="<?php echo $infos['auteur'] ?>" required/><br>
edition: <select name="edition"><br>
<?php
	$req="SELECT DISTINCT edition from edition";
	$result = $conn->query($req);
	 while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
	 <option value="<?php echo $row['edition'] ?>"><?php echo $row['edition'] ?></option> <?php }

?>
</select>
<br>
année: <input type="number" name="annee" value="<?php echo $infos['publication'] ?>"/><br>
serie: <select name="serie"><br>
<?php
	$req="SELECT DISTINCT serie from serie";
	$result = $conn->query($req);
	 while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
	 <option value="<?php echo $row['serie'] ?>"><?php echo $row['serie'] ?></option> <?php }
	$conn=null; 
?>
</select>
<input type="submit" name="envoi" class="bouton">
</form>
 

<?php
if(isset($_POST['envoi'])){
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
try 
{$sql = $conn->prepare("SELECT DISTINCT isbn, titre FROM biblio WHERE isbn LIKE :isbn OR titre LIKE :titre");
	$status = $sql -> execute(array(
		':isbn'=>$isbn,
        ':titre'=>$titre,
	
	));
	if (($status)== true && ($sql ->rowCount() > 0))
	{ echo "ce livre existe deja";} else {$sql = $conn->prepare("INSERT INTO biblio(isbn, numero,titre,auteur, edition, annee, serie) VALUES (:isbn, :numero, :titre,:auteur, :edition, :annee, :serie)"); 	
		$sql->execute(array(
				':isbn' => $isbn,
				':numero' => $numero,
				':titre' => $titre,
				':auteur' =>$auteur,
				':edition' => $edition,
				':annee' => $annee,
				':serie' => $serie));		
		}}

catch(Exception $e)
{
die ('Erreur : '.$e->getMessage());
}

$conn=null; }

?>

</div>
	<div id="pied">
	<h3>FIN DU SITE</h3>
	</div>	
	
</div>
		
</body>
</html>
	