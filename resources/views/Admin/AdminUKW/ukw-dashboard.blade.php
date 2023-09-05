@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <div class="row">
            <div class="col-12">

                <x-ukw.inventory-stock-low />

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Current Amount Booking This Month</h4>
                    </div>
                    <div class="card-body">
                        <div style="height:350px">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas class="polar-area-chart-ex chartjs chartjs-render-monitor" data-height="350"
                                width="459" height="350" style="display: block; width: 459px; height: 350px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                        <div class="header-left">
                            <p class="card-subtitle text-muted mb-25">Balance Stock Alat Tulis</p>
                            <h6 class="card-title">{{ $totalQuantity }} Stock</h6>
                        </div>
                        <div class="header-right d-flex align-items-center mt-sm-0 mt-1">

                        </div>
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
                            {{-- <canvas id="myBarChart chartjs chartjs-render-monitor" width="400" height="200"></canvas> --}}
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

            // Polar Area Chart
            // --------------------------------------------------------------------
            if (polarAreaChartEx.length) {
                let chartData = {!! json_encode($chartData) !!};

                let labels = chartData.map(item => item.label);
                let data = chartData.map(item => item.value);

                var polarExample = new Chart(polarAreaChartEx, {
                    type: 'polarArea',
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                boxWidth: 15,
                                fontColor: labelColor
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
                        scale: {
                            min: 0,
                            scaleShowLine: true,
                            scaleLineWidth: 1,
                            ticks: {
                                display: false,
                                fontColor: labelColor
                            },
                            reverse: false,
                            gridLines: {
                                display: false
                            },
                            r: {
                                pointLabels: {
                                    display: true,
                                    centerPointLabels: true,
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        },
                        animation: {
                            animateRotate: false
                        }
                    },
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Booking Counts By Unit',
                            backgroundColor: [
                                primaryColorShade,
                                warningColorShade,
                                window.colors.solid.primary,
                                infoColorShade,
                                greyColor,
                                successColorShade
                            ],
                            data: data,
                            borderWidth: 0
                        }]
                    }
                });
            }

        });
    </script>
@endsection
