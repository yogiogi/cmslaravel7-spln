<form action="{{ asset('Pendaftaranslo/proses') }}" method="post" accept-charset="utf-8">
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
        <th width="10%">KTP</th>
        <th width="10%">ALAMAT</th>
        <th width="10%">INSTALASI</th>
        <th width="10%">BADAN USAHA</th>
        <th width="15%">ACTION</th>
        <th width="5%"></th>
    </tr>
</thead>
<tbody>

<?php $i=1; foreach($slo as $slo) { ?>

<tr class="odd gradeX">
    <td class="text-center">
      <div class="icheck-primary">
        <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="<?php echo $slo->id ?>">
        <label for="check<?php echo $i ?>"></label>
      </div>
    </td>
    <td>
        <a>
            <?php echo $slo->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
        </a>
        <small>
            <br>telepon : <?php echo $slo->telp ?>
            <br>email : <?php echo $slo->email ?>
            <br>tanggal daftar : <?php echo $slo->tanggal_daftar ?>
            <br>tanggal diterima : <?php echo $slo->tanggal_approve ?>
        </small>
    </td>
    <td>
        <a><?php echo $slo->ktp ?><sup><i class="fa fa-link"></i></sup></a>
    </td>
    <td>
      <a><?php echo $slo->alamat ?><sup><i class="fa fa-link"></i></sup></a>
      <small>
        <br><?php echo $slo->kabupaten ?>
        <br><?php echo $slo->provinsi ?>
      </small>
    </td>
    <td>
        <a><?php echo $slo->instalasi ?><sup><i class="fa fa-link"></i></sup></a>
        <small>
            @if($slo->instalasi = 2)
            <br>daya baru: <?php echo $slo->daya ?>
            <br>daya lama : <?php echo $slo->dayalama ?>
            <br>nomer djk lama : <?php echo $slo->djklama ?>
            @elseif($slo->instalasi = 1)
            <br>daya : <?php echo $slo->daya ?>
            @endif
        </small>
    </td>
    <td>
        <a><?php echo $slo->badan_usaha ?><sup><i class="fa fa-link"></i></sup></a>
    </td>
    <td><a>
      <span class="btn btn-sm <?php if($slo->status=="Publish") { echo 'btn-success'; }else{ echo 'btn-warning'; } ?> btn-block">
        <i class="fa <?php if($slo->status==1) { echo 'fa-check-circle'; }else{ echo 'fa-times'; } ?>"></i> <?php if($slo->status==1) { echo "approved"; } ?></span>
    </a>
    </td>
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/berita/delete/'.$slo->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>