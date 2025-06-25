@extends('layouts.main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="page-wrapper">
        <!-- Page-body start -->
        <div class="page-body">
            <div class="row">
                <!-- task, page, download counter  start -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-purple">{{ $totalPaket }}</h4>
                                    <h6 class="text-muted m-b-0">Total Paket</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="fa fa-bar-chart f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-purple">
                            <div class="row align-items-center">
                                <div class="col-9">

                                </div>
                                <div class="col-3 text-right">
                                    <i class="fa fa-line-chart text-white f-16"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">290+</h4>
                                    <h6 class="text-muted m-b-0">Pengunjung Situs Web</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="fa fa-file-text-o f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-green">
                            <div class="row align-items-center">
                                <div class="col-9">

                                </div>
                                <div class="col-3 text-right">
                                    <i class="fa fa-line-chart text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-red">{{ $PesananTerkonfirmasi }}</h4>
                                    <h6 class="text-muted m-b-0">Pesanan Terkonfirmasi</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="fa fa-calendar-check-o f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-red">
                            <div class="row align-items-center">
                                <div class="col-9">

                                </div>
                                <div class="col-3 text-right">
                                    <i class="fa fa-line-chart text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue">{{ $Testimonial }}</h4>
                                    <h6 class="text-muted m-b-0">Ulasan Pelanggan</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="fa fa-hand-o-down f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">

                                </div>
                                <div class="col-3 text-right">
                                    <i class="fa fa-line-chart text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- task, page, download counter  end -->

                <!--  sale analytics start -->
                <div class="col-xl-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pemesanan dan Pendapatan</h5>
                            <span class="text-muted">Get 15% Off on <a href="https://www.amcharts.com/"
                                    target="_blank">amCharts</a> licences. Use code "codedthemes" and get the
                                discount.</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-trash close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <canvas id="barChart" height="200"></canvas>
                            <hr>
                            <canvas id="lineChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col">
                                    {{-- Format angka sebagai rupiah --}}
                                    <h4>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h4>
                                    <p class="text-muted">Pendapatan Bulan Ini</p>
                                </div>
                                <div class="col-auto">
                                    {{-- Label pertumbuhan (optional, bisa diubah ke dinamis nanti) --}}
                                    <label class="label label-success">+20%</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    {{-- Canvas chart (optional, bisa diisi mini chart pendapatan harian) --}}
                                    <canvas id="this-month" style="height: 150px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            <!--  sale analytics end -->

        </div>
        <div id="styleSelector"> </div>
    </div>
    </div>



    <script>
        const labels = @json($monthlyLabels);
        const data = @json($monthlyValues);

        const commonOptions = {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rp ' + value.toLocaleString()
                    }
                }
            }
        };

        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: data,
                    backgroundColor: '#42a5f5',
                    borderRadius: 8
                }]
            },
            options: commonOptions
        });

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: data,
                    borderColor: '#66bb6a',
                    fill: true,
                    tension: 0.4,
                    backgroundColor: 'rgba(102, 187, 106, 0.2)',
                    pointBackgroundColor: '#66bb6a'
                }]
            },
            options: commonOptions
        });
    </script>
@endsection
