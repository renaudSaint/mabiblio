<html lang="fr">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
<link rel="stylesheet" href="style.css" >
<title>Ma petite bibliotheque</title>
</head>
<body>
<div id="principal">

<div id="sidebar">
			<h2>navigation</>
			<hr />
			<ul class="ulsidebar">
			<li class="lisidebar"><a href="index.php"  class="bouton">Page principale</a></li>
			</ul>
</div>
	<div id="entête">
	<h1>MA PETITE BIBLIOTHEQUE</h1>
	</div>

<div id="contenu">

<?php
require "conexxion2.php";
?>
<form method="GET" action="recherche.php">

<?php
	$req="SHOW COLUMNS FROM biblio";
	$result = $conn->query($req);
	 while($row = $result->fetch(PDO::FETCH_ASSOC)) IF ($row['Field'] == 'serie'){{ ?>
<label for="serie">Selectionnez votre serie</label>
<select name="serie[]" id="serie" multiple>
	 
	 <option value="" disabled="disabled"><?php echo $row['Field'];$req="SELECT DISTINCT ".$row['Field']." from biblio ";$e=$row['Field'];
	$result = $conn->query($req);
	 while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
	 <option value="<?php echo $row["$e"]?>"><?php echo $row["$e"] ?></option> <?php } ?></option></select> <?php }}


		$req="SHOW COLUMNS FROM biblio";
		$result = $conn->query($req);
		 while($row = $result->fetch(PDO::FETCH_ASSOC)) IF ($row['Field'] == 'edition'){{ ?>
		 <label for="edition">Selectionnez votre edition</label>
		<select name="edition[]" id="edition" multiple>

		 <option value="" disabled="disabled"><?php echo $row['Field'];$req="SELECT DISTINCT ".$row['Field']." from biblio ";$e=$row['Field'];
		$result = $conn->query($req);
		 while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
		 <option value="<?php echo $row["$e"]?>"><?php echo $row["$e"] ?></option> <?php } ?></option></select> <?php }}

$req="SHOW COLUMNS FROM biblio";
$result = $conn->query($req);
 while($row = $result->fetch(PDO::FETCH_ASSOC)) IF ($row['Field'] == 'auteur'){{ ?>
 <label for="auteur">Selectionnez votre edition</label>
<select name=auteur[]" id="auteur" multiple>

 <option value="" disabled="disabled"><?php echo $row['Field'];$req="SELECT DISTINCT ".$row['Field']." from biblio ";$e=$row['Field'];
$result = $conn->query($req);
 while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
 <option value="<?php echo $row["$e"]?>"><?php echo $row["$e"] ?></option> <?php } ?></option></select> <?php }}
?>

<input type="submit" value="valider">
</form>
		
		
	
		




<?php
require "pied.php";

?>

