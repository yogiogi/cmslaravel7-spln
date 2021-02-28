<?php
  use Illuminate\Support\Facades\DB;
  use App\resource_model;

  $site = DB::table('konfigurasi')->first();
  $resource = new resource_model();
  $layanan = $resource->varLayanan();
?>

<script>
  $(document).ready(function(){
        var id = 1;  
        $.ajax({
            type:"GET",
            url:"{{url('varLayanan')}}?id="+id,
            dataType: "json",
            success:function(res){        
            if(res != null){
                $('#id_variable').val(res.id);
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
            type:"GET",
            url:"{{url('varLayanan')}}?id="+id,
            dataType: "json",
            success:function(res){      
                if(res != null){
                    $('#id_variable').val(res.id);
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
            @foreach($layanan as $layanan)
            <option value="{{ $layanan->id }}"> {{ $layanan->layanan }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
        <label>SLO</label>
            <input type="number" id="slo" name="slo" placeholder="Nilai SLO" required class="form-control">
        </div>

        <div class="form-group">
        <label>GIL</label>
            <input type="number" id="gil" name="gil" placeholder="Nilai GIL" required class="form-control">
        </div>
        
        <div class="form-group">
        <label>UJL</label>
            <input type="number" id="ujl" name="ujl" placeholder="Nilai UJL" class="form-control">
        </div>
        
        <div class="form-group">
        <label>Materai</label>
            <input type="number" id="materai" name="materai" placeholder="Nilai materai" class="form-control">
        </div>

        <div class="form-group">
        <label>Biaya</label>
            <input type="number" id="biaya" name="biaya" placeholder="Nilai biaya" class="form-control">
        </div>
        
        <div class="form-group">
        <label>PPN</label>
            <input type="text" id="ppn" name="ppn" placeholder="Nilai PPN" class="form-control" value="{{ number_format(old('ppn'),2) }}" required>
        </div>

        <div class="form-group">
        <label>PPJ</label>
            <input type="text" id="ppj" name="ppj" placeholder="NIlai PPJ" class="form-control" value="{{ number_format(old('ppj'),2) }}" required>
        </div>
        <div class="form-group btn-group">
            <input type="submit" name="submit" value="Save Configuration" class="btn btn-success ">
            <input type="reset" name="reset" value="Reset" class="btn btn-primary ">
        </div>
    </div>
</div>
</form>