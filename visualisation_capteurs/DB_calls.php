<?php

$con = mysqli_connect('localhost','root','','projet_iot');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$action = $_GET["action"];

switch($action)
	{		
		default:
			break;
	
		case 'update':
			echo json_encode(getLastSensorsValues($con, 1));
			break;					
			
		case 'count':
			echo json_encode(getAllSensors($con));
			break;
			
		case 'init':
			echo json_encode(getLastSensorsValues($con, 10));
			break;
			
		case 'add':
			$result = addSensor($con, $_GET['area'], $_GET['type']);
			header("Location: ajout.php?add=$result");
			
		case 'addArea':
			$result = addArea($con, $_GET['areaName']);
			header("Location: ajout.php?add=$result");
			
			
	}

mysqli_close($con);



function addArea($con, $area){
	$sql = "INSERT INTO assigned_area(description) VALUES ('$area') ";
	$result = mysqli_query($con,$sql);
	return ($result);
}

function addSensor($con, $area, $type){
	
	
	return "ok";
}

function getLastSensorsValues($con, $n){
	$capteursTemp="SELECT id_capteur FROM capteurs  WHERE id_type = 1"; 
	$resultT = mysqli_query($con,$capteursTemp);

	$capteursHumidity="SELECT id_capteur FROM capteurs  WHERE id_type = 2"; 
	$resultH = mysqli_query($con,$capteursHumidity);

	$capteursWind="SELECT id_capteur FROM capteurs  WHERE id_type = 3"; 
	$resultW = mysqli_query($con,$capteursWind);

	$capteursT = $capteursH = $capteursW = [];

	while($row = mysqli_fetch_array($resultT)) array_push($capteursT, $row['id_capteur']);
	while($row = mysqli_fetch_array($resultH)) array_push($capteursH, $row['id_capteur']);
	while($row = mysqli_fetch_array($resultW)) array_push($capteursW, $row['id_capteur']);

	$mesures_capteurs = array(
		"T" => [],
		"H" => [],
		"W" => []
	);

	foreach($capteursT as $c){
		$sql="SELECT * FROM enregistrements left join mesures on enregistrements.id_mesure = mesures.id WHERE id_capteur = $c ORDER BY id_mesure DESC LIMIT $n"; 
		$result = mysqli_query($con,$sql);
		
		while($row = mysqli_fetch_array($result)) {
			array_push($mesures_capteurs["T"], array(intval($c), [$row['date_mesure'],$row['mesure1']]));
		}
	}
	foreach($capteursH as $c){
		$sql="SELECT * FROM enregistrements left join mesures on enregistrements.id_mesure = mesures.id WHERE id_capteur = $c ORDER BY id_mesure DESC LIMIT $n"; 
		$result = mysqli_query($con,$sql);
		
		while($row = mysqli_fetch_array($result)) {
			array_push($mesures_capteurs["H"], array(intval($c), [$row['date_mesure'],$row['mesure1']]));
		}
	}
	foreach($capteursW as $c){
		$sql="SELECT * FROM enregistrements left join mesures on enregistrements.id_mesure = mesures.id WHERE id_capteur = $c ORDER BY id_mesure DESC LIMIT $n"; 
		$result = mysqli_query($con,$sql);
		
		while($row = mysqli_fetch_array($result)) {
			array_push($mesures_capteurs["W"], array(intval($c), [$row['date_mesure'],$row['mesure1']]));
		}
	}
	
	return $mesures_capteurs;
}


function getAllSensors($con){
	$capteursTemp="SELECT id_capteur FROM capteurs  WHERE id_type = 1"; 
	$resultT = mysqli_query($con,$capteursTemp);

	$capteursHumidity="SELECT id_capteur FROM capteurs  WHERE id_type = 2"; 
	$resultH = mysqli_query($con,$capteursHumidity);

	$capteursWind="SELECT id_capteur FROM capteurs  WHERE id_type = 3"; 
	$resultW = mysqli_query($con,$capteursWind);

	$result = array(
		"T" => [mysqli_num_rows($resultT)],
		"H" => [mysqli_num_rows($resultH)],
		"W" => [mysqli_num_rows($resultW)]
	);

	return $result;
}

?>