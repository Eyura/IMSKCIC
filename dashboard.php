<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');

$user = $_SESSION['user'];

include('status_graph.php');
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard - Inventory Management</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 </head>
 <body>
    
    <div id="dashboardMainContainer">
        <?php include ('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include ('partials/app-topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                <!-- <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">
                        uygiygbh7gho7iugog
                    </p>
                </figure> -->

                <h1 class="section_header">Data from Database</h1>

                <!-- Bar Chart -->
                <canvas id="myChart"></canvas>

                <!-- Data Table -->
                <h1 class="section_header">Data Table</h1>
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>Assets</th>
                            <th>Stocks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data rows will be appended here by JavaScript -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js?v=?= time(); ?>"></script>

    <script>
        // Fetch data from PHP (status_graph.php) via JavaScript
        fetch('status_graph.php?json=1')  // Add the ?json=1 query parameter here
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                return response.json();  // Parse the response as JSON
            })
            .then(data => {
                console.log('Fetched Data:', data);  // Debugging step, check in the console

                // Extract labels and values for the chart
                const labels = data.map(item => item.colAssets);
                const values = data.map(item => item.colStocks);

                // Populate the table with data
                const tableBody = document.getElementById('dataTable').querySelector('tbody');
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${item.colAssets}</td><td>${item.colStocks}</td>`;
                    tableBody.appendChild(row);
                });

                // Bar Chart setup with Chart.js
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Stocks',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>
 </body>
 </html>