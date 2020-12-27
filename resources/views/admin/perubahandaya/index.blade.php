<form action="{{ asset('Perubahandaya/proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark">
        <th width="15%" class="text-center">KONSUMEN</th>
        <th width="10%" class="text-center">INSTALASI</th>
        <th width="15%" class="text-center">BIAYA</th>
        <th width="5%" class="text-center">TOTAL</th>
        <th width="15%" class="text-center">STATUS</th>
        <th width="5%" class="text-center"></th>
    </tr>
</thead>
<tbody>

<?php $i=1; foreach($perubahandaya as $perubahandaya) { ?>

<tr class="odd gradeX">
    <td>
        <a>
            <?php echo $perubahandaya->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
        </a>
        <small>
            <br>alamat : <?php echo $perubahandaya->alamat ?>, <?php echo $perubahandaya->kabupaten ?>, <?php echo $perubahandaya->provinsi ?>
            <br>telp : <?php echo $perubahandaya->telp ?>
            <br>email : <?php echo $perubahandaya->email ?>
            <br>tanggal daftar : <?php if($perubahandaya->tgl_permohonan != 0) { echo date("d/m/Y", strtotime($perubahandaya->tgl_permohonan)); } else {echo "-";} ?>
            <br>tanggal disetujui : <?php if($perubahandaya->tgl_approve != 0) { echo date("d/m/Y", strtotime($perubahandaya->tgl_approve)); } else {echo "-";} ?>
        </small>
    </td>
    <td>
        <a>Daya lama : <?php echo $perubahandaya->daya_lama ?> Watt</a>
        <a>Daya baru : <?php echo $perubahandaya->daya_baru ?> Watt</a>
    </td>
    <td> 
      <a>
        Rp <?php echo number_format($perubahandaya->biaya, 2)  ?> <sup><i class="fa fa-pencil"></i></sup>
      </a>
      <small>
        <br>SLO : Rp <?php echo number_format($perubahandaya->slo, 2)  ?>
        <br>GIL : Rp <?php echo number_format($perubahandaya->gil, 2)  ?>
        <br>UJL : Rp <?php echo number_format($perubahandaya->ujl, 2)  ?>
        <br>PPN : Rp <?php echo number_format($perubahandaya->ppn, 2)  ?>
        <br>PPJ : Rp <?php echo number_format($perubahandaya->ppj, 2)  ?>
        <br>Materai : Rp <?php echo number_format($perubahandaya->materai, 2)  ?>
      </small>
    </td>
    <td>
      <a><?php echo number_format($perubahandaya->total, 2)?><sup></sup></a>
    </td>
    <td>
      <a><?php if($perubahandaya->status==0) { echo"Belum Disetujui ";} else if($perubahandaya->status==1){ echo"Disetujui ";} ?><sup></sup></a>
    </td>
    <td>
      <div class="btn-group">
        @if($perubahandaya->status==0)
        <a href="{{ asset('admin/perubahandaya/update/'.$perubahandaya->id) }}"  class="btn btn-primary btn-sm approval-link">
          <i class="fa fa-circle"></i>
        </a>
        @else
        <a href=""class="btn btn-primary btn-sm">
          <i class="fas fa-check-circle"></i>
        </a>
        @endif

        <a href="{{ asset('admin/perubahandaya/delete/'.$perubahandaya->id) }}" 
        class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>