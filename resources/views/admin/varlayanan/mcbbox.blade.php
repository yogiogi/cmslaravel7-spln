<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function() {
        $('#saveButton').on('click', function() {

            console.log($('#id').val());
            console.log("id");

            $.ajax({
                url: '{{ url("admin/varmcbbox/update") }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: $('#id').val(),
                    harga_mcb: $('#mcb').val(),
                    harga_lnb: $('#lnb').val(),
                    harga_mccb: $('#mccb').val(),
                    harga_trafo: $('#trafo').val(),
                    mdp: $('#mdp').val(),
                    sdp: $('#sdp').val(),
                    daya: $('#daya').val(),
                    slo: $('#slo').val(),
                    gil: $('#gil').val(),
                    ujl: $('#ujl').val(),
                    materai: $('#materai').val(),
                    biaya: $('#biaya').val(),
                    ppn: $('#ppn').val(),
                    ppj: $('#ppj').val(),
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

    $(document).ready(function() {
        $('#tambahButton').on('click', function() {


            $.ajax({
                url: '{{ url("admin/varmcbbox/tambah") }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    harga_mcb: $('#tbmcb').val(),
                    harga_lnb: $('#tblnb').val(),
                    harga_mccb: $('#tbmccb').val(),
                    harga_trafo: $('#tbtrafo').val(),
                    mdp: $('#tbmdp').val(),
                    sdp: $('#tbsdp').val(),
                    daya: $('#tbdaya').val(),
                    slo: $('#tbslo').val(),
                    gil: $('#tbgil').val(),
                    ujl: $('#tbujl').val(),
                    materai: $('#tbmaterai').val(),
                    biaya: $('#tbbiaya').val(),
                    ppn: $('#tbppn').val(),
                    ppj: $('#tbppj').val(),
                },
                dataType: 'text',
                success: function(data) {
                    $("#showModalTambah").modal("toggle");
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan server');
                }
            });
        });
    });
</script>

<span class="input-group-btn btn-flat">
    <a href="#modalNewdata" class="btn btn-info btn-sm " data-toggle="modal" data-target="#modalNewdata">
        <i class="fa fa-plus"></i> Tambah Baru</a>

</span>
<div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="bg-dark">
                <th width="5%" class="text-center">Daya</th>
                <th width="5%" class="text-center">Harga MCB</th>
                <th width="5%" class="text-center">Harga LNB</th>
                <th width="5%" class="text-center">Harga MCCB</th>
                <th width="5%" class="text-center">Harga Trafo</th>
                <th width="5%" class="text-center">MDP</th>
                <th width="5%" class="text-center">SDP</th>
                <th width="5%" class="text-left">SLO</th>
                <th width="5%" class="text-center">GIL</th>
                <th width="5%" class="text-center">UJL</th>
                <th width="5%" class="text-center">Materai</th>
                <th width="5%" class="text-center">Biaya</th>
                <th width="5%" class="text-center">PPN</th>
                <th width="5%" class="text-center">PPJ</th>
                <th width="5%" class="text-center"></th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($varmcbbox as $varmcbbox) { ?>
                <tr class="odd gradeX">
                    <td>
                        <?php echo $varmcbbox->daya ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->harga_mcb ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->harga_lnb ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->harga_mccb ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->harga_trafo ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->mdp ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->sdp ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->slo ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->gil ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->ujl ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->materai ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->biaya ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->PPN ?>
                    </td>
                    <td>
                        <?php echo $varmcbbox->PPJ ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="#modalPengaduanTeknis" class="btn btn-info btn-sm " data-toggle="modal" data-target="#modalPengaduanTeknis<?php echo $varmcbbox->id ?>"><i class="fas fa-edit"></i></a>
                            <a href="{{ asset('admin/varmcbbox/delete/'.$varmcbbox->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="modalPengaduanTeknis<?php echo $varmcbbox->id ?>" tabindex="-1" aria-labelledby="modalPengaduanTeknis" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> Edit <?php echo $title ?> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--Modal update data-->
                                <form action="" accept-charset="utf-8">
                                    <input type="hidden" name="id" id="id" value=<?php echo $varmcbbox->id ?>>
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Daya : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="daya" name="daya" value=<?php echo $varmcbbox->daya ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Harga MCB : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="mcb" name="mcb" value=<?php echo $varmcbbox->harga_mcb ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Harga MCCB : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="mccb" name="mccb" value=<?php echo $varmcbbox->harga_mccb ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Harga LNB : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="lnb" name="lnb" value=<?php echo $varmcbbox->harga_lnb ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Harga Trafo : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="trafo" name="trafo" value=<?php echo $varmcbbox->harga_trafo ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">MDP : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="mdp" name="mdp" value=<?php echo $varmcbbox->mdp ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">SDP : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="sdp" name="sdp" value=<?php echo $varmcbbox->sdp ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">SLO : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="slo" name="slo" value=<?php echo $varmcbbox->slo ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">GIL : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="gil" name="fil" value=<?php echo $varmcbbox->gil ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">UJL : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="ujl" name="ujl" value=<?php echo $varmcbbox->ujl ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Materai : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="ujl" name="ujl" value=<?php echo $varmcbbox->materai ?>>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">UJL : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="ujl" name="ujl" value=<?php echo $varmcbbox->ujl ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">PPN : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="ppn" name="ppn" value=<?php echo $varmcbbox->PPN ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">PPJ : </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="ppj" name="ppj" value=<?php echo $varmcbbox->PPJ ?>>
                                        </div>
                                    </div>

                                    <button id="saveButton" name="saveButton" type="button" class="btn btn-primary" data-dismiss="modal">Simpan Data</button>

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

<div class="modal fade" id="modalNewdata" tabindex="-1" aria-labelledby="modalNewdata" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Tambah <?php echo $title ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--Modal update data-->
                <form action="" accept-charset="utf-8">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Daya : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbdaya" name="tbdaya" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Harga MCB : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbmcb" name="tbmcb" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Harga MCCB : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbmccb" name="tbmccb" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Harga LNB : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tblnb" name="tb" valnblue="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Harga Trafo : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbtrafo" name="tbtrafo" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">MDP : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbmdp" name="tbmdp" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">SDP : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbsdp" name="tbsdp" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">SLO : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbslo" name="tbslo" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">GIL : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbgil" name="tbgil" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">UJL : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbujl" name="tbujl" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Materai : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbmaterai" name="tbmaterai" value="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Biaya : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbbiaya" name="tbbiaya" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">PPN : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbppn" name="tbppn" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">PPJ : </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tbppj" name="tbppj" value="">
                        </div>
                    </div>

                    <button id="tambahButton" name="tambahButton" type="button" class="btn btn-primary" data-dismiss="modal">Simpan Data</button>

                </form>
                <!--Modal update data-->
            </div>
        </div>
    </div>
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
                <button class="btn btn-primary" href="http://spln.co.id/admin/varpasangbarupra/" onclick="javascript:window.location.reload()" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModalTambah" name="showModalTambah" tabindex="-1" role="dialog" aria-labelledby="showmodalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Berhasil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="areaValue">
                <p>Data Anda sudah berhasil ditambahkan</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" href="http://spln.co.id/admin/varpasangbarupra/" onclick="javascript:window.location.reload()" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>