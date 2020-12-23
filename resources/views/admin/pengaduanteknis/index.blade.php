<form action="{{ asset('Pengaduanteknis/proses') }}" method="post" accept-charset="utf-8">
  <?php $site   = DB::table('konfigurasi')->first(); ?>
  {{ csrf_field() }}

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-dark">
          <th width="15%">KONSUMEN</th>
          <th width="10%">KETERANGAN PENGADUAN</th>
          <th width="15%">BIAYA</th>
          <th width="15%">STATUS</th>
          <th width="5%"></th>
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
                <br>alamat : <?php echo $pengaduanteknis->alamat ?>, <?php echo $pengaduanteknis->kabupaten ?>, <?php echo $pengaduanteknis->provinsi ?>
                <br>telp : <?php echo $pengaduanteknis->telp ?>
                <br>email : <?php echo $pengaduanteknis->email ?>
                <br>tanggal daftar : <?php if ($pengaduanteknis->tgl_permohonan != 0) {
                                        echo date("d/m/Y", strtotime($pengaduanteknis->tgl_permohonan));
                                      } else {
                                        echo "-";
                                      } ?>
                <br>tanggal selesai : <?php if ($pengaduanteknis->tgl_approve != 0) {
                                        echo date("d/m/Y", strtotime($pengaduanteknis->tgl_approve));
                                      } else {
                                        echo "-";
                                      } ?>
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
                <a href="{{ asset('admin/pengaduanteknis/update/'.$pengaduanteknis->id) }}" class="btn btn-primary btn-sm">
                  <i class="fa fa-circle btn-sm approval-link"></i>
                </a>
                @else
                <a href="" class="btn btn-primary btn-sm">
                  <i class="fas fa-check-circle"></i>
                </a>
                @endif
                <a href="{{ asset('admin/pengaduanteknis/edit/'.$pengaduanteknis->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit "></i></a>
                <a href="{{ asset('admin/pengaduanteknis/delete/'.$pengaduanteknis->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>

        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</form>