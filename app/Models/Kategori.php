<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kategori';
    protected $guarded = ['id_kategori'];
    public function kerjasama()
    {
        return $this->hasOne(Kerjasama::class, 'id_kategori');
    }
    public function post()
    {
        return $this->hasOne(Post::class, 'id_kategori');
    }
}
