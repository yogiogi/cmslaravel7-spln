<form action="{{ asset('Penyambungansementara/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-12">
      <div class="input-group">
        <span class="input-group-btn">
          <button class="btn btn-danger btn-sm" type="submit" name="hapus" onClick="check();">
            <i class="fas fa-trash-alt"></i>
          </button>
        </span>
        <div>&nbsp&nbsp</div>
        <div class="btn btn-secondary btn-sm"> Keterangan : Status Disetujui <a class="btn btn-primary btn-sm approval-link"></a>&nbsp|&nbsp Status Pembayaran <a class="btn btn-warning btn-sm approval-link"></a>&nbsp|&nbsp Status Selesai <a class="btn btn-success btn-sm approval-link"></a> </a> </div>
      </div>
    </div>
  </div>

  <div class="clearfix">
    <hr>
  </div>

  <div class="col-md-8">
    <div class="btn-group">
      <?php if (isset($pagin)) {
        echo $pagin;
      } ?>
    </div>
  </div>

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="5%">
            <div class="mailbox-controls">
              <!-- Check all button -->
              <button type="button" class="btn btn-info btn-sm checkbox-toggle"><i class="far fa-square"></i>
              </button>
            </div>
          </th>
          <th width="15%" class="text-center">NAMA PEMOHON</th>
          <th width="10%" class="text-left">ID PELANGGAN</th>
          <th width="10%" class="text-left">WAKTU PENYAMBUNGAN</th>
          <th width="15%" class="text-center">BIAYA TOTAL</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($penyambungansementara as $penyambungansementara) { ?>

          <tr class="odd gradeX">
            <td class="text-center">
              <div class="icheck-primary">
                <input type="checkbox" class="icheckbox_flat-blue " name="idpenyambungansementaranya[]" value="<?php echo $penyambungansementara->id ?>">
                <label for="check<?php echo $i ?>"></label>
              </div>
            </td>
            <td>
              <a>
                <?php echo $penyambungansementara->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>ID Layanan : <a><?php echo $penyambungansementara->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $penyambungansementara->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $penyambungansementara->id ?>">Detail</a>
                <br>tanggal daftar : <?php if ($penyambungansementara->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($penyambungansementara->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($penyambungansementara->tgl_approve != 0) {
                                          echo date("d/m/Y", strtotime($penyambungansementara->tgl_approve));
                                        } else {
                                          echo "-";
                                        } ?>
                <br>tanggal bayar : <?php if ($penyambungansementara->tanggal_bayar != 0) {
                                      echo date("d/m/Y", strtotime($penyambungansementara->tanggal_bayar));
                                    } else {
                                      echo "-";
                                    } ?>
                <br>tanggal selesai: <?php if ($penyambungansementara->tanggal_selesai != 0) {
                                        echo date("d/m/Y", strtotime($penyambungansementara->tanggal_selesai));
                                      } else {
                                        echo "-";
                                      } ?>
              </small>
            </td>
            <td>
              <small>
                <a>ID Pelanggan : <?php echo $penyambungansementara->id_pelanggan ?> </a>
                <br><a>Nomer Meter : <?php echo $penyambungansementara->no_meter ?> </a>
              </small>
            </td>
            <td>
              <small>
                <a><?php echo $penyambungansementara->tanggal_nyala ?> </a><br>
                <a><?php echo $penyambungansementara->jammulai ?>, durasi <?php echo $penyambungansementara->durasi ?> jam </a>
              </small>
            </td>
            <td>
              <a href="#modaldetailBiaya" data-toggle="modal" data-target="#modaldetailBiaya<?php echo $penyambungansementara->id ?>">Rp <?php echo number_format($penyambungansementara->total, 0) ?><sup></sup></a>
            </td>

            <td>
              <a><?php if ($penyambungansementara->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($penyambungansementara->status == 1) {
                    echo "Disetujui ";
                  } ?><sup></sup></a>
            </td>
            <td>
              <div class="btn-group">
                @if($penyambungansementara->status==0)
                <a href="{{ asset('admin/penyambungansementara/update/'.$penyambungansementara->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($penyambungansementara->status==1)
                @if($penyambungansementara->status_bayar==0)
                <a href="{{ asset('admin/penyambungansementara/update_bayar/'.$penyambungansementara->id) }}" class="btn btn-warning btn-sm approval-link">
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

                @if($penyambungansementara->status==1)
                @if($penyambungansementara->status_bayar==1)
                @if($penyambungansementara->status_selesai==0)

                <a href="{{ asset('admin/penyambungansementara/update_selesai/'.$penyambungansementara->id) }}" class="btn btn-success btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-success btn-sm">
                  <i class="fa fa-check-circle"></i>
                </a>
                @endif
                @else
                <a href="" class="btn btn-success btn-sm">
                  <i class="fa fa-circle"></i>
                </a>
                @endif
                @else
                <a href="" class="btn btn-success btn-sm warning-link">
                  <i class="fa fa-circle"></i>
                </a>
                @endif
                <a href="{{ asset('admin/penyambungansementara/delete/'.$penyambungansementara->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalDetailID<?php echo $penyambungansementara->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/penyambungansementara/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $penyambungansementara->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $penyambungansementara->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $penyambungansementara->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $penyambungansementara->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($penyambungansementara->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($penyambungansementara->kec)) ?>,
                        <?php echo ucfirst(strtolower($penyambungansementara->kab)) ?>,
                        <?php echo ucfirst(strtolower($penyambungansementara->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $penyambungansementara->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $penyambungansementara->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modaldetailBiaya<?php echo $penyambungansementara->id ?>" tabindex="-1" aria-labelledby="modaldetailBiaya" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail Biaya</h5>
                  <button type="button" class="close" data-dismiss="modal" aria- label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form accept-charset="utf-8">

                    <input type="hidden" name="id" value="{{ $penyambungansementara->id }}">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-sm-6">
                        <b><label id="edKonsumen" name="konsumen"> <?php echo strtoupper($penyambungansementara->nama_konsumen) ?> </label></b>
                      </div>
                    </div>
                    <br>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Biaya (biaya per jam * <?php echo round((float)$penyambungansementara->durasi * 100); ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($penyambungansementara->biaya, 0) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPN (biaya * <?php echo round((float)$penyambungansementara->ppnc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($penyambungansementara->ppn, 0) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPJ (biaya * <?php echo round((float)$penyambungansementara->ppjc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($penyambungansementara->ppj, 0) ?></label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Materai </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($penyambungansementara->materai, 0) ?> </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <label class="col-sm-6 control-label text-right">Total Biaya yang dibayarkan</label>
                  <div class="col-sm-6">
                    <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($penyambungansementara->total, 0) ?> </label>
                  </div>
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

<div class="clearfix">
  <hr>
</div>
<div class="pull-right"><?php if (isset($pagin)) {
                          echo $pagin;
                        } ?></div>