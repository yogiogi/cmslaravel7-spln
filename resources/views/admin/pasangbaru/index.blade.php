<form action="{{ asset('Pasangbaru/proses') }}" method="post" accept-charset="utf-8">
<?php $site   = DB::table('konfigurasi')->first(); ?>
{{ csrf_field() }}

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
        <th width="15%">KONSUMEN</th>
        <th width="10%">INSTALASI</th>
        <th width="15%">BIAYA</th>
        <th width="15%">STATUS</th>
        <th width="5%">TOTAL</th>
        <th width="5%"></th>
    </tr>
</thead>
<tbody>

<?php $i=1; foreach($pasangbaru as $pasangbaru) { ?>

<tr class="odd gradeX">
    <td class="text-center">
      <div class="icheck-primary">
        <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="<?php echo $pasangbaru->id ?>">
        <label for="check<?php echo $i ?>"></label>
      </div>
    </td>
    <td>
        <a>
            <?php echo $pasangbaru->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
        </a>
        <small>
            <br>alamat : <?php echo $pasangbaru->alamat ?>, <?php echo $pasangbaru->kabupaten ?>, <?php echo $pasangbaru->provinsi ?>
            <br>telp : <?php echo $pasangbaru->telp ?>
            <br>email : <?php echo $pasangbaru->email ?>
            <br>tanggal daftar : <?php if($pasangbaru->tgl_permohonan != 0) { echo date("d/m/Y", strtotime($pasangbaru->tgl_permohonan)); } else {echo "-";} ?>
            <br>tanggal disetujui : <?php if($pasangbaru->tgl_approve != 0) { echo date("d/m/Y", strtotime($pasangbaru->tgl_approve)); } else {echo "-";} ?>
        </small>
    </td>
    <td>
        <a><?php if($pasangbaru->sifat_instalasi == 1) {echo "Prabayar";} else if($pasangbaru->sifat_instalasi == 2) {echo "Pasca Bayar";} ?><sup></i></sup></a>
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
      <a>Rp <?php echo number_format($perubahandaya->total, 2)?><sup></sup></a>
    </td>
    <td>
      <a><?php if($pasangbaru->status==0) { echo"Belum Disetujui ";} else if($pasangbaru->status==1){ echo"Disetujui ";} ?><sup></sup></a>
    </td>
    <td>
      <div class="btn-group">
        @if($pasangbaru->status==0)
        <a href="{{ asset('admin/pasangbaru/update/'.$pasangbaru->id) }}"  class="btn btn-primary btn-sm">
          <i class="fa fa-circle"></i>
        </a>
        @else
        <a href=""class="btn btn-primary btn-sm">
          <i class="fas fa-check-circle"></i>
        </a>
        @endif

        <a href="{{ asset('admin/pasangbaru/delete/'.$pasangbaru->id) }}" 
        class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>