<form action="{{ asset('Mcbbox/proses') }}" method="post" accept-charset="utf-8">
  <?php $site   = DB::table('konfigurasi')->first(); ?>
  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="15%" class="text-center">KONSUMEN</th>
          <th width="10%" class="text-center">MCB BOX</th>
          <th width="5%" class="text-center">TOTAL BIAYA</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($mcbbox as $mcbbox) { ?>

          <tr class="odd gradeX">
            <td>
              <a>
                <?php echo $mcbbox->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>ID Layanan : <a><?php echo $mcbbox->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $mcbbox->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $mcbbox->id ?>">Detail</a>
                <br>tanggal daftar : <?php if ($mcbbox->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($mcbbox->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($mcbbox->tgl_approve != 0) {
                                          echo date("d/m/Y", strtotime($mcbbox->tgl_approve));
                                        } else {
                                          echo "-";
                                        } ?>
              </small>
            </td>
            <td>
              <small>
                <a>Jenis : <?php echo $mcbbox->jenis ?>,
                  <br><?php if ($mcbbox->mdp == 1) {
                        echo "MDP";
                      } ?>
                  <br><?php if ($mcbbox->sdp == 1) {
                        echo "SDP";
                      } ?>
                  <br>Grup MCB <?php echo $mcbbox->grup_mcb ?>
                  <br>Grup LNB <?php echo $mcbbox->grup_lnb ?>
                  <br>Grup MCCB <?php echo $mcbbox->grup_mccb ?>
                  <br>Trafo <?php echo $mcbbox->grup_trafo ?>
                </a>
              </small>
            </td>
            <td>
              <a href="#modaldetailBiaya" data-toggle="modal" data-target="#modaldetailBiaya<?php echo $mcbbox->id ?>">Rp <?php echo number_format($mcbbox->total, 0) ?><sup></sup></a>
            </td>
            <td>
              <a><?php if ($mcbbox->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($mcbbox->status == 1) {
                    echo "Disetujui ";
                  } ?><sup></sup></a>
            </td>
            <td>
              <div class="btn-group">
                @if($mcbbox->status==0)
                <a href="{{ asset('admin/mcbbox/update/'.$mcbbox->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($mcbbox->status==1)
                @if($mcbbox->status_bayar==0)
                <a href="{{ asset('admin/mcbbox/update_bayar/'.$mcbbox->id) }}" class="btn btn-warning btn-sm approval-link">
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

                <a href="{{ asset('admin/mcbbox/delete/'.$mcbbox->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalDetailID<?php echo $mcbbox->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/mcbbox/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $mcbbox->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $mcbbox->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $mcbbox->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $mcbbox->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($mcbbox->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($mcbbox->kec)) ?>,
                        <?php echo ucfirst(strtolower($mcbbox->kab)) ?>,
                        <?php echo ucfirst(strtolower($mcbbox->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $mcbbox->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $mcbbox->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modaldetailBiaya<?php echo $mcbbox->id ?>" tabindex="-1" aria-labelledby="modaldetailBiaya" aria-hidden="true">
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

                    <input type="hidden" name="id" value="{{ $mcbbox->id }}">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-sm-6">
                        <b><label id="edKonsumen" name="konsumen"> <?php echo strtoupper($mcbbox->nama_konsumen) ?> </label></b>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">MDP </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->biayamdp) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">SDP </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->biayasdp) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Harga MCB (<?php echo $mcbbox->grup_mcb ?> * <?php echo $mcbbox->biaya_mcb ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->biaya_mcb) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Harga LNB (<?php echo $mcbbox->grup_lnb  ?> * <?php echo $mcbbox->biaya_lnb ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->biaya_lnb) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Harga MCCB (<?php echo $mcbbox->grup_mccb ?> * <?php echo $mcbbox->biaya_lnb ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->biaya_mccb) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Harga Trafo (<?php echo $mcbbox->grup_trafo ?> * <?php echo $mcbbox->biaya_trafo ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->biaya_trafo) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPN (SLO + GIL * <?php echo round((float)$mcbbox->ppnc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->ppn, 0) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPJ (SLO + GIL * <?php echo round((float)$mcbbox->ppjc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->ppj, 0) ?></label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Materai </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->materai, 0) ?> </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <label class="col-sm-6 control-label text-right">Total Biaya yang dibayarkan</label>
                  <div class="col-sm-6">
                    <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($mcbbox->total, 0) ?> </label>
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