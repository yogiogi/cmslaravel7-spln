<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengaduanteknis_model extends Model
{
    protected $table = 'pengaduan_teknis';
    public $timestamps = true;
    
    protected $fillable = [
        'id_pemohon', 'keterangan','biaya', 'status'
    ];

    public static function insertData($data){
        DB::table('pengaduan_teknis')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('pengaduan_teknis')
            ->select('pengaduan_teknis.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}