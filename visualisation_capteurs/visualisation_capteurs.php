
<head>

<!--<script src="chart.js/dist/Chart.js" ></script>-->
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

<link rel="stylesheet" href="style/style.css"/>
</head>


<body>
<!--<ul>
  <li><a class="active" href="">Données capteurs</a></li>
  <li><a href="ajout.php">Ajout capteur</a></li>
</ul>-->
	
	
	
	
	
	<div class="columns is-gapless">
		<div class="column is-1">
		</div> 	
		<div class="column is-">
		<div style="width:95%;">
			<canvas id="canvas"></canvas>
		</div>
		Température maximale avant alerte :<input type="number" class="number" min=-20 max=1000 value=60 onchange="updateLimit(this,'T')"> °C 
		<div style="width:95%;">
			<canvas id="canvas2"></canvas>
		</div>
		Humidité minimale avant alerte : <input type="number" class="number" value=5 min=0 max=99 onchange="updateLimit(this,'H')"> %
		<div style="width:95%;">
			<canvas id="canvas3"></canvas>
		</div>
		Vitesse du vent maximale avant alerte : <input type="number" class="number" value=80 min=0 max=150 onchange="updateLimit(this,'W')"> km/h
		<br>
		<br>
		</div>
		<div class="column is-2">
			<table class="table">
			<tr><th><span id="warningT" onclick="showAlertList()"></span> <br> </th> </tr>
			<tr><th><span id="warningH" onclick="showAlertList()"></span> <br> </th> </tr>
			<tr><th><span id="warningW" onclick="showAlertList()"></span> </th> </tr>
			</tr>
			</table>
		</div>
		<div class="column is-2">
			<button id="clearAlertList" class="button is-primary is-outlined" onclick="clearList()" style="display:none;"> 
				<span>Effacer</span>
				<span class="icon is-small">
					<i class="fas fa-times"></i>
				</span> </button>
			<table class="table is-narrow" id="alertList" style="display:none;">
				<thead>
					<tr>
						<td> capteur </td>
						<td> alerte </td>
						<td> heure </td>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		
		window.onload = function() {
			
			var nbCapteurs;
			initCharts();
			
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, temperature);
			
			var ctx2 = document.getElementById('canvas2').getContext('2d');
			window.myLine2 = new Chart(ctx2, humidity);
			
			var ctx3 = document.getElementById('canvas3').getContext('2d');
			window.myLine3 = new Chart(ctx3, wind);					
			
		};
		
		var limitT = 60;
		var limitH = 5;
		var limitW = 80;
		
		var averageT = 20;
		var averageH = 35;
		var averageW = 20;
		var date = 0;
		
		
		var color = Chart.helpers.color;
		var temperature = {
			type: 'line',
			data: {
				datasets: [
				{
					label: "capteur1",
					yAxisID: 'A',
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
					borderColor: window.chartColors.red,
					fill: false,
					data: [{
						x: newDate(-20),
						y: averageT+getRandomInt(2)
					}, {
						x: newDate(-15),
						y: averageT+getRandomInt(2)
					}, {
						x: newDate(-10),
						y: averageT+getRandomInt(2)
					}, {
						x: newDate(-5),
						y: averageT+getRandomInt(2)
					}, {
						x: newDate(0),
						y: averageT+getRandomInt(2)
					}],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'MESURE DE LA TEMPERATURE'
				},
				scales: {
					xAxes: [{
						type: 'time',					
						time: {
						   unit: 'minute',
						   displayFormats: {
							  hour: 'HH',
							  minute: 'HH:mm'
						   }
						},
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Heure'
						},
						ticks: {
							major: {
								fontStyle: 'bold',
								fontColor: '#FF0000'
							}
						}
					}],
					yAxes: [{ id: 'A', type: 'linear', position: 'left',
								ticks: { fontColor: window.chartColors.red },
								scaleLabel: {
									display: true,
									labelString: 'Température',
									fontColor: window.chartColors.red}}]
				}
			}
		};
		
		var humidity = {
			type: 'line',
			data: {
				datasets: [{
					label: 'capteur1',
					yAxisID: 'B',
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
					borderColor: window.chartColors.blue,
					fill: false,
					data: [{
						x: newDate(-20),
						y: averageH+getRandomInt(10)
						
					}, {
						x: newDate(-15),
						y: averageH+getRandomInt(10)
					}, {
						x: newDate(-10),
						y: averageH+getRandomInt(10)
					}, {
						x: newDate(-5),
						y: averageH+getRandomInt(10)
					}, {
						x: newDate(0),
						y: averageH+getRandomInt(10)
					}]
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'MESURE DU POURCENTAGE EN HUMIDITE'
				},
				scales: {
					xAxes: [{
						type: 'time',					
						time: {
						   unit: 'minute',
						   displayFormats: {
							  hour: 'HH',
							  minute: 'HH:mm'
						   }
						},
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Heure'
						},
						ticks: {
							major: {
								fontStyle: 'bold',
								fontColor: '#FF0000'
							}
						}
					}],
					yAxes: [{ id: 'B', type: 'linear', position: 'left',
								ticks: { max: 100, min: 0, fontColor: window.chartColors.blue},						
								  scaleLabel: {
									display: true,
									labelString: 'Humidité',
									fontColor: window.chartColors.blue}}]
				}
			}
		};

		var wind = {
			type: 'line',
			data: {
				datasets: [{
					label: 'capteur1',
					yAxisID: 'B',
					backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
					borderColor: window.chartColors.green,
					fill: false,
					data: [{
						x: newDate(-20),
						y: averageW+getRandomInt(10)
						
					}, {
						x: newDate(-15),
						y: averageW+getRandomInt(10)
					}, {
						x: newDate(-10),
						y: averageW+getRandomInt(10)
					}, {
						x: newDate(-5),
						y: averageW+getRandomInt(10)
					}, {
						x: newDate(0),
						y: averageW+getRandomInt(10)
					}]
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'MESURE DE LA VITESSE DU VENT'
				},
				scales: {
					xAxes: [{
						type: 'time',					
						time: {
						   unit: 'minute',
						   displayFormats: {
							  hour: 'HH',
							  minute: 'HH:mm'
						   }
						},
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Heure'
						},
						ticks: {
							major: {
								fontStyle: 'bold',
								fontColor: '#FF0000'
							}
						}
					}],
					yAxes: [{ id: 'B', type: 'linear', position: 'left',
								ticks: { max: 100, min: 0, fontColor: window.chartColors.green},						
								  scaleLabel: {
									display: true,
									labelString: 'Vitesse du vent',
									fontColor: window.chartColors.green}}]
				}
			}
		};
		
		function newDate(minutes) {
			return moment().add(minutes, 'm');
		}

		
		function getRandomInt(max) {
		  return Math.floor((Math.random()-0.5) * Math.floor(max));
		}
		
		function initCharts(){
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
					var a = this.responseText; 
					 nbCapteurs = JSON.parse(a);
					console.log(a);			
					
					for(var type in nbCapteurs) {
						if (nbCapteurs.hasOwnProperty(type)) {  
							for(var i=1;i<nbCapteurs[type];i++){
							 temperature.data.datasets.push({
									label: 'capteur'+ (i+1).toString(),
									yAxisID: 'A',
									backgroundColor: color(window.chartColors.red).alpha(0.3+0.2*i).rgbString(),
									borderColor: color(window.chartColors.red).alpha(0.3+0.2*i).rgbString(),
									fill: false,
									data: [{
										x: newDate(-20),
										y: averageW+getRandomInt(10)
										
									}, {
										x: newDate(-15),
										y: averageW+getRandomInt(10)
									}, {
										x: newDate(-10),
										y: averageW+getRandomInt(10)
									}, {
										x: newDate(-5),
										y: averageW+getRandomInt(10)
									}, {
										x: newDate(0),
										y: averageW+getRandomInt(10)
									}]
								});					
							}
						}
					}
					window.myLine.update();
				}
			};
				
			xmlhttp.open("GET","DB_calls.php?action=count",true);
			xmlhttp.send();
			
		}
		
		window.setInterval(function(){
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
					var a = this.responseText; 
					var mesures_capteurs = JSON.parse(a);
					console.log(a);
					console.log(mesures_capteurs);			
					
					updateData(mesures_capteurs);
				}};
				
			xmlhttp.open("GET","DB_calls.php?action=update",true);
			xmlhttp.send();
				
		}, 5000);		
		
		function updateData(mesures_capteurs){
			for(var i=0;i<nbCapteurs["T"];i++){
			checkValue(mesures_capteurs["T"][i][1][1], "T", i);
			temperature.data.datasets[i].data.push({
						x: newDate(date+5), 
						y: parseInt(mesures_capteurs["T"][i][1][1]) +getRandomInt(2)
					});
					if(temperature.data.datasets[i].data.length > 13) temperature.data.datasets[i].data.shift();
			}
			
			for(var i=0;i<nbCapteurs["H"];i++){
			checkValue(mesures_capteurs["H"][i][1][1], "H", i);
			humidity.data.datasets[i].data.push({
						x: newDate(date+5), 
						y: parseInt(mesures_capteurs["H"][i][1][1]) +getRandomInt(5)
					});
					if(humidity.data.datasets[0].data.length > 13) humidity.data.datasets[i].data.shift();
			}		
				
			for(var i=0;i<nbCapteurs["W"];i++){
			checkValue(mesures_capteurs["W"][i][1][1], "W", i);
			wind.data.datasets[i].data.push({
						x: newDate(date+5), 
						y: parseInt(mesures_capteurs["W"][i][1][1]) +getRandomInt(8)
					});
					if(wind.data.datasets[0].data.length > 13) wind.data.datasets[i].data.shift();
			}		
					
					date+=5;
					window.myLine.update();
					window.myLine2.update();
					window.myLine3.update();
		}
		
		function updateLimit(input, dataType){
			switch (dataType) {
			  case "T":
				limitT = input.value;
				console.log("new T limit :"+limitT);
				//input.value = null;
				break;
			  case "H":
				limitH = input.value;
				console.log("new H limit :"+limitH);
				//input.value = null;
				break;
			  case "W":
				limitW = input.value;
				console.log("new W limit :"+limitW);
				// input.value = null;
				break;
			  default:
				break;
			}
		}
		
		function checkValue(value, dataType, numCapteur){
			var table = document.getElementById('alertList').getElementsByTagName('tbody')[0];
			var newRow = table.insertRow(table.rows.length);
			var now = moment();
			var time = now.hour() + ':' + now.minutes() + ':' + now.seconds();
			switch (dataType) {
			  case "T":
				if(value >= limitT){
					document.getElementById("warningT").style.display = "block";
					document.getElementById("warningT").innerHTML = "ALERTE : TEMPERATURE ELEVEE ("+value+">"+limitT+")";
					document.getElementById("warningT").className = "has-text-danger";
					newRow.innerHTML = "<td> T-"+(numCapteur+1)+"</td><td>"+value+" °C</td><td>"+time+"</td>";
				}
				else if(value < limitT) {
					document.getElementById("warningT").innerHTML = "Temperature OK";
					document.getElementById("warningT").className = "has-text-success";
				}
				break;
			  case "H":
				if(value <= limitH){
					document.getElementById("warningH").style.display = "block";
					document.getElementById("warningH").innerHTML = "ALERTE : HUMIDITE FAIBLE ("+value+"<"+limitH+")";
					document.getElementById("warningH").className = "has-text-danger";
					newRow.innerHTML = "<td> H-"+(numCapteur+1)+"</td><td>"+value+" %</td><td>"+time+"</td>";
				}
				else if(value > limitH) {
					document.getElementById("warningH").innerHTML = "Humidité OK";
					document.getElementById("warningH").className = "has-text-success";
				}
				break;
			  case "W":
				if(value >= limitW){
					document.getElementById("warningW").style.display = "block";
					document.getElementById("warningW").innerHTML = "ALERTE : VENT FORT ("+value+">"+limitW+")";
					document.getElementById("warningW").className = "has-text-danger";
					newRow.innerHTML = "<td> W-"+(numCapteur+1)+"</td><td>"+value+" km/h</td><td>"+time+"</td>";
				}
				else if(value < limitW) {
					document.getElementById("warningW").innerHTML = "Vitesse vent OK";
					document.getElementById("warningW").className = "has-text-success";
				}
				break;
			  default:
				break;
			}
		}
		
		function showAlertList(){
	
			var div = document.getElementById("alertList");
			var button = document.getElementById("clearAlertList");
			
			div.style.display = button.style.display = (div.style.display == "block") ? "none" : "block";
		}
		
		function clearList(){
			var tableHeaderRowCount = 1;
			var table = document.getElementById('alertList');
			var rowCount = table.rows.length;
			for (var i = tableHeaderRowCount; i < rowCount; i++) {
				table.deleteRow(tableHeaderRowCount);
			}
			console.log("cleared");
		}
	</script>
</body>