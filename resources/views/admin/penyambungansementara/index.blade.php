<form action="{{ asset('Penyambungansementara/proses') }}" method="post" accept-charset="utf-8">
<?php $site   = DB::table('konfigurasi')->first(); ?>
{{ csrf_field() }}

<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark">
        <th width="15%">KONSUMEN</th>
        <th width="10%">INSTALASI</th>
        <th width="15%">BIAYA</th>
        <th width="5%">TOTAL</th>
        <th width="15%">STATUS</th>
        <th width="5%"></th>
    </tr>
</thead>
<tbody>

<?php $i=1; foreach($penyambungansementara as $penyambungansementara) { ?>

<tr class="odd gradeX">
    <td>
        <a>
            <?php echo $penyambungansementara->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
        </a>
        <small>
            <br>alamat : <?php echo $penyambungansementara->alamat ?>, <?php echo $penyambungansementara->kabupaten ?>, <?php echo $penyambungansementara->provinsi ?>
            <br>telp : <?php echo $penyambungansementara->telp ?>
            <br>email : <?php echo $penyambungansementara->email ?>
            <br>tanggal daftar : <?php if($penyambungansementara->tgl_permohonan != 0) { echo date("d/m/Y", strtotime($penyambungansementara->tgl_permohonan)); } else {echo "-";} ?>
            <br>tanggal disetujui : <?php if($penyambungansementara->tgl_approve != 0) { echo date("d/m/Y", strtotime($penyambungansementara->tgl_approve)); } else {echo "-";} ?>
        </small>
    </td>
    <td>
      <small>
        <a>Jam Nyala : <?php echo $penyambungansementara->jam_nyala ?> Jam</a><br>
        <a>Hari Nyala : <?php echo $penyambungansementara->hari_nyala ?> Hari</a>
      </small>
    </td>
    <td> 
      <a>
        Rp <?php echo number_format($penyambungansementara->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
      </a>
      <small>
        <br>PPN : Rp <?php echo number_format($penyambungansementara->ppn, 2)  ?>
        <br>PPJ : Rp <?php echo number_format($penyambungansementara->ppj, 2)  ?>
        <br>Materai : Rp <?php echo number_format($penyambungansementara->materai, 2)  ?>
      </small>
    </td>
    <td>
      <a>Rp <?php echo number_format($penyambungansementara->total, 2)?><sup></sup></a>
    </td>
    <td>
      <a><?php if($penyambungansementara->status==0) { echo"Belum Disetujui ";} else if($penyambungansementara->status==1){ echo"Disetujui ";} ?><sup></sup></a>
    </td>
    <td>
      <div class="btn-group">
        @if($penyambungansementara->status==0)
        <a href="{{ asset('admin/penyambungansementara/update/'.$penyambungansementara->id) }}"  class="btn btn-primary btn-sm">
          <i class="fa fa-circle"></i>
        </a>
        @else
        <a href=""class="btn btn-primary btn-sm">
          <i class="fas fa-check-circle"></i>
        </a>
        @endif

        <a href="{{ asset('admin/penyambungansementara/delete/'.$penyambungansementara->id) }}" 
        class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>