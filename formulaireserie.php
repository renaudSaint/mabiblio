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
<h1>AJOUTER UNE SERIE </H1>

<form action="formulaireserie.php" method="post">
serie: <input type="text" required name="serie"/>
<input type="submit" name="envoi" class="bouton">
</form>
<?php
if(isset($_POST['envoi'])){
echo $_POST['serie'];
$serie = ucwords(strtolower( $_POST['serie']));
echo $serie;
require "conexxion2.php";
try 
{$sql = $conn->prepare("SELECT serie FROM serie WHERE serie = :serie");
	$status = $sql -> execute(array(
		':serie'=>$serie,
	));
	if (($status)== true && ($sql ->rowCount() > 0)){
		echo "cette serie existe deja";}else
$sql = $conn->prepare("INSERT INTO serie(serie) VALUES (:serie)");	
$sql->execute(array(
        ':serie' => $serie));
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
	