<html>  
<head>  
  <title>Panel "HighChart"</title>  
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data-2012-2022.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
</head>
<body style=" background-image: url(https://wallpapershome.com/images/pages/pic_h/5175.jpg); background-repeat:no-repeat;">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Greenhouse</a>
    <a href="logout.php" class="text-danger" style="float:right; position: absolute; right: 10">Salir</a>
  </button>
  </nav>
  <div class="container" style="padding-top: 10px;">
    <h2 style="color: #fff">Current values</h2>
    <div class="row">
      <div class="card col-6">
        <div class="card-body">
          <h5 class="card-title">Grados celcius</h5>
          <h4 id="grados">Calculando...  </h4>
          <span class="badge badge-pill badge-warning" id="warningGrados" style="display:none; width: 5%">!</span>
          <div style="width: 100%">
            
            <h6 style="color:#fff; width: 100%" id="errorGrados">Valor fuera de protocolos</h6>
          </div>
          
        </div>
      </div>
      <div class="card col-6">
        <div class="card-body">
          <h5 class="card-title">Humedad relativa</h5>
          <h4 id="humedad">Calculando...</h4>
          <div>
            <span class="badge badge-pill badge-warning" id="warningHumedad" style="display:none; width: 5%">!</span> 
            <h6 style="color:#fff" id="errorHumedad">Valor fuera de protocolos</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row card">
      <div class="col-md-12 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">
            <div id="container">

            </div>
            

          </div>
        </div>
      </div>
    </div>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#plantsModal" style="margin-top:10px">Cambiar tipo de planta</button>
    <button onclick="client.connect(options);">Conectar</button>
    <button onclick="client.subscribe('utt0317115032/value', {qos: 2}); alert('Subscribed');">Subscribir</button>
    <button onclick="publish('Start', 'utt0317115032/test', 2);">Iniciar</button>
	  <button onclick="publish('Stop', 'utt0317115032/test', 2);">Detener</button>
  </div>
</body>
<div class="modal fade in" tabindex="-1" role="dialog" id="plantsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select a plant type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select name="" id="plant" class="form-control">
            <option value="">Seleccionar...</option>
            <option value="desert">Desert</option>
            <option value="tropical">Tropical</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Apply</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    var jsonData = '';
    var client = new Paho.MQTT.Client("mqtt.eclipse.org", 80, "1");
    // Connect options
    var options = {
        timeout: 3,
        // Gets called if the connection has sucessfully been established
        onSuccess: function() {
      alert("Connected");
        },
        // Gets called if the connection could not be established
        onFailure: function(message) {
      alert("connection failed: " + message.errorMessage);
        }
    };

    // Gets called if the websocket/mqtt connection gets disconnected for any reason
    client.onConnectionLost = function(responseObject) {
        // Depending on your escenario you could implement a reconnect logic here
        alert("connection lost: " + responseObject.errorMessage);
    };

    client.onMessageArrived = function(message) {
        // Do something with the push message you received
        console.log(message);
    };
    $(function(){
      console.log('loading page..');
      repeat();    
    });

    // Creates a new Messaging.Message object and sends it to the Broker
    function publish(payload, topic, qos) {
        // Send your message (also possible to serialize it as JSON
        // or just use a String, no limitations)
        var message = new Paho.MQTT.Message(payload);
        message.destinationName = topic;
        message.qos = qos;
        client.send(message);
    }

    function getTemperature(){
        var urlServer = 'http://192.168.0.250/dashboard/ej12Highcharts.php';
        var x = new XMLHttpRequest();
        var json;
        //petition
        x.open('GET', urlServer, true);
        x.send();

        //event handler
        x.onreadystatechange = function()
        {
          //check status
          if (x.readyState == 4 & x.status == 200)
          {
              //read response
              data = x.responseText;
              var JSONdata = JSON.parse(data);
              if (typeof JSONdata !== 'undefined' && JSONdata.length > 0) {
                jsonData = JSONdata;
                var grados = document.getElementById('grados');
                var humedad = document.getElementById('humedad');
                if($('#plant').val() === 'tropical'){ // or this.value == 'volvo'
                  if(jsonData[1][9] > 26 || jsonData[1][9] < 16) {
                    grados.style.color = 'red';
                    document.getElementById('warningGrados').style.display = 'block';
                    document.getElementById('errorGrados').style.color = '#666';
                  }else{
                    grados.style.color = 'black';
                    document.getElementById('warningGrados').style.display = 'none';
                    document.getElementById('errorGrados').style.color = '#fff';
                  }
                  grados.innerHTML = jsonData[1][9] + "°";
                  if(jsonData[2][9] < 50){
                    humedad.style.color = 'red';
                    document.getElementById('warningHumedad').style.display = 'block';
                    document.getElementById('errorHumedad').style.color = '#666';
                  }else{
                    humedad.style.color = 'black';
                    document.getElementById('warningHumedad').style.display = 'none';
                    document.getElementById('errorHumedad').style.color = '#fff';
                  }
                  humedad.innerHTML = jsonData[2][9] + "%";
                }else if($('#plant').val() === 'desert'){
                  if(jsonData[1][9] < 25) {
                    grados.style.color = 'red';
                    document.getElementById('warningGrados').style.display = 'block';
                    document.getElementById('errorGrados').style.color = '#666';
                  }else{
                    grados.style.color = 'black';
                    document.getElementById('warningGrados').style.display = 'none';
                    document.getElementById('errorGrados').style.color = '#fff';
                  }
                  grados.innerHTML = jsonData[1][9] + "°";
                  if(jsonData[2][9] < 5 || jsonData[2][9] > 60){
                    humedad.style.color = 'red';
                    document.getElementById('warningHumedad').style.display = 'block';
                    document.getElementById('errorHumedad').style.color = '#666';
                  }else{
                    humedad.style.color = 'black';
                    document.getElementById('warningHumedad').style.display = 'none';
                    document.getElementById('errorHumedad').style.color = '#fff';
                  }
                  humedad.innerHTML = jsonData[2][9] + "%";
                }
                
                charts(jsonData);
              }
              
          }
        }
        
    }
      
    function repeat(){
        setInterval('getTemperature()', 10000);
        $('#plantsModal').modal('show');
    }

    function charts(jsonData){
      $('#container').highcharts({
        chart:{
          type : 'line'
        },
        time: {
          timezone: 'America/Los_Angeles'
        },
        title: {
          text: 'Histórico'
        },
        xAxis: {
          title:{
            text: 'Time'
          },
          type: 'datetime',
          labels: {
            rotation: -45,
            format: '{value:%Y-%m-%d %H:%M}'
          },
          categories: jsonData[0]
        },
        yAxis: {
          title: {
            min: 0,
            max: 120,
            text: 'Values'
          }
        },
        series: [{
          name: 'Grados celcius',
          data: jsonData[1]
        }, {
          name: 'Humedad relativa',
          data: jsonData[2]
        }],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }

      });
    }
</script>