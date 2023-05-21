<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'thumbnail_path'
    ];

    /**
     * Get the user who uploaded the image.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
