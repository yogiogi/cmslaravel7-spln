<form action="{{ asset('Pasangbaru/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <div> Keterangan : Status Disetujui <a class="btn btn-primary btn-sm approval-link"></a>, Status Pembayaran <a class="btn btn-warning btn-sm approval-link"></a>, Status Selesai <a class="btn btn-success btn-sm approval-link"></a> </a> </div>
  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="25%" class="text-center">NAMA PEMOHON</th>
          <th width="15%" class="text-center">INSTALASI</th>
          <th width="15%" class="text-center">BIAYA TOTAL</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($pasangbaru as $pasangbaru) { ?>

          <tr class="odd gradeX">
            <td>
              <a>
                <?php echo $pasangbaru->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>ID Layanan : <a><?php echo $pasangbaru->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $pasangbaru->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $pasangbaru->id ?>">Detail</a>
                <br>tanggal daftar : <?php if ($pasangbaru->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($pasangbaru->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($pasangbaru->tgl_approve != 0) {
                                          echo date("d/m/Y", strtotime($pasangbaru->tgl_approve));
                                        } else {
                                          echo "-";
                                        } ?>
                <br>tanggal bayar : <?php if ($pasangbaru->tanggal_bayar != 0) {
                                      echo date("d/m/Y", strtotime($pasangbaru->tanggal_bayar));
                                    } else {
                                      echo "-";
                                    } ?>
                <br>tanggal selesai: <?php if ($pasangbaru->tanggal_selesai != 0) {
                                        echo date("d/m/Y", strtotime($pasangbaru->tanggal_selesai));
                                      } else {
                                        echo "-";
                                      } ?>
              </small>
            </td>
            <td>
              <a><?php if ($pasangbaru->sifat_instalasi == 1) {
                    echo "Prabayar";
                  } else if ($pasangbaru->sifat_instalasi == 2) {
                    echo "Pasca Bayar";
                  } ?><sup></i></sup></a>
              <a><?php echo $pasangbaru->daya ?> Watt</a>
            </td>
            <td>
              <a href="#modaldetailBiaya" data-toggle="modal" data-target="#modaldetailBiaya<?php echo $pasangbaru->id ?>">Rp <?php echo number_format($pasangbaru->total, 0) ?><sup></sup></a>
            </td>
            <td>
              <a><?php if ($pasangbaru->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($pasangbaru->status == 1) {
                    echo "Disetujui ";
                  } ?><sup></sup></a>
            </td>
            <td>
              <div class="btn-group">
                @if($pasangbaru->status==0)
                <a href="{{ asset('admin/pasangbaru/update/'.$pasangbaru->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($pasangbaru->status==1)
                @if($pasangbaru->status_bayar==0)
                <a href="{{ asset('admin/pasangbaru/update_bayar/'.$pasangbaru->id) }}" class="btn btn-warning btn-sm approval-link">
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

                @if($pasangbaru->status==1)
                @if($pasangbaru->status_bayar==1)
                @if($pasangbaru->status_selesai==0)

                <a href="{{ asset('admin/pasangbaru/update_selesai/'.$pasangbaru->id) }}" class="btn btn-success btn-sm approval-link">
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

                <a href="{{ asset('admin/pasangbaru/delete/'.$pasangbaru->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalDetailID<?php echo $pasangbaru->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/pasangbaru/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $pasangbaru->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $pasangbaru->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $pasangbaru->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $pasangbaru->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($pasangbaru->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($pasangbaru->kec)) ?>,
                        <?php echo ucfirst(strtolower($pasangbaru->kab)) ?>,
                        <?php echo ucfirst(strtolower($pasangbaru->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $pasangbaru->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $pasangbaru->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modaldetailBiaya<?php echo $pasangbaru->id ?>" tabindex="-1" aria-labelledby="modaldetailBiaya" aria-hidden="true">
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

                    <input type="hidden" name="id" value="{{ $pasangbaru->id }}">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-sm-6">
                        <b><label id="edKonsumen" name="konsumen"> <?php echo strtoupper($pasangbaru->nama_konsumen) ?> </label></b>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Biaya Pemasangan </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->biayac) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">SLO </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->slo) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">GIL </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->gil) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">UJL </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->ujl) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPN ((SLO + GIL + UJL) * <?php echo round((float)$pasangbaru->ppnc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->ppn, 0) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPJ ((SLO + GIL + UJL) * <?php echo round((float)$pasangbaru->ppjc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->ppj, 0) ?></label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Token </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->token) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Materai </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->materai, 0) ?> </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <label class="col-sm-6 control-label text-right">Total Biaya yang dibayarkan</label>
                  <div class="col-sm-6">
                    <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($pasangbaru->total, 0) ?> </label>
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