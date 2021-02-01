@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Home Page</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Ticket</span>
                    <span class="info-box-number">
                    {{ $new }}
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-spinner"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">WIP Ticket</span>
                    <span class="info-box-number">{{ $wip }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-reply"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Answered Ticket</span>
                    <span class="info-box-number">{{ $answered }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Closed Ticket</span>
                    <span class="info-box-number">{{ $closed }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="chart-box box-primary">
                    <div class="chart-box-header with-border mb-3">
                        <h3 class="chart-box-title">Monthly Ticket Count</h3>
                    </div>
                    <div class="chart-box-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-box box-info">
                    <div class="chart-box-header with-border mb-3">
                        <h3 class="chart-box-title">Monthly Crm Count</h3>
                    </div>
                    <div class="chart-box-body">
                        <div class="chart">
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('/vendor/chart/Chart.min.js') }}"></script>

<script>

( function ( $ ) {

var areaCharts = {
    init: function () {
        // -- Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        this.ajaxGetPostMonthlyData();

    },

    ajaxGetPostMonthlyData: function () {
        var urlPath =  'http://' + window.location.hostname + '/get-post-chart-data';
        var request = $.ajax( {
            method: 'GET',
            url: "{{ route('api.ticketChart') }}"
    } );

        request.done( function ( response ) {
            console.log( response );
            areaCharts.createCompletedJobsChart( response );
        });
    },

    /**
     * Created the Completed Jobs Chart
     */
    createCompletedJobsChart: function ( response ) {

        var ctx = document.getElementById("areaChart").getContext('2d');
        var myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: response.months, // The response got from the ajax request containing all month names in the database
                datasets: [{
                    label: "Tickets",
                    lineTension: 0.3,
                    backgroundColor: "rgba(5,84,94,0.2)",
                    borderColor: "rgba(5,84,94,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(5,84,94,1)",
                    pointBorderColor: "rgba(5,84,94,0.2)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(5,84,94,1)",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    // fillColor           : 'rgba(132,53,142,1)',
                    // strokeColor         : 'rgba(132,53,142,1)',
                    // pointColor          : '#3b8bba',
                    // pointStrokeColor    : 'rgba(60,141,188,1)',
                    // pointHighlightFill  : '#fff',
                    // pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: response.ticket_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                }],
            },
            options: {
                // scales: {
                //     xAxes: [{
                //         time: {
                //             unit: 'date'
                //         },
                //         gridLines: {
                //             display: false
                //         },
                //         ticks: {
                //             maxTicksLimit: 7
                //         }
                //     }],
                //     yAxes: [{
                //         ticks: {
                //             min: 0,
                //             max: response.max, // The response got from the ajax request containing max limit for y axis
                //             maxTicksLimit: 5
                //         },
                //         gridLines: {
                //             color: "rgba(0, 0, 0, .125)",
                //         }
                //     }],
                // },
                // legend: {
                //     display: false
                // }

                //Boolean - If we should show the scale at all
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: response.max, // The response got from the ajax request containing max limit for y axis
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot                : false,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                //String - A legend template
                legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            }
        });
    }
};

areaCharts.init();

var lineCharts = {
    init: function () {
        // -- Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        this.ajaxGetPostMonthlyData();

    },

    ajaxGetPostMonthlyData: function () {
        var urlPath =  'http://' + window.location.hostname + '/get-post-chart-data';
        var request = $.ajax( {
            method: 'GET',
            url: "{{ route('api.crmChart') }}"
    } );

        request.done( function ( response ) {
            console.log( response );
            lineCharts.createCompletedJobsChart( response );
        });
    },

    /**
     * Created the Completed Jobs Chart
     */
    createCompletedJobsChart: function ( response ) {

        var ctx = document.getElementById("lineChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: response.months, // The response got from the ajax request containing all month names in the database
                datasets: [{
                    label: "Crms",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(2,117,216,0.2)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    // fillColor           : 'rgba(210, 214, 222, 1)',
                    // strokeColor         : 'rgba(210, 214, 222, 1)',
                    // pointColor          : 'rgba(210, 214, 222, 1)',
                    // pointStrokeColor    : '#c1c7d1',
                    // pointHighlightFill  : '#fff',
                    // pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: response.crm_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                }],
            },
            options: {
                // scales: {
                //     xAxes: [{
                //         time: {
                //             unit: 'date'
                //         },
                //         gridLines: {
                //             display: false
                //         },
                //         ticks: {
                //             maxTicksLimit: 7
                //         }
                //     }],
                //     yAxes: [{
                //         ticks: {
                //             min: 0,
                //             max: response.max, // The response got from the ajax request containing max limit for y axis
                //             maxTicksLimit: 5
                //         },
                //         gridLines: {
                //             color: "rgba(0, 0, 0, .125)",
                //         }
                //     }],
                // },
                // legend: {
                //     display: false
                // }

                //Boolean - If we should show the scale at all
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: response.max, // The response got from the ajax request containing max limit for y axis
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot                : false,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : false,
                //String - A legend template
                legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            }
        });
    }
};

lineCharts.init();

} )( jQuery );
</script>

@endsection
