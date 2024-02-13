<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $table = 'storage';
    protected $fillable = ['id', 'kode_storage', 'user_id', 'nama', 'kategori_id', 'tanggal', 'deskripsi', 'file', 'size'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function getFile()
    {
        if (!$this->file) {
            return asset('file/default.png');
        }
        return asset('file/' . $this->file);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
