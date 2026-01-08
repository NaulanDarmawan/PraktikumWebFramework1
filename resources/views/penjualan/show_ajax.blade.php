<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Transaksi Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th>Kode Penjualan</th><td>: {{ $penjualan->penjualan_kode }}</td></tr>
                        <tr><th>Tanggal</th><td>: {{ date('d-m-Y H:i', strtotime($penjualan->penjualan_tanggal)) }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th>Kasir</th><td>: {{ $penjualan->user->nama }}</td></tr>
                        <tr><th>Pembeli</th><td>: {{ $penjualan->pembeli }}</td></tr>
                    </table>
                </div>
            </div>
            <hr>
            <h6>Daftar Item:</h6>
            <table class="table table-bordered table-sm">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($penjualan->details as $index => $d)
                        @php $subtotal = $d->harga * $d->jumlah; $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $d->barang->barang_nama }}</td>
                            <td class="text-right">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $d->jumlah }}</td>
                            <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total Bayar</th>
                        <th class="text-right text-primary">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
        </div>
    </div>
</div>
