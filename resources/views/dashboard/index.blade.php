@extends('layouts.master')
@section('konten')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Hari Ini</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <!-- PIE CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Total Transaksi</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>

        </div>      
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    {{-- <script>
        $(function() {

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Jual Hari Ini',
                    'Beli Hari Ini',
                ],
                datasets: [{
                    data: [{{ $newjual }}, {{ $newbeli }}],
                    backgroundColor: ['#f56954', '#00a65a'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Total Jual',
                    'Total Beli',
                ],
                datasets: [{
                    data: [{{ $jual }}, {{ $beli }}],
                    backgroundColor: ['#00c0ef', '#3c8dbc'],
                }]
            }
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })


        })

        $('#dash').addClass('active');
    </script> --}}
@endsection
