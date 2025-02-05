<?php 
include "../connection.php"; 

$query_orders = "SELECT c.name, SUM(o.quantity) as total_quantity 
    FROM orders o
    INNER JOIN categories c ON o.category = c.id
    GROUP BY c.name
";

$result_orders = mysqli_query($conn, $query_orders);


if (!$result_orders) {
    die("Query failed: " . mysqli_error($conn));
}


$chart_data = [['Category', 'Total Quantity']]; 

if (mysqli_num_rows($result_orders) > 0) {
    while ($row = mysqli_fetch_assoc($result_orders)) {
        $chart_data[] = [$row['name'], (int)$row['total_quantity']];
    }
} else {
    $chart_data[] = ['No data', 0];
}

$chart_data_json = json_encode($chart_data);
?>

<html>
  <head>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $chart_data_json; ?>);

        var options = {
          hAxis: {title: 'Category', titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
          isStacked: true, 
          areaOpacity: 0.5
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class="area-container">  
    <h2>Total Quantity per Category</h2>  
    <div id="chart_div"></div>
  </div>
  </body>
</html>
