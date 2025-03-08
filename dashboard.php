<?php
session_start();
if (!isset($_SESSION['user']))
    header('location: login_pages.php');

$user = $_SESSION['user'];

include('status_graph.php'); // File untuk data grafik batang
include('status_graph_co.php'); // File untuk data Checkout
include('connection.php'); // Koneksi ke database

// Mengambil jumlah total assets dari database
try {
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM assets");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalAssets = $result['total'];
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
    $totalAssets = 0; // Set default jika terjadi error
}

// Mengambil data checkout per bulan dan tahun dari tabel checkout
try {
    $stmt = $conn->prepare("SELECT YEAR(checkout_at) as checkout_year, MONTH(checkout_at) as checkout_month, SUM(quantity_ordered) as total_checkout 
                            FROM checkout 
                            GROUP BY checkout_year, checkout_month
                            ORDER BY checkout_year, checkout_month");

    $stmt->execute();
    $checkout_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $checkout_json = json_encode($checkout_data);
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory Management</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">



                    <!-- Chart Container with Flexbox -->
                    <div class="chart-container">
                        <!-- Bar Chart -->
                        <div class="chart-box">
                            <h1 class="section_header">Assets Stock</h1>
                            <canvas id="myChart"></canvas>
                        </div>

                        <!-- Line Chart -->
                        <div class="chart-box">
                            <h1 class="section_header">Checkout Assets Per Month</h1>
                            <canvas id="checkoutLineChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
    <script>
        // Grafik Batang (Data dari status_graph.php)
        fetch('status_graph.php?json=1')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.colAssets);
                const values = data.map(item => item.colStocks);

                const backgroundColors = [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ];

                const adjustedBackgroundColors = labels.map((_, i) => backgroundColors[i % backgroundColors.length]);

                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '',
                            data: values,
                            backgroundColor: adjustedBackgroundColors,
                            borderWidth: 1,
                            borderRadius: 20
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: { grid: { display: false } },
                            y: { beginAtZero: true, grid: { borderDash: [5, 5], color: '#ddd' }, ticks: { stepSize: 2 } }
                        },
                        plugins: {
                            legend: { display: false },  // Hide the legend completely for bar chart
                            tooltip: { enabled: true, backgroundColor: 'rgba(0,0,0,0.7)', bodyFont: { size: 14 } }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching bar chart data:', error));

        // Grafik Garis (Data Checkout per Bulan)
        const checkoutData = <?php echo $checkout_json; ?>;  // Data Checkout dari PHP

        // Menyiapkan data labels dan data total checkout
        const monthNames = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        // Menyusun data berdasarkan tahun
        const dataByYear = {};

        checkoutData.forEach(item => {
            const month = item.checkout_month - 1;  // PHP menggunakan 1-12 untuk bulan, JavaScript menggunakan 0-11
            const yearMonth = `${monthNames[month]}`;

            // Kelompokkan data berdasarkan tahun
            if (!dataByYear[item.checkout_year]) {
                dataByYear[item.checkout_year] = [];
            }
            dataByYear[item.checkout_year].push({
                month: yearMonth,
                total_checkout: item.total_checkout
            });
        });

        // Menyiapkan warna berbeda untuk tiap tahun
        const yearColors = {
            '2021': 'rgba(75, 192, 192, 1)',  // Warna untuk tahun 2020
            '2022': 'rgba(54, 162, 235, 1)',  // Warna untuk tahun 2021
            '2023': 'rgba(255, 99, 132, 1)',  // Warna untuk tahun 2022
            '2024': 'rgba(153, 102, 255, 1)',  // Warna untuk tahun 2023
            // Tambahkan lebih banyak tahun dan warna jika diperlukan
        };

        // Menyiapkan label bulan/tahun
        const labels = [''];
        Object.keys(dataByYear).forEach(year => {
            dataByYear[year].forEach(item => {
                if (!labels.includes(item.month)) {
                    labels.push(item.month);
                }
            });
        });

        // Menyiapkan data untuk tiap tahun
        const datasets = [];
        Object.keys(dataByYear).forEach(year => {
            const dataPoints = [0];  // Menambahkan data kosong pada awal untuk setiap tahun
            labels.slice(1).forEach(month => {  // Mulai dari indeks 1 untuk menghindari label kosong
                const foundItem = dataByYear[year].find(item => item.month === month);
                dataPoints.push(foundItem ? foundItem.total_checkout : 0);
            });

            datasets.push({
                label: `${year}`,
                data: dataPoints,
                backgroundColor: yearColors[year] ? `${yearColors[year]}` : 'rgba(0, 0, 0, 0.1)',
                borderColor: yearColors[year] || 'rgba(0, 0, 0, 1)',
                borderWidth: 2,
                fill: false,  // Jangan mengisi area bawah garis
                pointRadius: 5,
                pointBackgroundColor: yearColors[year] || 'rgba(0, 0, 0, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                lineTension: 0.4,
                // Shadow Effect
                shadowOffsetX: 3,  // Offset bayangan di sumbu X
                shadowOffsetY: 3,  // Offset bayangan di sumbu Y
                shadowBlur: 10,  // Jumlah blur bayangan
                shadowColor: 'rgba(0, 0, 0, 0.3)'  // Warna bayangan
            });
        });

        // Grafik Garis (Line Chart)
        const ctxLine = document.getElementById('checkoutLineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: labels,  // Menampilkan label bulan/tahun
                datasets: datasets  // Data untuk setiap tahun
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false  // Menyembunyikan garis grid pada sumbu X
                        },
                        ticks: {
                            padding: 10,  // Menambahkan padding pada sumbu X untuk memberi jarak lebih dari sumbu Y
                            autoSkip: false // Jangan otomatis melewati label
                        }
                    },
                    y: {
                        beginAtZero: true,  // Mulai dari 0 pada sumbu Y
                        grid: {
                            color: '#ddd',  // Warna garis grid sumbu Y
                            borderDash: [5, 5]  // Garis grid dengan pola garis putus-putus
                        },
                        ticks: {
                            stepSize: 2,  // Ukuran langkah pada sumbu Y
                            font: {
                                size: 12  // Ukuran font pada label sumbu Y
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,  // Menampilkan legend untuk setiap tahun
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0,0,0,0.7)',  // Warna tooltip
                        bodyFont: {
                            size: 14  // Ukuran font pada tooltip
                        }
                    }
                }
            }
        });

    </script>

</body>

</html>