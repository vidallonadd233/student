@extends('layout.app')

@section('title', 'Dashboard')

@section('content')


@if(session('toast_success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('toast_success') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-center' // Use 'top' or 'top-end' for toast
            });
        });
    </script>
@endif

<div class="mt-3 container-fluid">
    <div class="row">
        @php
            $cards = [
                ['icon' => 'bi-file-earmark-bar-graph-fill', 'title' => 'Reports', 'count' => $reportCount],
                ['icon' => 'bi-check-circle-fill', 'title' => 'Students', 'count' => $studentsCount],
                ['icon' => 'bi-exclamation-triangle-fill', 'title' => 'Solved', 'count' => $solvedCount],
                ['icon' => 'bi-clock-fill', 'title' => 'Unsolved', 'count' => $unsolvedCount],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="mb-4 col-12 col-sm-6 col-lg-3">
                <div class="text-white card bg-success h-100">
                    <div class="card-body d-flex align-items-center bg-success">
                        <i class="bi {{ $card['icon'] }} fs-1 me-3"></i>
                        <div>
                            <h6 class="mb-1 card-title" style="font-weight: normal">{{ $card['title'] }}</h6>
                            <p class="card-text fs-4">{{ $card['count'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Charts Section -->
<div class="container">
    <div class="row d-flex justify-content-around">

        @php
            $charts = [
                ['id' => 'barChart', 'title' => 'Total number of reports and students'],
                ['id' => 'incidentTrendsChart', 'title' => 'Incident Trends'],
                ['id' => 'statusChart', 'title' => 'Overview of Report Status'],
                ['id' => 'pieChart', 'title' => 'Male and Female Students']

            ];
        @endphp

        @foreach ($charts as $chart)
            <div class="mb-4 col-lg-6 d-flex flex-column">
                <div class="card h-100 flex-grow-1">
                    <h1 class="fw-normal d-flex justify-content-center align-items-center" style="font-size: 1.2rem;">
                        {{ $chart['title'] }}
                    </h1>
                    <div class="card-body">
                        <canvas id="{{ $chart['id'] }}"></canvas>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Chart.js Visualization -->
<!-- Chart.js Visualization -->
<!-- Chart.js Visualization -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Bar Chart
    new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [ 'April', 'May', 'June','July'],
            datasets: [
                {
                    label: 'Reports',
                    data: [{{ $reportCount }}],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Students',
                    data: [{{ $studentsCount }}],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

  // Bar Chart
// Bar Chart (Incident Trends)
new Chart(document.getElementById('incidentTrendsChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: [ 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'Incidents',
                data: [{{ $reportCount }}],
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});


    // Doughnut Chart (Status Chart)
    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Solved', 'Unsolved'],
            datasets: [
                {
                    label: 'Report Status',
                    data: [{{ $solvedCount }}, {{ $unsolvedCount }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true
        }
    });

    // Pie Chart
    new Chart(document.getElementById('pieChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [
                {
                    label: 'Students',
                    data: [{{ $maleCount }}, {{ $femaleCount }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true
        }
    });

    // Activity Log Chart
    // TODO: Add configuration for the Activity Log Chart if needed
});
</script>

@endsection
