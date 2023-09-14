@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <div class="row">
            <!--Bar Chart Start -->
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                        <div class="header-left">
                            <h4 class="card-title">Hardware Inventories</h4>
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
                            </div><canvas class="bar-chart-ex chartjs chartjs-render-monitor" data-height="400"
                                width="459" height="400" style="display: block; width: 459px; height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bar Chart End -->

            <!-- Horizontal Bar Chart Start -->
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                        <div class="header-left">
                            <h4 class="card-title">Cable Inventories</h4>
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
                            </div><canvas class="horizontal-bar-chart-ex chartjs chartjs-render-monitor" data-height="400"
                                width="459" height="400" style="display: block; width: 459px; height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Horizontal Bar Chart End -->
        </div>

        <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-8 col-12">
                <div class="card card-company-table">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Asset ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="fw-bolder">Dixons</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>test</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light-primary ">Technology</span>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex flex-column">
                                                <span class="fw-bolder mb-25">23.4k</span>
                                                <span class="font-small-2 text-muted">in 24 hours</span>
                                            </div>
                                        </td>
                                        <td>$891.2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Company Table Card -->

            <!-- Developer Meetup Card -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-developer-meetup">
                    <div class="card-body">
                        <div class="meetup-header d-flex align-items-center">
                            <div class="my-auto">
                                <h4 class="card-title mb-25">Highest Booking</h4>
                                <p class="card-text mb-0">Staff with the most expensive booking</p>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="avatar float-start bg-light-primary rounded me-1">
                                <div class="avatar-content">
                                    1
                                </div>
                            </div>
                            <div class="more-info">
                                <h6 class="mb-0">Adam Imran Bin Alwi</h6>
                                <small>Penolong Eksekutif | RM 50</small>
                            </div>
                            <div class="more-info">

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--/ Developer Meetup Card -->

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

            var hardwareData = @json($hardwareCategory);
            var hardwareLabels = hardwareData.map(function(item) {
                return item.subcategory;
            });

            var hardwareInventories = hardwareData.map(function(item) {
                return item.inventory_count;
            });


            var chartWrapper = $('.chartjs'),
                barChartEx = $('.bar-chart-ex'),
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

            // Bar Chart
            // --------------------------------------------------------------------
            if (barChartEx.length) {
                var barChartExample = new Chart(barChartEx, {
                    type: 'bar',
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderSkipped: 'bottom'
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                            display: false
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
                        scales: {
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    color: grid_line_color,
                                    zeroLineColor: grid_line_color
                                },
                                scaleLabel: {
                                    display: false
                                },
                                ticks: {
                                    fontColor: labelColor
                                }
                            }],
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    color: grid_line_color,
                                    zeroLineColor: grid_line_color
                                },
                                ticks: {
                                    stepSize: 100,
                                    min: 0,
                                    max: 400,
                                    fontColor: labelColor
                                }
                            }]
                        }
                    },
                    data: {
                        labels: hardwareLabels,
                        datasets: [{
                            data: hardwareInventories,
                            barThickness: 15,
                            backgroundColor: successColorShade,
                            borderColor: 'transparent'
                        }]
                    }
                });
            }

            // Polar Area Chart
            // --------------------------------------------------------------------


        });
    </script>
@endsection
