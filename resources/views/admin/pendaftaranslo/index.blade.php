<form action="{{ asset('Pendaftaranslo/proses') }}" method="post" accept-charset="utf-8">
  <?php

  use Illuminate\Support\Facades\DB;
  use App\resource_model;

  $site   = DB::table('konfigurasi')->first();
  $resource = new resource_model();

  ?>

  {{ csrf_field() }}

  <div> Keterangan : Status Disetujui <a class="btn btn-primary btn-sm approval-link"></a>, Status Pembayaran <a class="btn btn-warning btn-sm approval-link"></a>, Status Selesai <a class="btn btn-success btn-sm approval-link"></a> </a> </div>
  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="25%" class="text-center">NAMA PEMOHON</th>
          <th width="15%" class="text-center">INSTALASI</th>
          <th width="15%" class="text-center">BADAN USAHA</th>
          <th width="15%" class="text-center">BIAYA TOTAL</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($slo as $slo) { ?>
          <tr class="odd gradeX">
            <td>
              <a>
                <?php echo $slo->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>ID Layanan : <a><?php echo $slo->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $slo->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $slo->id ?>">Detail</a>

                <br>tanggal daftar : <?php if ($slo->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($slo->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($slo->tgl_approve != 0) {
                                          echo date("d/m/Y", strtotime($slo->tgl_approve));
                                        } else {
                                          echo "-";
                                        } ?>
                <br>tanggal bayar : <?php if ($slo->tanggal_bayar != 0) {
                                      echo date("d/m/Y", strtotime($slo->tanggal_bayar));
                                    } else {
                                      echo "-";
                                    } ?>
                <br>tanggal selesai: <?php if ($slo->tanggal_selesai != 0) {
                                        echo date("d/m/Y", strtotime($slo->tanggal_selesai));
                                      } else {
                                        echo "-";
                                      } ?>
              </small>
            </td>
            <td>
              <a><?php if ($slo->instalasi == 1) {
                    echo "Instalasi Baru ";
                  } else {
                    echo "Perubahan Daya ";
                  } ?><sup></i></sup></a>
              <small>
                @if($slo->instalasi == 2)
                <br>daya baru: <?php echo $slo->daya ?> Watt
                <br>daya lama : <?php echo $slo->dayalama ?> Watt
                <br>nomer djk lama : <?php echo $slo->djklama ?>
                @elseif($slo->instalasi == 1)
                <br>daya : <?php echo $slo->daya ?> Watt
                @endif
              </small>
            </td>
            <td>
              <a><?php echo $slo->badan_usaha ?><sup></i></sup></a>
            </td>
            <td>
              <a href="#modaldetailBiaya" data-toggle="modal" data-target="#modaldetailBiaya<?php echo $slo->id ?>">Rp <?php echo number_format($slo->total, 0) ?><sup></sup></a>
            </td>
            <td>
              <a><?php if ($slo->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($slo->status == 1 && $slo->status_bayar == 0) {
                    echo "Disetujui ";
                  } else if ($slo->status == 1 && $slo->status_bayar == 1) {
                    echo "Dibayar ";
                  } ?><sup></sup></a>
            </td>
            <td>
              <div class="btn-group">
                @if($slo->status==0)
                <a href="{{ asset('admin/pendaftaranslo/update/'.$slo->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($slo->status==1)
                @if($slo->status_bayar==0)
                <a href="{{ asset('admin/pendaftaranslo/update_bayar/'.$slo->id) }}" class="btn btn-warning btn-sm approval-link">
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

                @if($slo->status==1)
                @if($slo->status_bayar==1)
                @if($slo->status_selesai==0)

                <a href="{{ asset('admin/pendaftaranslo/update_selesai/'.$slo->id) }}" class="btn btn-success btn-sm approval-link">
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

                <a href="{{ asset('admin/pendaftaranslo/delete/'.$slo->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalDetailID<?php echo $slo->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $slo->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label name="konsumen">Nama : <?php echo $slo->nama_konsumen ?></label>
                      <br><label name="ktp"> KTP : <?php echo $slo->ktp ?></label>
                      <br><label name="alamat"> Alamat : <?php echo $slo->alamat ?></label>
                      <br><label name="geolocation"> Desa <?php echo ucfirst(strtolower($slo->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($slo->kec)) ?>,
                        <?php echo ucfirst(strtolower($slo->kab)) ?>,
                        <?php echo ucfirst(strtolower($slo->prov)) ?></label>
                      <br><label name="telp"> Telepon : <?php echo $slo->telp ?></label>
                      <br><label name="email"> Email : <?php echo $slo->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modaldetailBiaya<?php echo $slo->id ?>" tabindex="-1" aria-labelledby="modaldetailBiaya" aria-hidden="true">
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

                    <input type="hidden" name="id" value="{{ $slo->id }}">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-sm-6">
                        <b><label id="edKonsumen" name="konsumen"> <?php echo strtoupper($slo->nama_konsumen) ?> </label></b>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">SLO (<?php echo $slo->daya - $slo->dayalama ?> * <?php echo $slo->sloc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($slo->slo) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">GIL (<?php echo $slo->daya - $slo->dayalama ?> * <?php echo $slo->gilc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($slo->gil) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPN (SLO + GIL * <?php echo round((float)$slo->ppnc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($slo->ppn, 0) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPJ (SLO + GIL * <?php echo round((float)$slo->ppjc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($slo->ppj, 0) ?></label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Materai </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($slo->materai, 0) ?> </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <label class="col-sm-6 control-label text-right">Total Biaya yang dibayarkan</label>
                  <div class="col-sm-6">
                    <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($slo->total, 0) ?> </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Modal update data-->
        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</form>