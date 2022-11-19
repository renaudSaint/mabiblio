<html lang="fr">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
<link href="style.css" rel="stylesheet" type="text/css"/>
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
<h1>AJOUTER UNE EDITION </H1>

<form action="formulaireedition.php" method="post">
	edition: <input type="text" required name="edition"/>
	<input type="submit" name="envoi" class="bouton">
</form>
<?php
if(isset($_POST['edition']) && (strlen($_POST['edition'] == ''))){echo 'vous devez envoyer quelque chose';}
if(isset($_POST['edition']) && (strlen($_POST['edition'] != ''))){

$edition = ucwords(strtolower($_POST['edition']));
echo $edition;
require "conexxion2.php";
try 
{$sql = $conn->prepare("SELECT edition FROM edition WHERE edition = :edition");
	$status = $sql -> execute(array(
		':edition'=>$edition,
	));
	if (($status)== true && ($sql ->rowCount() > 0)){
		echo "cette edition existe deja";} else
$sql = $conn->prepare("INSERT INTO edition(edition) VALUES (:edition)");	
$sql->execute(array(
        ':edition' => $edition));
}
catch(Exception $e)
{
die ('Erreur : '.$e->getMessage());
}}

$conn=null; 
?>


	</div>
	<div id="pied">
	<h3>FIN DU SITE</h3>
	</div>	
	
</div>
		
</body>
</html>
	