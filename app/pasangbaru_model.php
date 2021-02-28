<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

    class pasangbaru_model extends Model
{
    protected $table = 'pasang_baru';
    public $timestamps = true;
    
    protected $fillable = [
		'nama_konsumen', 'ktp', 'alamat', 'provinsi', 'kabupaten', 'telp', 'whatsapp', 'email','sifat_instalasi','biaya', 'daya','slo','gil','ujl','ppn','ppj','token','materai','total'
    ];

    public static function insertData($data){
        DB::table('pasang_baru')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('pasang_baru')
            ->select('pasang_baru.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }


}