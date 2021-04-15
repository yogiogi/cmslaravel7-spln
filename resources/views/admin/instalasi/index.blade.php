<form action="{{ asset('Instalasi/proses') }}" method="post" accept-charset="utf-8">
  <?php $site   = DB::table('konfigurasi')->first(); ?>
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
          <th width="25%" class="text-center">KONSUMEN</th>
          <th width="15%" class="text-center">INSTALASI</th>
          <th width="15%" class="text-center">TOTAL BIAYA</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($instalasi as $instalasi) { ?>

          <tr class="odd gradeX">
            <td class="text-center">
              <div class="icheck-primary">
                <input type="checkbox" class="icheckbox_flat-blue " name="idinstalasinya[]" value="<?php echo $instalasi->id ?>">
                <label for="check<?php echo $i ?>"></label>
              </div>
            </td>
            <td>
              <a>
                <?php echo $instalasi->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>ID Layanan : <a><?php echo $instalasi->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $instalasi->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $instalasi->id ?>">Detail</a>
                <br><b> <a><?php if ($instalasi->status == 0) {
                              echo "Belum Disetujui ";
                            } else if ($instalasi->status == 1) {
                              echo "Disetujui ";
                            } ?><sup></sup></a></b>
                <br>tanggal daftar : <?php if ($instalasi->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($instalasi->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($instalasi->tgl_approve != 0) {
                                          echo date("d/m/Y", strtotime($instalasi->tgl_approve));
                                        } else {
                                          echo "-";
                                        } ?>
                <br>tanggal bayar : <?php if ($instalasi->tanggal_bayar != 0) {
                                      echo date("d/m/Y", strtotime($instalasi->tanggal_bayar));
                                    } else {
                                      echo "-";
                                    } ?>
                <br>tanggal selesai: <?php if ($instalasi->tanggal_selesai != 0) {
                                        echo date("d/m/Y", strtotime($instalasi->tanggal_selesai));
                                      } else {
                                        echo "-";
                                      } ?>
              </small>
            </td>
            <td>
              <small>
                <a>Lampu : <?php echo $instalasi->titik_lampu ?> titik</a>
                <br><a>Saklar : <?php echo $instalasi->titik_saklar ?> titik</a>
                <br><a>Stop kontak : <?php echo $instalasi->titik_stop_kontak ?> titik</a>
                <br><br>Kabel Penghantar Utama :
                <br><a> Panjang : <?php echo $instalasi->meter_kabel ?> meter</a>
                <br><a> ukuran : <?php echo $instalasi->jenis_kabel ?> </a>
              </small>
            </td>
            <td>
              <a href="#modaldetailBiaya" data-toggle="modal" data-target="#modaldetailBiaya<?php echo $instalasi->id ?>">Rp <?php echo number_format($instalasi->total, 0) ?><sup></sup></a>
            </td>
            <td>
              @if($instalasi->buktid!=null)
              <img src="{{ asset('public/upload/transaksi/'.$instalasi->buktid) }}" alt="test" class="img-fluid img-thumbnail">
              <br>
              <small>
                tanggal : <?php echo $instalasi->tgld ?> <br>
                <a href="#modalDetailBayar" data-toggle="modal" data-target="#modalDetailBayar<?php echo $instalasi->id ?>">Detail</a>
              </small>
              @endif
            </td>
            <td>
              <div class="btn-group">
                @if($instalasi->status==0)
                <a href="{{ asset('admin/instalasi/update/'.$instalasi->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($instalasi->status==1)
                @if($instalasi->status_bayar==0)
                <a href="{{ asset('admin/instalasi/update_bayar/'.$instalasi->id) }}" class="btn btn-warning btn-sm approval-link">
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

                @if($instalasi->status==1)
                @if($instalasi->status_bayar==1)
                @if($instalasi->status_selesai==0)

                <a href="{{ asset('admin/instalasi/update_selesai/'.$instalasi->id) }}" class="btn btn-success btn-sm approval-link">
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

                <a href="{{ asset('admin/instalasi/delete/'.$instalasi->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalDetailBayar<?php echo $instalasi->id ?>" tabindex="-1" aria-labelledby="modalDetailBayar" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pembayaran </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $instalasi->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label name="konsumen">Rekening Tujuan : </label>
                      <br><label> <?php echo $instalasi->noreksplnd ?></label>
                      <br><label> <?php echo $instalasi->atasnamasplnd ?></label>
                      <br><label> Cara bayar : <?php echo $instalasi->carabayard ?></label>
                      <br><label> Tanggal Bayar : <?php echo $instalasi->tglbayard ?></label>
                      <br><br><label> Pengirim : </label>
                      <br><label> Nomer Rekening: <?php echo $instalasi->norekd ?></label>
                      <br><label> a.n : <?php echo $instalasi->namapemilikd ?></label>
                      <br><label> Bank : <?php echo $instalasi->namabankd ?></label>
                      <br><label> Keterangan : <?php echo $instalasi->keterangand ?></label>
                      <br><label> Jumlah yang dibayar : Rp <?php echo number_format($instalasi->jmlpembayarand) ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modalDetailID<?php echo $instalasi->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/pengaduanteknis/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $instalasi->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $instalasi->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $instalasi->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $instalasi->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($instalasi->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($instalasi->kec)) ?>,
                        <?php echo ucfirst(strtolower($instalasi->kab)) ?>,
                        <?php echo ucfirst(strtolower($instalasi->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $instalasi->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $instalasi->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modalDetailBiaya<?php echo $instalasi->id ?>" tabindex="-1" aria-labelledby="modalDetailBiaya" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/pengaduanteknis/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $instalasi->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label name="konsumen">Nama : <?php echo $instalasi->nama_konsumen ?></label>
                      <br><label name="ktp"> KTP : <?php echo $instalasi->ktp ?></label>
                      <br><label name="alamat"> Alamat : <?php echo $instalasi->alamat ?></label>
                      <br><label name="geolocation"> Desa <?php echo ucfirst(strtolower($instalasi->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($instalasi->kec)) ?>,
                        <?php echo ucfirst(strtolower($instalasi->kab)) ?>,
                        <?php echo ucfirst(strtolower($instalasi->prov)) ?></label>
                      <br><label name="telp"> Telepon : <?php echo $instalasi->telp ?></label>
                      <br><label name="email"> Email : <?php echo $instalasi->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modaldetailBiaya<?php echo $instalasi->id ?>" tabindex="-1" aria-labelledby="modaldetailBiaya" aria-hidden="true">
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

                    <input type="hidden" name="id" value="{{ $instalasi->id }}">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-sm-6">
                        <b><label id="edKonsumen" name="konsumen"> <?php echo strtoupper($instalasi->nama_konsumen) ?> </label></b>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Biaya titik lampu (<?php echo $instalasi->titik_lampu * $instalasi->lampuc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->titik_lampu * $instalasi->lampuc) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Biaya titik saklar (<?php echo $instalasi->titik_saklar * $instalasi->saklarc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->titik_saklar * $instalasi->saklarc) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Biaya titik stop kontak (<?php echo $instalasi->titik_stop_kontak * $instalasi->hargatitikstopkontak ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->titik_stop_kontak * $instalasi->hargatitikstopkontak) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Harga kabel penghantar (<?php echo $instalasi->meter_kabel * $instalasi->hargameterc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->meter_kabel * $instalasi->hargameterc) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPN ((T.Lampu + T.Saklar + T.Stop kontak + Kabel Penghantar) * <?php echo round((float)$instalasi->ppnc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->ppn) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPJ ((T.Lampu + T.Saklar + T.Stop kontak + Kabel Penghantar) * <?php echo round((float)$instalasi->ppjc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->ppj, 0) ?></label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Materai </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->materai, 0) ?> </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <label class="col-sm-6 control-label text-right">Total Biaya yang dibayarkan</label>
                  <div class="col-sm-6">
                    <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($instalasi->total, 0) ?> </label>
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