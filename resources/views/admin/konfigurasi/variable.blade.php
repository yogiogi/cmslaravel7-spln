<?php

use Illuminate\Support\Facades\DB;
use App\resource_model;

$site = DB::table('konfigurasi')->first();
$resource = new resource_model();
$layanan = $resource->varLayanan();
?>

<script>
    $(document).ready(function() {
        $('.option').hide();
        $('#layanan').on('change', function(e) {
            $('.option').hide();
            $('.optin' + e.target.value).show();
        });
    });
</script>

<script>
    $(document).ready(function() {
        var id = 1;
        $.ajax({
            type: "GET",
            url: "{{url('varLayanan')}}?id=" + id,
            dataType: "json",
            success: function(res) {
                if (res != null) {
                    $('#id_variable').val(res.id);
                    $('#hargameter').val(res.hargameter);
                    $('#titiklampu').val(res.lampu);
                    $('#titiksaklar').val(res.saklar);
                    $('#titikstop').val(res.stopkontak);
                    $('#harga_mcb').val(res.harga_mcb);
                    $('#harga_lnb').val(res.harga_lnb);
                    $('#harga_mccb').val(res.harga_mccb);
                    $('#harga_trafo').val(res.harga_trafo);
                    $('#harga_mdp').val(res.mdp);
                    $('#harga_sdp').val(res.sdp);
                    $('#slo').val(res.slo);
                    $('#gil').val(res.gil);
                    $('#ujl').val(res.ujl);
                    $('#materai').val(res.materai);
                    $('#biaya').val(res.biaya);
                    $('#ppn').val(res.PPN);
                    $('#ppj').val(res.PPJ);
                }
            },
            error: function(xhr, status, error) {
                //    alert('Sedang gangguan');
            }
        });

        $('#layanan').on('change', function() {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{url('varLayanan')}}?id=" + id,
                dataType: "json",
                success: function(res) {
                    if (res != null) {
                        $('#id_variable').val(res.id);
                        $('#hargameter').val(res.hargameter);
                        $('#titiklampu').val(res.lampu);
                        $('#titiksaklar').val(res.saklar);
                        $('#titikstop').val(res.stopkontak);
                        $('#harga_mcb').val(res.harga_mcb);
                        $('#harga_lnb').val(res.harga_lnb);
                        $('#harga_mccb').val(res.harga_mccb);
                        $('#harga_trafo').val(res.harga_trafo);
                        $('#harga_mdp').val(res.mdp);
                        $('#harga_sdp').val(res.sdp);
                        $('#slo').val(res.slo);
                        $('#gil').val(res.gil);
                        $('#ujl').val(res.ujl);
                        $('#materai').val(res.materai);
                        $('#biaya').val(res.biaya);
                        $('#ppn').val(res.PPN);
                        $('#ppj').val(res.PPJ);
                    }
                },
                error: function(xhr, status, error) {
                    //    alert('Sedang gangguan');
                }
            });

        });
    })
</script>

<script>

</script>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ url('updateLayanan') }}" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" id="id_variable" name="id_variable">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Layanan</label>
                <select id="layanan" name="layanan" class="form-control select2">
                    <option value="">--Pilih Layanan--</option>
                    @foreach($layanan as $layanan)
                    <option value="{{ $layanan->id }}"> {{ $layanan->layanan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="option optin7" id="option-1">
                    <label>Harga kabel penghantar Per meter</label>
                    <input type="number" id="hargameter" name="hargameter" placeholder="Harga kabel per meter" required class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="option optin7" id="option-1">
                    <label>Harga per titik Lampu</label>
                    <input type="number" id="titiklampu" name="titiklampu" placeholder="harga per titik lampu" required class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="option optin7" id="option-1">
                    <label>Harga per titik saklar</label>
                    <input type="number" id="titiksaklar" name="titiksaklar" placeholder="Harga per titik saklar" required class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="option optin7" id="option-1">
                    <label>Harga per titik stop kontak</label>
                    <input type="number" id="titikstop" name="titikstop" placeholder="Harga per titik stop kontak" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin8" id="option-2">
                    <label>Harga MCB</label>
                    <input type="number" id="harga_mcb" name="harga_mcb" placeholder="harga mcb" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin8" id="option-3">
                    <label>Harga LNB</label>
                    <input type="number" id="harga_lnb" name="harga_lnb" placeholder="harga lnb" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin8" id="option-4">
                    <label>Harga MCCB</label>
                    <input type="number" id="harga_mccb" name="harga_mccb" placeholder="harga mccb" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin8" id="option-5">
                    <label>Harga Trafo</label>
                    <input type="number" id="harga_trafo" name="harga_trafo" placeholder="harga trafo" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin8" id="option-6">
                    <label>Harga MDP</label>
                    <input type="number" id="harga_mdp" name="harga_mdp" placeholder="Nilai MDP" required class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="option optin8" id="option-7">
                    <label>Harga SDP</label>
                    <input type="number" id="harga_sdp" name="harga_sdp" placeholder="Nilai SDP" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin1 optin2 optin3 optin4 optin5 optin10" id="option-8">
                    <label>SLO</label>
                    <input type="number" id="slo" name="slo" placeholder="Nilai SLO" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin1 optin2 optin3 optin4 optin5 optin10" id="option-9">
                    <label>GIL</label>
                    <input type="number" id="gil" name="gil" placeholder="Nilai GIL" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin2 optin4 optin5" id="option-10">
                    <label>UJL</label>
                    <input type="number" id="ujl" name="ujl" placeholder="Nilai UJL" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="option optin1 optin2 optin3 optin4 optin5 optin6 optin7 optin8 optin10" id="option-11">
                    <label>Materai</label>
                    <input type="number" id="materai" name="materai" placeholder="Nilai materai" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin1 optin2 optin3 optin4 optin5 optin6 optin7 optin8 optin10" id="option-12">
                    <label>Biaya</label>
                    <input type="number" id="biaya" name="biaya" placeholder="Nilai biaya" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="option optin1 optin2 optin3 optin4 optin5 optin6 optin7 optin8 optin10" id="option-13">
                    <label>PPN</label>
                    <input type="text" id="ppn" name="ppn" placeholder="Nilai PPN" class="form-control" value="{{ number_format(old('ppn'),2) }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="option optin1 optin2 optin3 optin4 optin5 optin6 optin7 optin8 optin10" id="option-14">
                    <label>PPJ</label>
                    <input type="text" id="ppj" name="ppj" placeholder="NIlai PPJ" class="form-control" value="{{ number_format(old('ppj'),2) }}" required>
                </div>
            </div>
            <div class="option optin1 optin2 optin3 optin4 optin5 optin6 optin7 optin8 optin9 optin10 button form-group btn-group">
                <input type="submit" name="submit" value="Save Configuration" class="btn btn-success ">
                <input type="reset" name="reset" value="Reset" class="btn btn-primary ">
            </div>
        </div>
    </div>
</form>