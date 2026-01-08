@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card bg-light border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="mb-1">Halo, <strong>{{ auth()->user()->nama }}</strong>! 👋</h4>
                        <p class="text-muted mb-0">Senang melihatmu kembali. Berikut adalah ringkasan performa tokomu hari
                            ini.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow-sm">
                    <div class="inner">
                        <h3>{{ $stats['total_barang'] }}</h3>
                        <p>Total Barang</p>
                    </div>
                    <div class="icon"><i class="fas fa-cubes"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow-sm">
                    <div class="inner">
                        <h3>{{ $stats['total_penjualan'] }}</h3>
                        <p>Total Transaksi</p>
                    </div>
                    <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning shadow-sm">
                    <div class="inner">
                        <h3>{{ $stats['total_user'] }}</h3>
                        <p>User Terdaftar</p>
                    </div>
                    <div class="icon"><i class="fas fa-users"></i></div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger shadow-sm">
                    <div class="inner">
                        <h3>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                        <p>Total Pendapatan</p>
                    </div>
                    <div class="icon"><i class="fas fa-chart-line"></i></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header border-0">
                        <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i> Grafik Omzet (7 Hari Terakhir)</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>

                <div class="card card-outline card-info shadow-sm">
                    <div class="card-header border-0">
                        <h3 class="card-title">Transaksi Terakhir</h3>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped table-valign-middle m-0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Pembeli</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi_terakhir as $t)
                                    <tr>
                                        <td>{{ $t->penjualan_kode }}</td>
                                        <td>{{ $t->pembeli }}</td>
                                        <td><span
                                                class="badge badge-light text-muted">{{ date('d/m/Y H:i', strtotime($t->penjualan_tanggal)) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-outline card-danger shadow-sm">
                    <div class="card-header border-0">
                        <h3 class="card-title text-danger"><i class="fas fa-exclamation-triangle"></i> Stok Menipis</h3>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">Sistem menyarankan untuk segera restok barang ini</p>
                        <table class="table table-sm table-hover" id="table_low_stock">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th class="text-center">Sisa</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(function() {
            // 1. DataTable Paginasi Stok Menipis
            $('#table_low_stock').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/dashboard/low-stock') }}",
                paging: true,
                lengthChange: false, // Matikan ganti jumlah baris per page biar tetap rapi
                searching: false, // Dashboard cukup paginasi saja
                info: false,
                ordering: true,
                pageLength: 5, // Tampilkan 5 barang saja per halaman
                columns: [{
                        data: "barang_nama",
                        orderable: true
                    },
                    {
                        data: "stok",
                        className: "text-center",
                        render: function(data) {
                            return '<span class="badge badge-danger">' + data + '</span>';
                        }
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        orderable: false
                    }
                ],
                language: {
                    emptyTable: "Semua stok aman, Bubu tenang! 🐾",
                    paginate: {
                        next: "»",
                        previous: "«"
                    }
                }
            });

            // 2. Chart.js Penjualan
            var salesCanvas = $('#salesChart').get(0).getContext('2d');
            var salesData = {
                labels: {!! json_encode($chart_data->pluck('tanggal')) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    backgroundColor: 'rgba(60,141,188,0.2)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: {!! json_encode($chart_data->pluck('total')) !!},
                    borderWidth: 2,
                    fill: true
                }]
            };

            var salesOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            return 'Rp ' + item.yLabel.toLocaleString();
                        }
                    }
                }
            };

            new Chart(salesCanvas, {
                type: 'line',
                data: salesData,
                options: salesOptions
            });
        });
    </script>
@endpush
