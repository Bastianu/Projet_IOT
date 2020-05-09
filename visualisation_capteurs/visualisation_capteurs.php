
<head>

<!--<script src="chart.js/dist/Chart.js" ></script>-->
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>

<link rel="stylesheet" href="style/style.css"/>
</head>


<body>
<ul>
  <li><a class="active" href="">Données capteurs</a></li>
  <li><a href="ajout.php">Ajout capteur</a></li>
</ul>

	<div style="margin-left:20%;padding:1px ;width:75%;">
		<canvas id="canvas"></canvas>
	</div>
	<div style="margin-left:20%;padding:1px ;width:75%;">
		<canvas id="canvas2"></canvas>
	</div>
	<div style="margin-left:20%;padding:1px ;width:75%;">
		<canvas id="canvas3"></canvas>
	</div>
	<br>
	<br>
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
				
		}, 10000);		
		
		function updateData(mesures_capteurs){
			for(var i=0;i<nbCapteurs["T"];i++){
			temperature.data.datasets[i].data.push({
						x: newDate(date+5), 
						y: parseInt(mesures_capteurs["T"][i][1][1]) +getRandomInt(3)
					});
					if(temperature.data.datasets[i].data.length > 13) temperature.data.datasets[i].data.shift();
			}
			
			for(var i=0;i<nbCapteurs["H"];i++){
			humidity.data.datasets[i].data.push({
						x: newDate(date+5), 
						y: parseInt(mesures_capteurs["H"][i][1][1]) +getRandomInt(5)
					});
					if(humidity.data.datasets[0].data.length > 13) humidity.data.datasets[i].data.shift();
			}		
				
			for(var i=0;i<nbCapteurs["W"];i++){
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
	</script>
</body>