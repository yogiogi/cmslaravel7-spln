<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
  $(document).ready(function() {
    $('#saveButton').on('click', function() {
      $.ajax({
        url: '{{ url("/admin/pengaduanteknis/edit") }}',
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          id: $('#id').val(),
          biaya: $('#biaya').val(),
        },
        dataType: 'text',
        success: function(data) {
          $("#showModal").modal("toggle");
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan server');
        }
      });
    });
  });
</script>

<div class="row">
  <div class="col-md-12">
    <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-danger btn-sm" type="submit" name="hapus" onClick="check();">
          <i class="fas fa-trash-alt"></i>
        </button>
      </span>
      <div>&nbsp&nbsp</div>
      <div class="btn btn-secondary btn-sm"> Keterangan : Status Disetujui <a class="btn btn-primary btn-sm approval-link"></a>&nbsp|&nbsp Status Pembayaran <a class="btn btn-warning btn-sm approval-link"></a>&nbsp|&nbsp Status Selesai <a class="btn btn-success btn-sm approval-link"></a> </a> </div>
    </div>
  </div>
</div>

<div class="clearfix">
  <hr>
</div>

<div class="col-md-8">
  <div class="btn-group">
    <?php if (isset($pagin)) {
      echo $pagin;
    } ?>
  </div>
