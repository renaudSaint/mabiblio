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
			<li class="lisidebar"><a href="index.php" class="bouton">Page principale</a></li>
			</ul>
</div>
	<div id="entête">
	<h1>MA PETITE BIBLIOTHEQUE</h1>
	</div>

 	<div id="contenu">


<?php
	$count=0;
require "conexxion2.php";

?>

<div id="tableholder">

<table style="border-collapse:collapse">
<td></td>
<?php
	$req="SHOW COLUMNS FROM biblio";
	$result = $conn->query($req);
	 while($row = $result->fetch(PDO::FETCH_ASSOC)){ IF ($row['Field']=='numero' OR $row['Field']=='titre'){?>
	
		<th>
		<?php  echo $row['Field'];}}?></th><th>couverture</th>
		
		<?php
	
		IF (isset ($_GET['serie'])){
			$serie=($_GET['serie']); 
		
			foreach ($serie AS $key => $value){$e=addslashes($value); $sql=$conn->prepare("SELECT count(idLivre)
				FROM biblio
				WHERE serie LIKE '$e'");  $sql->execute();$count = $sql->fetch();?>
				
				<tr style="text-align:center">
				
					<td style="text-align: center; background-color: #00ccff" rowspan="<?php echo $count['0']?>">
						 <?php echo $value;?></td>

						<?php 
					
						 $req="SELECT * FROM biblio WHERE serie= '$e' ORDER BY numero ASC";
								$result = $conn->query($req);	
								while($row = $result->fetch()) {
						
							
									$isbn=$row["isbn"];
									$c=htmlspecialchars($row["serie"]);
									$image="image\'$c'\'$isbn'";
								
									  echo "<td>".$row["numero"]."</td>";
									  echo "<td>". $row["titre"]."</td>";
									
									echo  '<td><a href="info.php?isbn='.$isbn.'&amp;image='.$image.'"><img src="'.$image.'"width="98" height="129"  /></a></td>';
									
								echo '</tr>';}}}
								
								
						
								
								?>
							
<?php

IF (isset ($_GET['edition'])){
	$edition=($_GET['edition']); 
	foreach ($edition AS $key => $value){$e=addslashes($value); $sql=$conn->prepare("SELECT count(idLivre)
		FROM biblio
		WHERE edition LIKE '$e'");  $sql->execute();$count = $sql->fetch();?>
		
	
		<tr style="text-align:center">
			<td style="text-align: center; background-color: #00ccff"rowspan="<?php echo $count['0']?>">
				 <?php echo $value; ?></td>

				<?php 

				 $req="SELECT * FROM biblio WHERE edition= '$e' ORDER BY serie ASC, numero ASC";
						$result = $conn->query($req);	
						while($row = $result->fetch()) {

							$isbn=$row["isbn"];
							$c=htmlspecialchars($row["serie"]);
							$image="image\'$c'\'$isbn'";
						
							  echo "<td>".$row["numero"]."</td>";
							  echo "<td>". $row["titre"]."</td>";
							
							echo  '<td><a href="info.php?isbn='.$isbn.'&amp;image='.$image.'"><img src="'.$image.'"width="98" height="129" /></a> </td>';
						echo '</tr>'; 
						 }}}
?>					
<?php

IF (isset ($_GET['auteur'])){
	$auteur=($_GET['auteur']); 
	foreach ($auteur AS $key => $value){$e=addslashes($value);$sql=$conn->prepare("SELECT count(idLivre)
		FROM biblio
		WHERE auteur LIKE '$e'");  $sql->execute();$count = $sql->fetch();?>
		
	
	
	
		<tr style="text-align:center">
			<td style="text-align: center; background-color: #00ccff" rowspan="<?php echo $count['0']?>">
				 <?php echo $value; ?></td>

				<?php 

				 $req="SELECT * FROM biblio WHERE auteur= '$e' ORDER BY serie ASC, numero ASC ";
						$result = $conn->query($req);	
						while($row = $result->fetch()) {

							$isbn=$row["isbn"];
							$c=htmlspecialchars($row["serie"]);
							$image="image\'$c'\'$isbn'";
						
							  echo "<td>".$row["numero"]."</td>";
							  echo "<td>". $row["titre"]."</td>";
							
							echo  '<td><a href="info.php?isbn='.$isbn.'&amp;image='.$image.'"><img src="'.$image.'"width="98" height="129" /></a> </td>';
						echo '</tr>'; 
						 }	}}
						?>					

					

<?php
$conn=null;
?>	
	</table>
</div>
<?php
require "pied.php";
?>