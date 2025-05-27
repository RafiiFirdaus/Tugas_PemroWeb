<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        #kanvas {
            background-color: white;
            justify-content: center;
            align-items: center;
            display: flex;
            margin: auto;
            position: relative;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f0f0f0;

        }

        .header {
            text-align: center;
            align-items: center;
            /* padding-top: 50px; */
            padding-top: 20px;
            /* text-align: center; */
            /* position: absolute; */
            display: flex;
            /* transform: translate(-50%, -50%); */
            flex-direction: column;
            /* align-items: center; */
            z-index: 1;
        }

        .grafik {
            padding: 20px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <div class="header">
            
            <form method="get" id="form">
                <input type="text" id="label" name="label" placeholder="Label" required>
                <input type="number" id="value" name="value" placeholder="Value" required>
                <button type="submit" onclick="addData()">Add Data</button>
            </form>
            
        </div>
    
        <div class="grafik">
            <canvas id="kanvas" height="400"  width="700"></canvas>
        </div>
    </div>
    
     <script>
        // Data awal
        const labels = ["January", "February", "March", "April", "May"];
        const data = [10, 20, 15, 25, 30];
        // Inisialisasi grafik
        const ctx = document.getElementById('kanvas').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            }, 
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false 
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false 
                            }
                        }
                    },
                    elements: {
                        line: {
                            tension: 0 
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                            }
                        }
                }
        });
        // Fungsi untuk menambah data
        function addData() {
            const label = document.getElementById('label').value;
            const value = document.getElementById('value').value;
            if (label && value) {
                myChart.data.labels.push(label);
                myChart.data.datasets[0].data.push(value);
                myChart.update();
                // Clear input fields
                document.getElementById('label').value = '';
                document.getElementById('value').value = '';
            }
        }
    </script>
</body>
</html>