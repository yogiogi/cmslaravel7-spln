<form action="{{ asset('Perubahandaya/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="25%" class="text-center">NAMA PEMOHON</th>
          <th width="15%" class="text-left">ID PELANGGAN</th>
          <th width="15%" class="text-left">PERUBAHAN DAYA</th>
          <th width="15%" class="text-center">INSTALASI</th>
          <th width="15%" class="text-center">BIAYA TOTAL</th>
          <th width="5%" class="text-center">STATUS</th>
          <th class="text-center"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($perubahandaya as $perubahandaya) { ?>
          <tr class="odd gradeX">
            <td>
              <a>
                <?php echo $perubahandaya->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>ID Layanan : <a><?php echo $perubahandaya->id_layanan ?></a>
                <br>ID transaksi : <a><?php echo $perubahandaya->id_transaksi ?></a>
                <br>
                <br>
                <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $perubahandaya->id ?>">Detail</a>
                <br>tanggal daftar : <?php if ($perubahandaya->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($perubahandaya->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($perubahandaya->tgl_approve != 0) {
                                          echo date("d/m/Y", strtotime($perubahandaya->tgl_approve));
                                        } else {
                                          echo "-";
                                        } ?>
                <br>tanggal bayar : <?php if ($perubahandaya->tanggal_bayar != 0) {
                                      echo date("d/m/Y", strtotime($perubahandaya->tanggal_bayar));
                                    } else {
                                      echo "-";
                                    } ?>
              </small>
            </td>
            <td>
              <small>
                <a>ID Pelanggan <?php echo $perubahandaya->id_pelanggan ?> </a>
                <br><a>Nomer Meter : <?php echo $perubahandaya->no_meter ?> </a>
              </small>
            </td>
            <td>
              <small>
                <a>Daya lama : <?php echo $perubahandaya->daya_lama ?> Watt</a>
                <br><a>Daya baru : <?php echo $perubahandaya->daya_baru ?> Watt</a>
              </small>
            </td>
            <td>
              <small>
                <a><?php
                    if ($perubahandaya->kode_layanan == '031') {
                      echo "Prabayar ke Prabayar";
                    } else if ($perubahandaya->kode_layanan == '032') {
                      echo "Prabayar ke Pascabayar";
                    } else 
                  if ($perubahandaya->kode_layanan == '033') {
                      echo "Pascabayar ke Pascabayar";
                    }
                    ?>,</a>
                <br><a>Peruntukan : <?php echo $perubahandaya->peruntukan ?> </a>
              </small>
            </td>
            <td>
              <a href="#modaldetailBiaya" data-toggle="modal" data-target="#modaldetailBiaya<?php echo $perubahandaya->id ?>">Rp <?php echo number_format($perubahandaya->total, 0) ?><sup></sup></a>
            </td>
            <td>
              <a><?php if ($perubahandaya->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($perubahandaya->status == 1) {
                    echo "Disetujui ";
                  } ?><sup></sup></a>
            </td>
            <td>
              <div class="btn-group">
                @if($perubahandaya->status==0)
                <a href="{{ asset('admin/perubahandaya/update/'.$perubahandaya->id) }}" class="btn btn-primary btn-sm approval-link">
                  <i class="fa fa-circle"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif

                @if($perubahandaya->status==1)
                @if($perubahandaya->status_bayar==0)
                <a href="{{ asset('admin/perubahandaya/update_bayar/'.$perubahandaya->id) }}" class="btn btn-warning btn-sm approval-link">
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

                <a href="{{ asset('admin/perubahandaya/delete/'.$perubahandaya->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="modalDetailID<?php echo $perubahandaya->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Data Pemohon </h5>
                </div>

                <div class="modal-body">
                  <!--Modal update data-->
                  <form action="{{ asset('admin/perubahandaya/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $perubahandaya->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $perubahandaya->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $perubahandaya->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $perubahandaya->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($perubahandaya->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($perubahandaya->kec)) ?>,
                        <?php echo ucfirst(strtolower($perubahandaya->kab)) ?>,
                        <?php echo ucfirst(strtolower($perubahandaya->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $perubahandaya->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $perubahandaya->email ?></label>
                    </div>
                  </form>
                  <!--Modal update data-->
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modaldetailBiaya<?php echo $perubahandaya->id ?>" tabindex="-1" aria-labelledby="modaldetailBiaya" aria-hidden="true">
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

                    <input type="hidden" name="id" value="{{ $perubahandaya->id }}">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-sm-6">
                        <b><label id="edKonsumen" name="konsumen"> <?php echo strtoupper($perubahandaya->nama_konsumen) ?> </label></b>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Biaya Pemasangan </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->biayac) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">SLO (<?php echo $perubahandaya->daya - $perubahandaya->dayalama ?> * <?php echo $perubahandaya->sloc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->slo) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">GIL (<?php echo $perubahandaya->daya - $perubahandaya->dayalama ?> * <?php echo $perubahandaya->gilc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->gil) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">UJL (<?php echo $perubahandaya->daya - $perubahandaya->dayalama ?> * <?php echo $perubahandaya->ujlc ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->ujl) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPN ((SLO + GIL + UJL) * <?php echo round((float)$perubahandaya->ppnc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->ppn, 0) ?> </label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">PPJ ((SLO + GIL + UJL) * <?php echo round((float)$perubahandaya->ppjc * 100) . '%'; ?>)</label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->ppj, 0) ?></label>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-6 control-label text-right">Materai </label>
                      <div class="col-sm-6">
                        <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->materai, 0) ?> </label>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <label class="col-sm-6 control-label text-right">Total Biaya yang dibayarkan</label>
                  <div class="col-sm-6">
                    <label id="edKonsumen" name="konsumen">Rp <?php echo number_format($perubahandaya->total, 0) ?> </label>
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