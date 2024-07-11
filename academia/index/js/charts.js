function getArduino(result){
  google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = new google.visualization.DataTable();
              data.addColumn('number','Identificação');
              data.addColumn('number', 'Medição');
              result.forEach(el => {
                console.log(el);
                data.addRow([el.id_arduino, el.acc]);
              });
              var options = {
                title: 'Gráfico da aceleração',
              };
            var chart = new google.charts.Line(document.getElementById('grafico'));
            chart.draw(data, google.charts.Line.convertOptions(options));
        }
      };

