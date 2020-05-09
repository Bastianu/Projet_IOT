<head>
<link rel="stylesheet" href="style/style.css"/>
</head>


<body>
<ul>
  <li><a href="visualisation_capteurs.php">Données capteurs</a></li>
  <li><a class="active" href="">Ajout capteur</a></li>
</ul>


<div style="margin-left:20%;padding:1px ;width:75%;">

<?php
$con = mysqli_connect('localhost','root','','projet_iot');

if(isset($_GET['add'])){
	if($_GET['add']){
		echo "insertion réussie";
	}
	else {
		echo "un problème est survenu lors de l'insertion";
	}
	echo "<br><br><br>";
}



$sql = "SELECT * FROM assigned_area";
$result = mysqli_query($con,$sql);




echo '<form action="DB_calls.php" method="get">
		<select name="type">
		<option value="" selected disabled hidden>Type de capteur</option>
		<option value="Temperature">Temperature</option>
		<option value="Humidite">Humidité</option>
		<option value="Vent">Vent</option>
		</select>
		
		
		<select name="area">
		<option value="" selected disabled hidden>Zone d assignation</option>';
		while($row = mysqli_fetch_array($result)) {
			echo '<option value='.$row['description'].'>'.$row['description'].'</option>';
		}
echo 	'</select>
		<input type="hidden" name="action" value="add">
		<input type="submit">
		</form>';
?>

<br><br><br><br>
Ajouter une zone d'assignation : 
<form action="DB_calls.php" method="get">

<input type="hidden" name="action" value="addArea">

<input type="text" name="areaName">

<input type="submit">

</form>


</div>

<?php
mysqli_close($con);
?>