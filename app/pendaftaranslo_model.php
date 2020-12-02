<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pendaftaranslo_model extends Model
{
    protected $table = 'pendaftaran_slo';
    public $timestamps = true;
    
    protected $fillable = [
		'nama_konsumen', 'ktp','alamat', 'provinsi','kabupaten','telp','email','instalasi','daya','dayalama','djklama','badan_usaha','tanggal_daftar','tanggal_approve'
    ];
    
    public static function getkonsumenData($id=0){
        if($id==0){
          $value=DB::table('pendaftaran_slo')->orderBy('id', 'asc')->get(); 
        }else{
          $value=DB::table('pendaftaran_slo')->where('id', $id)->first();
        }
        return $value;
      }

    public static function getdaftarsloData($id=0){

        if($id==0){
          $value=DB::table('pendaftaran_slo')->orderBy('id', 'asc')->get(); 
        }else{
          $value=DB::table('pendaftaran_slo')->where('id', $id)->first();
        }
        return $value;
    }

    public static function insertData($data){
        DB::table('pendaftaran_slo')->insert($data);
        return 1;
    }

    // kode_transaksi
    public function semua()
    {
        $query = DB::table('pendaftaran_slo')
            ->select('pendaftaran_slo.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }

     // kode_transaksi
    public function status_pemesanan($status_pemesanan)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('pendaftaran_slo.*')
            ->where('pendaftaran_slo.status',$status_pemesanan)
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }

    // nomor_akhir
    public function nomor_akhir()
    {
    	$query = DB::table('pendaftaran_slo')
            ->select('*')
            ->orderBy('id','DESC')
            ->first();
        return $query;
    }

    // nomor_akhir
    public function nomor_akhir_tanggal($tanggal_order)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('*')
            ->where('tanggal_trx',$tanggal_order)
            ->orderBy('id','DESC')
            ->first();
        return $query;
    }
}
