@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h4 class="card-title text-white">Total Ruang Kelas</h4>
                                <p class="card-text">{{ $ruangKelasCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h4 class="card-title text-white">Total Ruang Pejabat</h4>
                                <p class="card-text">{{ $ruangPejabatCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class=" col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Current Amount Booking This Month</h4>
                    </div>
                    <div class="card-body">
                        <div style="height:400px">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>

                            <canvas class="horizontal-bar-chart-ex chartjs chartjs-render-monitor" data-height="400"
                                width="459" height="400" style="display: block; width: 459px; height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection

@section('script')
    @if (Session::has('error'))
        <script>
            toastr.danger("{{ session('error') }}", 'Error');
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif

    <script src="{{ asset('app-asset/vendors/js/charts/chart.min.js') }}"></script>
    <script>
        $(window).on('load', function() {

            var labels = @json($labels); // Convert the PHP array to a JavaScript array
            var data = @json($data); // Convert the PHP array to a JavaScript array

            var chartWrapper = $('.chartjs'),
                horizontalBarChartEx = $('.horizontal-bar-chart-ex'),
                polarAreaChartEx = $('.polar-area-chart-ex');

            // Color Variables
            var primaryColorShade = '#836AF9',
                yellowColor = '#ffe800',
                successColorShade = '#28dac6',
                warningColorShade = '#ffe802',
                warningLightColor = '#FDAC34',
                infoColorShade = '#299AFF',
                greyColor = '#4F5D70',
                blueColor = '#2c9aff',
                blueLightColor = '#84D0FF',
                greyLightColor = '#EDF1F4',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                lineChartPrimary = '#666ee8',
                lineChartDanger = '#ff4961',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

            if (chartWrapper.length) {
                chartWrapper.each(function() {
                    $(this).wrap($('<div style="height:' + this.getAttribute('data-height') +
                        'px"></div>'));
                });
            }

            // Horizontal Bar Chart
            // --------------------------------------------------------------------
            if (horizontalBarChartEx.length) {
                new Chart(horizontalBarChartEx, {
                    type: 'horizontalBar',
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderSkipped: 'right'
                            }
                        },
                        tooltips: {
                            // Updated default tooltip UI
                            shadowOffsetX: 1,
                            shadowOffsetY: 1,
                            shadowBlur: 8,
                            shadowColor: tooltipShadow,
                            backgroundColor: window.colors.solid.white,
                            titleFontColor: window.colors.solid.black,
                            bodyFontColor: window.colors.solid.black
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                            display: false
                        },
                        layout: {
                            padding: {
                                bottom: -30,
                                left: -25
                            }
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    zeroLineColor: grid_line_color,
                                    borderColor: 'transparent',
                                    color: grid_line_color
                                },
                                scaleLabel: {
                                    display: true
                                },
                                ticks: {
                                    min: 0,
                                    fontColor: labelColor
                                }
                            }],
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                scaleLabel: {
                                    display: true
                                },
                                ticks: {
                                    fontColor: labelColor
                                }
                            }]
                        }
                    },
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            barThickness: 15,
                            backgroundColor: window.colors.solid.info,
                            borderColor: 'transparent'
                        }]
                    }
                });

            }

        });
    </script>
@endsection
