<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class perubahandaya_model extends Model
{
    protected $table = 'pasang_baru';
    public $timestamps = true;
    
    protected $fillable = [
        'id_pemohon','sifat_instalasi', 'daya_baru','daya_lama', 'biaya',
        'ujl','slo','gil','ppn','ppj','materai','total'
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