<form action="{{ asset('Pendaftaranslo/proses') }}" method="post" accept-charset="utf-8">
  <?php

  use App\resource_model;

  $site   = DB::table('konfigurasi')->first();
  $resource = new resource_model();

  ?>

  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="15%" class="text-center">NAMA PEMOHON</th>
          <th width="10%" class="text-center">INSTALASI</th>
          <th width="10%" class="text-center">BADAN USAHA</th>
          <th width="15%" class="text-center">BIAYA</th>
          <th width="5%" class="text-center">TOTAL</th>
          <th width="15%" class="text-center">STATUS</th>
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

                <br>tanggal daftar : <?php if ($slo->tanggal_daftar != 0) {
                                        echo date("d/m/Y", strtotime($slo->tanggal_daftar));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal disetujui : <?php if ($slo->tanggal_approve != 0) {
                                          echo date("d/m/Y", strtotime($slo->tanggal_approve));
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
              <a>
                Rp <?php echo number_format($slo->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>SLO : Rp <?php echo number_format($slo->slo, 2)  ?>
                <br>GIL : Rp <?php echo number_format($slo->gil, 2)  ?>
                <br>PPN : Rp <?php echo number_format($slo->ppn, 2)  ?>
                <br>PPJ : Rp <?php echo number_format($slo->ppj, 2)  ?>
                <br>Materai : Rp <?php echo number_format($slo->materai, 2)  ?>
              </small>
            </td>
            <td>
              <a>Rp <?php echo number_format($slo->total, 2) ?><sup></sup></a>
            </td>
            <td>
              <a><?php if ($slo->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($slo->status == 1) {
                    echo "Disetujui ";
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
                  <form action="{{ asset('admin/slo/detail') }}" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ $slo->id }}">
                    {{ csrf_field() }}
                    <div class="column">
                      <label id="edKonsumen" name="konsumen">Nama : <?php echo $slo->nama_konsumen ?></label>
                      <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $slo->ktp ?></label>
                      <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $slo->alamat ?></label>
                      <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($slo->desa)) ?>,
                        Kecamatan <?php echo ucfirst(strtolower($slo->kec)) ?>,
                        <?php echo ucfirst(strtolower($slo->kab)) ?>,
                        <?php echo ucfirst(strtolower($slo->prov)) ?></label>
                      <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $slo->telp ?></label>
                      <br><label id="edKonsumen" name="email"> Email : <?php echo $slo->email ?></label>
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