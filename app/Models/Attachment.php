<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'path',
        'disk',
        'size',
    ];

    protected $appends = ['url'];

    /**
     * アクセス可能なURLを生成
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return Storage::disk($this->attributes['disk'])->url($this->attributes['path']);
    }
}
