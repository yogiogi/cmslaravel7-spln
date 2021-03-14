<form action="{{ asset('Pengaduanteknis/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="15%" class="text-center">NAMA PEMOHON</th>
          <th width="10%" class="text-left">ID PELANGGAN</th>
          <th width="10%" class="text-center">KETERANGAN PENGADUAN</th>
          <th width="15%" class="text-center">BIAYA</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($pengaduanteknis as $pengaduanteknis) { ?>

          <tr class="odd gradeX">
            <td>
              <a>
                <?php echo $pengaduanteknis->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>

              <small>
                <br>ID Layanan : <a><?php echo $pengaduanteknis->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $pengaduanteknis->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $pengaduanteknis->id ?>">Detail</a>
                <br>tanggal daftar :
                <?php if ($pengaduanteknis->tgl_permohonan != 0) {
                  echo date("d/m/Y", strtotime($pengaduanteknis->tgl_permohonan));
                } else {
                  echo "-";
                } ?>
                <br>tanggal selesai :
                <?php if ($pengaduanteknis->tgl_approve != 0) {
                  echo date("d/m/Y", strtotime($pengaduanteknis->tgl_approve));
                } else {
                  echo "-";
                } ?>
              </small>
            </td>
            <td>
              <small>
                <a>ID Pelanggan <?php echo $pengaduanteknis->id_pelanggan ?> </a>
                <br><a>Nomer Meter : <?php echo $pengaduanteknis->no_meter ?> </a>
              </small>
            </td>
            <td>
              <small>
                <a><?php echo $pengaduanteknis->keterangan ?> Jam</a><br>
              </small>
            </td>
            <td>
              <a>
                Rp <?php echo number_format($pengaduanteknis->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
            </td>
            <td>
              <a><?php if ($pengaduanteknis->status == 0) {
                    echo "Belum Diselesaikan ";
                  } else if ($pengaduanteknis->status == 1) {
                    echo "Sudah diselesaikan ";
                  } ?><sup></sup></a>
            </td>
            <td>
              <div class="btn-group">
                @if($pengaduanteknis->status==0)
                <a href="{{ asset('admin/pengaduanteknis/update/'.$pengaduanteknis->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($pengaduanteknis->status==1)
                @if($pengaduanteknis->status_bayar==0)
                <a href="{{ asset('admin/pengaduanteknis/update_bayar/'.$pengaduanteknis->id) }}" class="btn btn-warning btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-warning btn-sm">
                  <i class="fa fa-check-circle"></i>
                </a>
                @endif
                @else
                <a href="" class="btn btn-warning btn-sm warning-link">
                  <i class="fa fa-circle"></i>
                </a>
                @endif

                <a href="#modalPengaduanTeknis" class="btn btn-success btn-sm " data-toggle="modal" data-target="#modalPengaduanTeknis<?php echo $pengaduanteknis->id ?>"><i class="fas fa-edit"></i></a>
                <a href="{{ asset('admin/pengaduanteknis/delete/'.$pengaduanteknis->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalPengaduanTeknis<?php echo $pengaduanteknis->id ?>" tabindex="-1" aria-labelledby="modalPengaduanTeknis" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Pengaduan Teknis </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/pengaduanteknis/edit') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $pengaduanteknis->id }}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                      <label class="col-sm-4 control-label text-right" for="">Konsumen : </label>
                      <div class="col-sm-8">
                        <label id="edKonsumen" name="edKonsumen"><?php echo $pengaduanteknis->nama_konsumen ?></label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 control-label text-right" for="">Keterangan Pengaduan : </label>
                      <div class="col-sm-8">
                        <label id="edPengaduan" name="edPengaduan"><?php echo $pengaduanteknis->keterangan ?></label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 control-label text-right" for="">Biaya : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="biaya" name="biaya" value=<?php echo $pengaduanteknis->biaya ?>>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 control-label text-right" for="">Status : </label>
                      <div class="col-sm-8">
                        <?php if ($pengaduanteknis->status == 0) {
                          echo "Belum Diselesaikan ";
                        } else if ($pengaduanteknis->status == 1) {
                          echo "Sudah diselesaikan ";
                        } ?>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modalDetailID<?php echo $pengaduanteknis->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/pengaduanteknis/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $pengaduanteknis->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $pengaduanteknis->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $pengaduanteknis->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $pengaduanteknis->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($pengaduanteknis->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($pengaduanteknis->kec)) ?>,
                        <?php echo ucfirst(strtolower($pengaduanteknis->kab)) ?>,
                        <?php echo ucfirst(strtolower($pengaduanteknis->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $pengaduanteknis->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $pengaduanteknis->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</form>