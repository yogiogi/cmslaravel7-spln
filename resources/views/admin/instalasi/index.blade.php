<form action="{{ asset('Instalasi/proses') }}" method="post" accept-charset="utf-8">
  <?php $site   = DB::table('konfigurasi')->first(); ?>
  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="15%" class="text-center">KONSUMEN</th>
          <th width="10%" class="text-center">INSTALASI</th>
          <th width="15%" class="text-center">BIAYA</th>
          <th width="5%" class="text-center">TOTAL</th>
          <th width="5%" class="text-center">STATUS</th>
          <th width="5%" class="text-center"></th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($instalasi as $instalasi) { ?>

          <tr class="odd gradeX">
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
              <small>
                Biaya Instalasi : Rp <?php echo number_format($instalasi->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>

                <br>PPN : Rp <?php echo number_format($instalasi->ppn, 2)  ?>
                <br>PPJ : Rp <?php echo number_format($instalasi->ppj, 2)  ?>
                <br>Materai : Rp <?php echo number_format($instalasi->materai, 2)  ?>
              </small>
            </td>
            <td>
              <a>Rp <?php echo number_format($instalasi->total, 2) ?><sup></sup></a>
            </td>
            <td>
              <a><?php if ($instalasi->status == 0) {
                    echo "Belum Disetujui ";
                  } else if ($instalasi->status == 1) {
                    echo "Disetujui ";
                  } ?><sup></sup></a>
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

                <a href="{{ asset('admin/instalasi/delete/'.$instalasi->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>


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
        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</form>