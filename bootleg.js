/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function createTable(data) {
    var options = {
        showRowNumber: false,
        page: 'enable',
        pageSize: 15,
        sortColumn: 0
    }
    var table = new google.visualization.Table(document.getElementById('contactdiv'));
    table.draw(data, options);
}
function createPie(data){
    var pieoptions = {
      title: 'Race Percentages',
      legend: {position:'none'},
      height: 250
    }
    var piechart = new google.visualization.PieChart(document.getElementById('chart_div'));
    piechart.draw(data, pieoptions);
}
function createScatter(data){
    var scatteroptions = {
      title: 'Race vs. Income Comparison',
      hAxis: {title: 'Income', minValue: 0},
      vAxis: {title: 'Percentage Race', minValue: 0},
      colors: ['wheat','#993300'],
      legend: 'none',
      height: 250
    }
    var scatterplot = new google.visualization.ScatterChart(document.getElementById('scatter_div'));
    scatterplot.draw(data, scatteroptions);
}

