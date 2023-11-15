<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title','cover','genre_id','release_date','developer_id','description','price','platform_id'];

    public $timestamps = false;


    public function genre()
    {
        return $this->belongsTo(Genre::class);
        
    }

    public function developer(){
        return $this->belongsTo(Developer::class);
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
        
    }

}