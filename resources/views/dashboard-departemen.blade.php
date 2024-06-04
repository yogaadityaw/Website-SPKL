@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush


@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Departemen</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary">Week</a>
                                    <a href="#" class="btn">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        "use strict";

        // Function to fetch data from the endpoint and update the chart
        async function fetchChartData() {
            try {
                const response = await fetch('/admin/getChart');
                const data = await response.json();

                // Assuming the response structure contains labels and data arrays
                const labels = data.labels;
                const chartData = data.data;

                var statistics_chart = document.getElementById("myChart").getContext('2d');

                var myChart = new Chart(statistics_chart, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Statistics',
                            data: chartData,
                            borderWidth: 5,
                            borderColor: '#6777ef',
                            backgroundColor: 'transparent',
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#6777ef',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                },
                                ticks: {
                                    stepSize: 150
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    color: '#fbfbfb',
                                    lineWidth: 2
                                }
                            }]
                        },
                    }
                });
            } catch (error) {
                console.error('Error fetching chart data:', error);
            }
        }

        fetchChartData();
    </script>
@endpush