</div>

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
        <th width="15%" class="text-center">NAMA PEMOHON</th>
        <th width="10%" class="text-left">ID PELANGGAN</th>
        <th width="10%" class="text-center">KETERANGAN PENGADUAN</th>
        <th width="15%" class="text-center">BIAYA</th>
        <th width="5%" class="text-center">STATUS</th>
        <th width="5%" class="text-center"></th>
      </tr>
    </thead>
    <tbody>

      <?php $i = 1;
      foreach ($pengaduanteknis as $pengaduanteknis) { ?>

        <tr class="odd gradeX">
          <td class="text-center">
            <div class="icheck-primary">
              <input type="checkbox" class="icheckbox_flat-blue " name="idpengaduannya[]" value="<?php echo $pengaduanteknis->id ?>">
              <label for="check<?php echo $i ?>"></label>
            </div>
          </td>
          <td>
            <a>
              <?php echo $pengaduanteknis->nama_konsumen ?> <sup><i class="fa fa-pencil"></i></sup>
            </a>

            <small>
              <br>ID Layanan : <a><?php echo $pengaduanteknis->id_layanan ?></a>
              <br>ID transaksi : <a><?php echo $pengaduanteknis->id_transaksi ?></a>
              <br>
              <br>
              <a href="#modalDetailID" data-toggle="modal" data-target="#modalDetailID<?php echo $pengaduanteknis->id ?>">Detail</a>
              <br><b><a><?php if ($pengaduanteknis->status == 0) {
                          echo "Belum Disetujui ";
                        } else if ($pengaduanteknis->status == 1) {
                          echo "Disetujui ";
                        } ?><sup></sup></a></b>
              <br>tanggal daftar :
              <?php if ($pengaduanteknis->tgl_permohonan != 0) {
                echo date("d/m/Y", strtotime($pengaduanteknis->tgl_permohonan));
              } else {
                echo "-";
              } ?>
              <br>tanggal selesai :
              <?php if ($pengaduanteknis->tgl_approve != 0) {
                echo date("d/m/Y", strtotime($pengaduanteknis->tgl_approve));
              } else {
                echo "-";
              } ?>
              <br>tanggal bayar : <?php if ($pengaduanteknis->tanggal_bayar != 0) {
                                    echo date("d/m/Y", strtotime($pengaduanteknis->tanggal_bayar));
                                  } else {
                                    echo "-";
                                  } ?>
              <br>tanggal selesai: <?php if ($pengaduanteknis->tanggal_selesai != 0) {
                                      echo date("d/m/Y", strtotime($pengaduanteknis->tanggal_selesai));
                                    } else {
                                      echo "-";
                                    } ?>
            </small>
          </td>
          <td>
            <small>
              <a>ID Pelanggan <?php echo $pengaduanteknis->id_pelanggan ?> </a>
              <br><a>Nomer Meter : <?php echo $pengaduanteknis->no_meter ?> </a>
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
            @if($pengaduanteknis->buktid!=null)
            <img src="{{ asset('public/upload/transaksi/'.$pengaduanteknis->buktid) }}" alt="test" class="img-fluid img-thumbnail">
            <br>
            <small>
              tanggal : <?php echo $pengaduanteknis->tgld ?> <br>
              <a href="#modalDetailBayar" data-toggle="modal" data-target="#modalDetailBayar<?php echo $pengaduanteknis->id ?>">Detail</a>
            </small>
            @endif
          </td>
          <td>
            <div class="btn-group">
              @if($pengaduanteknis->status==0)
              <a href="{{ asset('admin/pengaduanteknis/update/'.$pengaduanteknis->id) }}" class="btn btn-primary btn-sm approval-link">
                <i class="fa fa-circle"></i>
              </a>
              @else
              <a href="" class="btn btn-primary btn-sm">
                <i class="fas fa-check-circle"></i>
              </a>
              @endif

              @if($pengaduanteknis->status==1)
              @if($pengaduanteknis->status_bayar==0)
              <a href="{{ asset('admin/pengaduanteknis/update_bayar/'.$pengaduanteknis->id) }}" class="btn btn-warning btn-sm approval-link">
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

              @if($pengaduanteknis->status==1)
              @if($pengaduanteknis->status_bayar==1)
              @if($pengaduanteknis->status_selesai==0)

              <a href="{{ asset('admin/pengaduanteknis/update_selesai/'.$pengaduanteknis->id) }}" class="btn btn-success btn-sm approval-link">
                <i class="fa fa-circle"></i>
              </a>
              @else
              <a href="" class="btn btn-success btn-sm">
                <i class="fa fa-check-circle"></i>
              </a>
              @endif
              @else
              <a href="" class="btn btn-success btn-sm">
                <i class="fa fa-circle"></i>
              </a>
              @endif
              @else
              <a href="" class="btn btn-success btn-sm warning-link">
                <i class="fa fa-circle"></i>
              </a>
              @endif

              <a href="#modalPengaduanTeknis" class="btn btn-info btn-sm " data-toggle="modal" data-target="#modalPengaduanTeknis<?php echo $pengaduanteknis->id ?>"><i class="fas fa-edit"></i></a>
              <a href="{{ asset('admin/pengaduanteknis/delete/'.$pengaduanteknis->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
            </div>
          </td>
        </tr>

        <div class="modal fade" id="modalDetailBayar<?php echo $pengaduanteknis->id ?>" tabindex="-1" aria-labelledby="modalDetailBayar" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Data Pembayaran </h5>
              </div>

              <div class="modal-body">
                <!--Modal update data-->
                <form accept-charset="utf-8">
                  <input type="hidden" name="id" value="{{ $pengaduanteknis->id }}">
                  {{ csrf_field() }}
                  <div class="column">
                    <label name="konsumen">Rekening Tujuan : </label>
                    <br><label> <?php echo $pengaduanteknis->noreksplnd ?></label>
                    <br><label> <?php echo $pengaduanteknis->atasnamasplnd ?></label>
                    <br><label> Cara bayar : <?php echo $pengaduanteknis->carabayard ?></label>
                    <br><label> Tanggal Bayar : <?php echo $pengaduanteknis->tglbayard ?></label>
                    <br><br><label> Pengirim : </label>
                    <br><label> Nomer Rekening: <?php echo $pengaduanteknis->norekd ?></label>
                    <br><label> a.n : <?php echo $pengaduanteknis->namapemilikd ?></label>
                    <br><label> Bank : <?php echo $pengaduanteknis->namabankd ?></label>
                    <br><label> Keterangan : <?php echo $pengaduanteknis->keterangand ?></label>
                    <br><label> Jumlah yang dibayar : Rp <?php echo number_format($pengaduanteknis->jmlpembayarand) ?></label>
                  </div>
                </form>
                <!--Modal update data-->
              </div>
            </div>
          </div>
        </div>
        ƒ
        <div class="modal fade" id="modalPengaduanTeknis<?php echo $pengaduanteknis->id ?>" tabindex="-1" aria-labelledby="modalPengaduanTeknis" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Pengaduan Teknis </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <!--Modal update data-->
                <form action="" accept-charset="utf-8">
                  <input type="hidden" name="id" value="{{ $pengaduanteknis->id }}">
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label class="col-sm-4 control-label text-right" for="">Konsumen : </label>
                    <div class="col-sm-8">
                      <label id="edKonsumen" name="edKonsumen"><?php echo $pengaduanteknis->nama_konsumen ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label text-right" for="">Keterangan Pengaduan : </label>
                    <div class="col-sm-8">
                      <label id="edPengaduan" name="edPengaduan"><?php echo $pengaduanteknis->keterangan ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label text-right" for="">Biaya : </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="biaya" name="biaya" value=<?php echo $pengaduanteknis->biaya ?>>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label text-right" for="">Status : </label>
                    <div class="col-sm-8">
                      <?php if ($pengaduanteknis->status == 0) {
                        echo "Belum Diselesaikan ";
                      } else if ($pengaduanteknis->status == 1) {
                        echo "Sudah diselesaikan ";
                      } ?>
                    </div>
                  </div>
                  <button id="saveButton" name="saveButton" type="button" class="btn btn-primary" data-dismiss="modal">Simpan Data</button>

                </form>
                <!--Modal update data-->
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalDetailID<?php echo $pengaduanteknis->id ?>" tabindex="-1" aria-labelledby="modalDetailID" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Data Pemohon </h5>
              </div>

              <div class="modal-body">
                <!--Modal update data-->
                <form action="{{ asset('admin/pengaduanteknis/detail') }}" method="post" accept-charset="utf-8">
                  <input type="hidden" id="id" name="id" value="{{ $pengaduanteknis->id }}">
                  {{ csrf_field() }}
                  <div class="column">
                    <label id="edKonsumen" name="konsumen">Nama : <?php echo $pengaduanteknis->nama_konsumen ?></label>
                    <br><label id="edKonsumen" name="ktp"> KTP : <?php echo $pengaduanteknis->ktp ?></label>
                    <br><label id="edKonsumen" name="alamat"> Alamat : <?php echo $pengaduanteknis->alamat ?></label>
                    <br><label id="edKonsumen" name="geolocation"> Desa <?php echo ucfirst(strtolower($pengaduanteknis->desa)) ?>,
                      Kecamatan <?php echo ucfirst(strtolower($pengaduanteknis->kec)) ?>,
                      <?php echo ucfirst(strtolower($pengaduanteknis->kab)) ?>,
                      <?php echo ucfirst(strtolower($pengaduanteknis->prov)) ?></label>
                    <br><label id="edKonsumen" name="telp"> Telepon : <?php echo $pengaduanteknis->telp ?></label>
                    <br><label id="edKonsumen" name="email"> Email : <?php echo $pengaduanteknis->email ?></label>
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

<div class="modal fade" id="showModal" name="showModal" tabindex="-1" role="dialog" aria-labelledby="showmodalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Berhasil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="areaValue">
        <p>Data Anda sudah berhasil terupdate</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" href="http://spln.co.id/admin/pengaduanteknis/" onclick="javascript:window.location.reload()" data-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<div class="clearfix">
  <hr>
</div>
<div class="pull-right"><?php if (isset($pagin)) {
                          echo $pagin;
                        } ?></div>