

<!-- Bootstrap 5.33 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-3">
    <div class="row">
        <!-- Pie Chart Section -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Incident Types</h5>
                    <div id="pieChart" style="width:100%; height:300px;"></div>
                </div>
            </div>
        </div>

        <!-- Line Chart Section -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Monthly Cases (Line Chart)</h5>
                    <div id="lineChart" style="width:100%; height:300px;"></div>
                </div>
            </div>
        </div>

        <!-- Bar Chart Section -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Monthly Cases (Bar Chart)</h5>
                    <div id="barChart" style="width:100%; height:300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plotly Loader -->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>
    // Pie Chart
    function drawPieChart() {
        const data = [{
            values: [35, 24, 18, 12, 5],
            labels: ['Verbal Bullying', 'Social Bullying', 'Physical Bullying', 'Cyberbullying', 'Other'],
            type: 'pie',
            hole: 0.4
        }];

        const layout = {
            title: 'Bullying Incident Types'
        };

        Plotly.newPlot('pieChart', data, layout);
    }

    // Line Chart
    function drawLineChart() {
        const data = [{
            x: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            y: [10, 12, 8, 15, 18, 13, 16, 20, 22, 19, 14, 17],
            type: 'scatter',
            mode: 'lines+markers',
            line: {shape: 'spline', color: '#ff5733'}
        }];

        const layout = {
            title: 'Bullying Cases per Month',
            xaxis: { title: 'Month' },
            yaxis: { title: 'Number of Cases' }
        };

        Plotly.newPlot('lineChart', data, layout);
    }

    // Bar Chart
    function drawBarChart() {
        const data = [{
            x: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            y: [10, 12, 8, 15, 18, 13, 16, 20, 22, 19, 14, 17],
            type: 'bar',
            marker: { color: '#42a5f5' }
        }];

        const layout = {
            title: 'Bullying Cases per Month',
            xaxis: { title: 'Month' },
            yaxis: { title: 'Number of Cases' },
            margin: { t: 30, l: 50, r: 30 }
        };

        Plotly.newPlot('barChart', data, layout);
    }


    drawPieChart();
    drawLineChart();
    drawBarChart();
</script>

<!-- Bootstrap 5.33 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


