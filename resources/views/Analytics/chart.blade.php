


<div class="container">
    <h2>Incident Report Status Analytics</h2>
    <canvas id="statusChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusData = {
        labels: {!! json_encode($statusCounts->pluck('status')) !!},
        datasets: [{
            label: 'Number of Reports',
            data: {!! json_encode($statusCounts->pluck('count')) !!},
            backgroundColor: ['#36a2eb', '#ff6384'], // Colors for each status
            borderColor: ['#36a2eb', '#ff6384'],
            borderWidth: 1
        }]
    };

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: statusData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

