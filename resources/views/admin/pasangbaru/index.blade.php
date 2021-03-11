<form action="{{ asset('Pasangbaru/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="15%" class="text-center">NAMA PEMOHON</th>
          <th width="10%" class="text-center">INSTALASI</th>
          <th width="15%" class="text-center">BIAYA</th>
          <th width="5%" class="text-center">TOTAL</th>
          <th width="15%" class="text-center">STATUS</th>
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
              <a>
                Rp <?php echo number_format($pasangbaru->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
              </a>
              <small>
                <br>SLO : Rp <?php echo number_format($pasangbaru->slo, 2)  ?>
                <br>GIL : Rp <?php echo number_format($pasangbaru->gil, 2)  ?>
                <br>UJL : Rp <?php echo number_format($pasangbaru->ujl, 2)  ?>
                <br>PPN : Rp <?php echo number_format($pasangbaru->ppn, 2)  ?>
                <br>PPJ : Rp <?php echo number_format($pasangbaru->ppj, 2)  ?>
                <br>Token : Rp <?php echo number_format($pasangbaru->token, 2)  ?>
                <br>Materai : Rp <?php echo number_format($pasangbaru->materai, 2)  ?>
              </small>
            </td>
            <td>
              <a>Rp <?php echo number_format($pasangbaru->total, 2) ?><sup></sup></a>
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
        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</form>