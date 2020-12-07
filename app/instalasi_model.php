<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Instalasi_model extends Model
{
    protected $table = 'instalasi';
    public $timestamps = true;
    
    protected $fillable = [
		'id_pemohon', 'biaya','titik_lampu', 'titik_saklar','titik_stop_kontak','ppn','ppj','materai','total'
    ];

    public static function insertData($data){
        DB::table('instalasi')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('instalasi')
            ->select('instalasi.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}