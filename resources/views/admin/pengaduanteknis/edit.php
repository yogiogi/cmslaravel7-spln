<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $i ?>">
    <i class="fas fa-trash-alt"></i>
</button>
<div class="modal fade" id="myModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Hapus data?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Konsumen</label>
                            <label id="konsumen" name="konsumen">Konsumen</label>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Pengaduan</label>
                            <label id="ket_pengaduan" name="ket_pengaduan">Keterangan Pengaduan</label>
                        </div>
                        <div class="form-group">
                            <label>Biaya</label>
                            <input type="number" min="0.01" step="0.01" id="biaya" name="biaya" placeholder="0.0" required class="form-control">
                        </div>
                        <div class="form-group"><label>Status</label>
                            <label id="status" name="status">Status</label>
                        </div>
                    </div>
                </div>
            </div>

            <p class="alert alert-danger">Yakin ingin menghapus data ini?</p>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>

            <a href="<?php echo base_url('admin/pengaduanteknis/edit/' . $slo->id) ?>" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Ya, Hapus data</a>

        </div>
    </div>
</div>
</div>