<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'title',
        'content',
        'published_at',
        'link_url', // Menggunakan nama kolom yang disepakati
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime', // Wajib untuk pemfilteran Carbon
        'is_published' => 'boolean',
    ];

    // Accessor untuk membuat ringkasan (excerpt)
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 100, '...');
    }

    // Accessor untuk format tanggal yang indah (digunakan di View)
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->isoFormat('D MMMM YYYY') : 'Belum Dipublikasikan';
    }
}
