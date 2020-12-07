<form action="{{ asset('Instalasi/proses') }}" method="post" accept-charset="utf-8">
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

<?php $i=1; foreach($instalasi as $instalasi) { ?>

<tr class="odd gradeX">
    <td>
        <a>
            <?php echo $instalasi->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
        </a>
        <small>
            <br>alamat : <?php echo $instalasi->alamat ?>, <?php echo $instalasi->kabupaten ?>, <?php echo $instalasi->provinsi ?>
            <br>telp : <?php echo $instalasi->telp ?>
            <br>email : <?php echo $instalasi->email ?>
            <br>tanggal daftar : <?php if($instalasi->tgl_permohonan != 0) { echo date("d/m/Y", strtotime($instalasi->tgl_permohonan)); } else {echo "-";} ?>
            <br>tanggal disetujui : <?php if($instalasi->tgl_approve != 0) { echo date("d/m/Y", strtotime($instalasi->tgl_approve)); } else {echo "-";} ?>
        </small>
    </td>
    <td>
      <small>
        <a>Titik Lampu : <?php echo $instalasi->titik_lampu ?> titik</a>
        <br><a>Titik Saklar : <?php echo $instalasi->titik_saklar ?> titik</a>
        <br><a>Titik Stop kontak : <?php echo $instalasi->titik_stop_kontak ?> titik</a>
      </small>
    </td>
    <td> 
      <a>
        Rp <?php echo number_format($instalasi->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
      </a>
      <small>
        <br>PPN : Rp <?php echo number_format($instalasi->ppn, 2)  ?>
        <br>PPJ : Rp <?php echo number_format($instalasi->ppj, 2)  ?>
        <br>Materai : Rp <?php echo number_format($instalasi->materai, 2)  ?>
      </small>
    </td>
    <td>
      <a>Rp <?php echo number_format($instalasi->total, 2)?><sup></sup></a>
    </td>
    <td>
      <a><?php if($instalasi->status==0) { echo"Belum Disetujui ";} else if($instalasi->status==1){ echo"Disetujui ";} ?><sup></sup></a>
    </td>
    <td>
      <div class="btn-group">
        @if($instalasi->status==0)
        <a href="{{ asset('admin/instalasi/update/'.$instalasi->id) }}"  class="btn btn-primary btn-sm">
          <i class="fa fa-circle"></i>
        </a>
        @else
        <a href=""class="btn btn-primary btn-sm">
          <i class="fas fa-check-circle"></i>
        </a>
        @endif

        <a href="{{ asset('admin/instalasi/delete/'.$instalasi->id) }}" 
        class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>