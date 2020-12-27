<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cekstatus_model extends Model
{
    protected $table = 'instalasi';
    public $timestamps = true;
    
    public function semua()
    {
        $query = DB::table('instalasi')
            ->select('instalasi.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}