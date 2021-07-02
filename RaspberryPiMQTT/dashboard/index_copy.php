<html>  
  <head>  
    <title>Panel "HighChart"</title>  
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data-2012-2022.min.js"></script> 
  </head> 
<body>
  <nav class="navbar navbar-expand-lg navbar-light" style="border-bottom: 1px solid #eee">
    <button style="border:none; background:none" id="btnCambiarVista">
      <img src="chart-icon-free-8.jpg" alt="" style="height:30px">
      
    </button>
    <br>
    <h6 style="color:#333">Cambiar vista</h6>
    <select name="" id="intervalo" style="position: fixed; left: 49%; display: none">
      <option value="hoy" selected>Hoy</option>
      <option value="siete">7 días atrás</option>
    </select>
  </nav>
  <div class="container" style="padding-top: 10px;" id="containerSolid">
    <div id="humedadSuelo">
      <div class="row">
        <div class="card col-6">
          <div class="card-body">
            <div id="container-rpm1" class="chart-container"></div> 
          </div>
        </div>
        <div class="card col-6">
          <div class="card-body">
            <div id="container-rpm11" class="chart-container"></div>  
          </div>
        </div>
      </div>
    </div>
    <div id="humedadSueloNumerico" style="display:none">
      <div class="row">
        <div class="card col-6">
          <div class="card-body">
            <div id="container-rpm1Numerico" class="chart-container"></div> 
          </div>
        </div>
        <div class="card col-6">
          <div class="card-body">
            <div id="container-rpm11Numerico" class="chart-container"></div>  
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="">
      <div class="card col-6">
        <div class="card-body">
          <div id="container-rpm" class="chart-container"></div> 
        </div>
      </div>
      <div class="card col-6">
        <div class="card-body">
          <div id="container-rpm2" class="chart-container"></div> 
        </div>
      </div>
    </div>
    <!--
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#plantsModal" style="margin-top:10px;">Cambiar tipo de planta</button>  
    -->
    <!--Carrousel-->
  </div>
  <div class="container" id="containerLine" style="display: none; padding-top: 10px;">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="border: 1px solid #eee; height: 800px">
      <div class="carousel-inner" style="padding-top: 20px;">
        <div class="carousel-item active">
          <div id="container">
          </div>
        </div>
        <div class="carousel-item">
          <div id="container1">
          </div>
        </div>
        <div class="carousel-item">
          <div id="container2">
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</body>
<div class="modal fade in" tabindex="-1" role="dialog" id="plantsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selecciona un tipo de planta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select name="" id="plant" class="form-control">
            <option value="">Seleccionar...</option>
            <option value="desert">Desértica</option>
            <option value="tropical">Tropical</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aplicar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    var jsonData = '';
    var gaugeOptions = {
    chart: {
        type: 'solidgauge'
    },

    title: null,

    pane: {
        center: ['50%', '70%'],
        size: '100%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    exporting: {
        enabled: false
    },

    tooltip: {
        enabled: false
    },

    // the value axis
    yAxis: {
        lineWidth: 0,
        tickWidth: 1,
        minorTickInterval: null,
        tickAmount: 1,
        title: {
            y: -150,
            style: {
              fontSize: '15pt',
              fontFamily: 'Arial',
              color: '#555555'
            }
        },
        labels: {
            y: 0
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 1,
                useHTML: true
            }
        }
    }
};

    $(function(){
      console.log('loading page..');
      
      $('.carousel').carousel({
        interval: false
      });

      $('.carousel-control-next-icon').css('filter', 'invert(1)');
      
      $('.carousel-control-prev-icon').css('filter', 'invert(1)');
      
      // The RPM gauge
      chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 50,
              title: {
                  text: 'Temperatura'
              }
          },

          series: [{
              name: 'Grados',
              data: [25],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '° centigrados' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));
      chartRpm1 = Highcharts.chart('container-rpm1', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 100,
              title: {
                  text: 'Humedad suelo arriba'
              }
          },

          series: [{
              name: 'Humedad suelo',
              data: [0],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ' '
              }
          }]

      }));

      chartRpm1Numerico = Highcharts.chart('container-rpm1Numerico', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 500,
              title: {
                  text: 'Humedad suelo arriba'
              }
          },

          series: [{
              name: 'Humedad suelo',
              data: [0],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ' '
              }
          }]

      }));

      chartRpm11 = Highcharts.chart('container-rpm11', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 100,
              title: {
                  text: 'Humedad suelo abajo'
              }
          },

          series: [{
              name: 'Humedad suelo',
              data: [0],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ' '
              }
          }]

      }));

      chartRpm11Numerico = Highcharts.chart('container-rpm11Numerico', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 500,
              title: {
                  text: 'Humedad suelo abajo'
              }
          },

          series: [{
              name: 'Humedad suelo',
              data: [0],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ' '
              }
          }]

      }));

      chartRpm2 = Highcharts.chart('container-rpm2', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 100,
              title: {
                  text: 'Humedad ambiental'
              }
          },

          series: [{
              name: 'Humedad ambiental',
              data: [50],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      'ambiental' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));
      
      repeat();    
    });



    function getTemperature(){
        var urlServer = '';
        if($('#intervalo').val() == 'hoy'){ // or this.value == 'volvo'
          urlServer = 'http://192.168.100.250/dashboard/ej12Highcharts.php';
        }else{
          urlServer = 'http://192.168.100.250/dashboard/ej12HighchartsSemana.php';
        }
        
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
                }
                
                charts(jsonData);
              }
              
          }
        }
        
    

    function repeat(){
        setInterval('getTemperature()', 25000);
        //$('#plantsModal').modal('show');
    }

    function charts(jsonData){
      console.log(jsonData);
      //gráfica solid gauge 1 (temperatura)
      chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 50,
              title: {
                  text: 'Temperatura'
              }
          },

          series: [{
              name: 'Degrees',
              data: jsonData[1],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '° centigrados' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ' ° centigrados'
              }
          }]

      }));

      //gráfica solid gauge 2 (humedad suelo 1)
      chartRpm1 = Highcharts.chart('container-rpm1', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 100,
              title: {
                  text: 'Humedad suelo arriba'
              }
          },

          series: [{
              name: 'Humedad suelo arriba',
              data: jsonData[2],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '% de humedad' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));

      //gráfica solid gauge 2 (humedad suelo 1 numérico)
      chartRpm1 = Highcharts.chart('container-rpm1Numerico', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 500,
              title: {
                  text: 'Humedad suelo arriba'
              }
          },

          series: [{
              name: 'Humedad suelo arriba',
              data: jsonData[5],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      'valor relativo (en base al sensor)' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));

      //gráfica solid gauge 2 (humedad suelo 2)
      chartRpm1 = Highcharts.chart('container-rpm11', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 100,
              title: {
                  text: 'Humedad suelo abajo'
              }
          },

          series: [{
              name: 'Humedad suelo abajo',
              data: jsonData[3],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '% de humedad' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));
      
      //gráfica solid gauge 2 (humedad suelo 2 numérico)
      chartRpm1 = Highcharts.chart('container-rpm11Numerico', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 500,
              title: {
                  text: 'Humedad suelo abajo'
              }
          },

          series: [{
              name: 'Humedad suelo abajo',
              data: jsonData[6],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      'valor relativo (en base al sensor)' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));
      

      //gráfica solid gauge 3 (humedad ambiental)
      chartRpm2 = Highcharts.chart('container-rpm2', Highcharts.merge(gaugeOptions, {
          yAxis: {
              min: 0,
              max: 100,
              title: {
                  text: 'Humedad ambiental'
              }
          },

          series: [{
              name: 'Humedad ambiental',
              data: jsonData[4],
              dataLabels: {
                  format:
                      '<div style="text-align:center">' +
                      '<span style="font-size:25px">{y:.1f}</span><br/>' +
                      '<span style="font-size:12px;opacity:0.4">' +
                      '% ambiental' +
                      '</span>' +
                      '</div>'
              },
              tooltip: {
                  valueSuffix: ''
              }
          }]

      }));
      //gráfica lineal 1
      $('#container').highcharts({
        chart:{
          type : 'line',
          height: '800'
        },
        time: {
          timezone: 'America/Los_Angeles'
        },
        title: {
          text: 'Humedad suelo'
        },
        xAxis: {
          title:{
            text: 'Tiempo'
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
            text: 'Valores'
          }
        },
        series: [{
          name: 'Parte alta',
          data: jsonData[2]
        },{
          name: 'Parte baja',
          data: jsonData[3]
        }
        ],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 1000
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
      //gráfica lineal 2 (temperatura)
      $('#container1').highcharts({
        chart:{
          type : 'line',
          height: '800'
        },
        time: {
          timezone: 'America/Los_Angeles'
        },
        title: {
          text: 'Temperatura'
        },
        xAxis: {
          title:{
            text: 'Tiempo'
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
            max: 60,
            text: 'Valores'
          }
        },
        series: [{
          name: 'Grados',
          data: jsonData[1]
        }
        ],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 1000
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
      //gráfica lineal 3 (humedad ambiental)
      $('#container2').highcharts({
        chart:{
          type : 'line',
          height: '800'
        },
        time: {
          timezone: 'America/Los_Angeles'
        },
        title: {
          text: 'Humedad ambiental'
        },
        xAxis: {
          title:{
            text: 'Tiempo'
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
            max: 100,
            text: 'Valores'
          }
        },
        series: [{
          name: 'Porcentaje',
          data: jsonData[4]
        }
        ],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 1000
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

    $( "#btnCambiarVista" ).click(function() {
      if($('#containerSolid').css('display') == 'none')
      {
        
        $('#containerLine').css('display', 'none');
        $('#containerSolid').css('display', 'block');
        $('#intervalo').css('display', 'none');
        
      }else{
        $('#containerLine').css('display', 'block');
        $('#containerSolid').css('display', 'none');
        $('#intervalo').css('display', 'block');
      }
    });

    $("#humedadSuelo").click(function(){
      $(this).css('display', 'none');
      $("#humedadSueloNumerico").css('display', 'block');
    });

    $("#humedadSueloNumerico").click(function(){
      $(this).css('display', 'none');
      $("#humedadSuelo").css('display', 'block');
    });
    

</script>