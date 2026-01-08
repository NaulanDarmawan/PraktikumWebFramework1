<form action="{{ url('/penjualan/ajax') }}" method="POST" id="form-penjualan">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Penjualan</label>
                            <input type="text" name="penjualan_kode" value="PJN{{ time() }}"
                                class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kasir</label>
                            <select name="user_id" class="form-control">
                                @foreach ($user as $u)
                                    <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pembeli</label>
                            <input type="text" name="pembeli" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="datetime-local" name="penjualan_tanggal" value="{{ date('Y-m-d\TH:i') }}"
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <hr>
                <h6>Item Barang</h6>
                <table class="table table-sm table-bordered" id="table-items">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th width="150px">Jumlah</th>
                            <th width="50px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="barang_id[]" class="form-control" required>
                                    <option value="">- Pilih Barang -</option>
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}
                                            (Stok:{{ $b->stok }})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="jumlah[]" class="form-control" min="1"
                                    value="1"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i
                                        class="fa fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-info btn-sm" id="add-item"><i class="fa fa-plus"></i> Tambah
                    Item</button>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        // Tambah Baris Baru
        $('#add-item').click(function() {
            var newRow = `<tr>
                <td>
                    <select name="barang_id[]" class="form-control" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach ($barang as $b) <option value="{{ $b->barang_id }}">{{ $b->barang_nama }} (Stok:{{ $b->stok }})</option> @endforeach
                    </select>
                </td>
                <td><input type="number" name="jumlah[]" class="form-control" min="1" value="1"></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>
            </tr>`;
            $('#table-items tbody').append(newRow);
        });

        // Hapus Baris
        $(document).on('click', '.remove-row', function() {
            if ($('#table-items tbody tr').length > 1) {
                $(this).closest('tr').remove();
            }
        });

        $("#form-penjualan").validate({
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire('Berhasil', response.message, 'success');
                            tablePenjualan.ajax.reload();
                        } else {
                            Swal.fire('Gagal', response.message, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
