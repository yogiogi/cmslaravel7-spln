<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penyambungansementara_model extends Model
{
    protected $table = 'penyambungan_sementara';
    public $timestamps = true;
    
    protected $fillable = [
		'id_pemohon', 'jam_nyala','hari_nyala', 'biaya','ppn','ppj','materai','total'
    ];

    public static function insertData($data){
        DB::table('penyambungan_sementara')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('penyambungan_sementara')
            ->select('penyambungan_sementara.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}