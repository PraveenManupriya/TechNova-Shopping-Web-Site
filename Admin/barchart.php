<?php 
include "../connection.php";

$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d'); 

$query = "SELECT DATE(orders.order_date) AS order_date, categories.name, SUM(orders.quantity) AS quantity 
          FROM categories 
          JOIN orders ON categories.id = orders.category 
          WHERE orders.order_date BETWEEN '$startDate' AND '$endDate'
          GROUP BY order_date, categories.name 
          ORDER BY order_date, categories.name"; 
$result = mysqli_query($conn, $query);

$dataArray = [["Date", "Category", "Quantity"]]; 
while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = [$row['order_date'], $row['name'], (int)$row['quantity']]; 
}

$dataJSON = json_encode($dataArray);
?>

<html>
<head>
    <style>
        .bar-container{
            width: 100%;
            height: 500px;
            padding-top: 20px;
            margin-bottom: 180px;
        }
        .box-date #dateForm{
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 40px;
            margin-bottom: 30px;
        }
        #barchart_material{
            width: 100%;
            height: 100%;

        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $dataJSON; ?>);

            var options = {
                chart: {
                    title: 'Daily Category Quantity Overview',
                    subtitle: 'Quantity of products in each category per day',
                },
                bars: 'vertical',
                isStacked: true 
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        function submitForm() {
            document.getElementById('dateForm').submit();
        }
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="bar-container">
        <h2>Daily Category Inventory Summary</h2>
        <div class="box-date">
            <form id="dateForm" method="post">
                <div class="date">
                    <p for="start_date">Start Date:</p>
                    <input type="date" id="start_date" name="start_date" value="<?php echo $startDate; ?>" onchange="submitForm()">
                </div>
                
                <div class="date">
                    <p for="end_date">End Date:</p>
                    <input type="date" id="end_date" name="end_date" value="<?php echo $endDate; ?>" onchange="submitForm()">
                </div>
            </form>
        </div>
        
        <div id="barchart_material"></div>
    </div>
</body>
</html>
