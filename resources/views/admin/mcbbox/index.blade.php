<form action="{{ asset('Mcbbox/proses') }}" method="post" accept-charset="utf-8">
<?php $site   = DB::table('konfigurasi')->first(); ?>
{{ csrf_field() }}

<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark">
        <th width="15%">KONSUMEN</th>
        <th width="10%">INSTALASI</th>
        <th width="15%">BIAYA</th>
        <th width="15%">STATUS</th>
        <th width="5%">TOTAL</th>
        <th width="5%"></th>
    </tr>
</thead>
<tbody>

<?php $i=1; foreach($mcbbox as $mcbbox) { ?>

<tr class="odd gradeX">
    <td>
        <a>
            <?php echo $mcbbox->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
        </a>
        <small>
            <br>alamat : <?php echo $mcbbox->alamat ?>, <?php echo $mcbbox->kabupaten ?>, <?php echo $mcbbox->provinsi ?>
            <br>telp : <?php echo $mcbbox->telp ?>
            <br>email : <?php echo $mcbbox->email ?>
            <br>tanggal daftar : <?php if($mcbbox->tgl_permohonan != 0) { echo date("d/m/Y", strtotime($mcbbox->tgl_permohonan)); } else {echo "-";} ?>
            <br>tanggal disetujui : <?php if($mcbbox->tgl_approve != 0) { echo date("d/m/Y", strtotime($mcbbox->tgl_approve)); } else {echo "-";} ?>
        </small>
    </td>
    <td>
        <a><?php echo $mcbbox->grup_mcb ?> grup</a>
    </td>
    <td> 
      <a>
        Rp <?php echo number_format($mcbbox->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
      </a>
      <small>
        <br>PPN : Rp <?php echo number_format($mcbbox->ppn, 2)  ?>
        <br>PPJ : Rp <?php echo number_format($mcbbox->ppj, 2)  ?>
        <br>Materai : Rp <?php echo number_format($mcbbox->materai, 2)  ?>
      </small>
    </td>
    <td>
      <a>Rp <?php echo number_format($mcbbox->total, 2)?><sup></sup></a>
    </td>
    <td>
      <a><?php if($mcbbox->status==0) { echo"Belum Disetujui ";} else if($mcbbox->status==1){ echo"Disetujui ";} ?><sup></sup></a>
    </td>
    <td>
      <div class="btn-group">
        @if($mcbbox->status==0)
        <a href="{{ asset('admin/mcbbox/update/'.$mcbbox->id) }}"  class="btn btn-primary btn-sm">
          <i class="fa fa-circle"></i>
        </a>
        @else
        <a href=""class="btn btn-primary btn-sm">
          <i class="fas fa-check-circle"></i>
        </a>
        @endif

        <a href="{{ asset('admin/mcbbox/delete/'.$mcbbox->id) }}" 
        class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>