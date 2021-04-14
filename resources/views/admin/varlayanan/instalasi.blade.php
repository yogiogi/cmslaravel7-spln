<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function() {
        $('#tambahButton').on('click', function() {
            console.log($('#id').val());
            console.log("id");

            $.ajax({
                url: '{{ url("admin/varinstalasi/tambah") }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    daya: $('#tbdaya').val(),
                    lampu: $('#tblampu').val(),
                    saklar: $('#tbsaklar').val(),
                    stopkontak: $('#tbstopkontak').val(),
                    hargameter: $('#tbkabel').val(),
                    slo: $('#tbslo').val(),
                    slo: $('#tbslo').val(),
                    slo: $('#tbslo').val(),
                    slo: $('#tbslo').val(),
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
                <th width="15%" class="text-center">Daya</th>
                <th width="15%" class="text-center">Lampu</th>
                <th width="15%" class="text-center">Saklar</th>
                <th width="15%" class="text-center">Stop Kontak</th>
                <th width="15%" class="text-center">Kabel penghantar per meter</th>
                <th width="10%" class="text-left">SLO</th>
                <th width="10%" class="text-center">GIL</th>
                <th width="15%" class="text-center">UJL</th>
                <th width="5%" class="text-center">Materai</th>
                <th width="5%" class="text-center">Biaya</th>
                <th width="5%" class="text-center">PPN</th>
                <th width="5%" class="text-center">PPJ</th>
                <th width="5%" class="text-center"></th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($varinstalasi as $varinstalasi) { ?>
                <tr class="odd gradeX">
                    <td>
                        <?php echo $varinstalasi->daya ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->lampu ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->saklar ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->stopkontak ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->hargameter ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->slo ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->gil ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->ujl ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->materai ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->biaya ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->PPN ?>
                    </td>
                    <td>
                        <?php echo $varinstalasi->PPJ ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="#modalEditdata" class="btn btn-info btn-sm " data-toggle="modal" data-target="#modalEditdata<?php echo $varinstalasi->id ?>"><i class="fas fa-edit"></i></a>
                            <a href="{{ asset('admin/varinstalasi/delete/'.$varinstalasi->id) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="modalEditdata<?php echo $varinstalasi->id ?>" tabindex="-1" aria-labelledby="modalEditdata" aria-hidden="true">
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
                                <!-- <form action="" accept-charset="utf-8"> -->
                                <form action="varinstalasi/update/{{ $varinstalasi->id }}" method="POST">
                                    <input type="hidden" name="id" id="id" value=<?php echo $varinstalasi->id ?>>
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Daya : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="daya" name="daya" value=<?php echo $varinstalasi->daya ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Lampu : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="lampu" name="lampu" value=<?php echo $varinstalasi->lampu ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Saklar : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="saklar" name="saklar" value=<?php echo $varinstalasi->saklar ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Stop Kontak : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="stopkontak" name="stopkontak" value=<?php echo $varinstalasi->stopkontak ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Kabel Penghantar : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="hargameter" name="hargameter" value=<?php echo $varinstalasi->hargameter ?> meter>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">SLO : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="slo" name="slo" value=<?php echo $varinstalasi->slo ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">GIL : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="gil" name="gil" value=<?php echo $varinstalasi->gil ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">UJL : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="ujl" name="ujl" value=<?php echo $varinstalasi->ujl ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Materai : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="materai" name="materai" value=<?php echo $varinstalasi->materai ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">Biaya : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="biaya" name="biaya" value=<?php echo $varinstalasi->biaya ?>>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">PPN : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="ppn" name="ppn" value=<?php echo $varinstalasi->PPN ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 control-label text-right" for="">PPJ : </label>
                                        <div class="col-sm-8">
                                            <input type="number" step="any" class="form-control" id="ppj" name="ppj" value=<?php echo $varinstalasi->PPJ ?>>
                                        </div>
                                    </div>

                                    <!-- <button id="saveButton" name="saveButton" type="button" class="btn btn-primary" data-dismiss="modal">Simpan Data</button> -->
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>

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
                            <input type="number" step="any" class="form-control" id="tbdaya" name="tbdaya" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Lampu : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tblampu" name="tblampu" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Saklar : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbsaklar" name="tbsaklar" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Stop Kontak : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbstopkontak" name="tbstopkontak" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Kabel Penghantar : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbkabel" name="tbkabel" value="">
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
                            <input type="number" step="any" class="form-control" id="tbgil" name="tbgil" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">UJL : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbujl" name="tbujl" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Materai : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbmaterai" name="tbmaterai" value="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">Biaya : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbbiaya" name="tbbiaya" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">PPN : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbppn" name="tbppn" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-right" for="">PPJ : </label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control" id="tbppj" name="tbppj" value="">
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