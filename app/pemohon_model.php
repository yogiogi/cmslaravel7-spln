<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pemohon_model extends Model
{
    protected $table = 'pemohon_layanan';
    public $timestamps = true;
    
    protected $fillable = [
        'nama_konsumen', 'ktp','alamat', 'provinsi','kabupaten','telp','email'
    ];
    
    public static function insertData($data){
        $id = DB::table('pemohon_layanan')->insertGetId(array(
            $data
        ));
        return $id;
    }

    // kode_transaksi
    public function layanan()
    {
        $query = DB::table('pemohon_layanan')
            ->select('pemohon_layanan.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}