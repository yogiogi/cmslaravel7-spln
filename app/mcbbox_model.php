<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class mcbbox_model extends Model
{
    protected $table = 'mcb_box';
    public $timestamps = true;
    
    protected $fillable = [
		'id_pemohon', 'biaya','grup_mcb', 'ppn','ppj','materai','total'
    ];

    public static function insertData($data){
        DB::table('mcb_box')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('mcb_box')
            ->select('mcb_box.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}