<?php

/**
 * author : Suryo Atmojo <suryoatm@gmail.com>
 * project : supresso Laravel
 * Start-date : 19-09-2022
 */
/**
 “Barangsiapa yang memberi kemudharatan kepada seorang muslim, 
 maka Allah akan memberi kemudharatan kepadanya, 
 barangsiapa yang merepotkan (menyusahkan) seorang muslim 
 maka Allah akan menyusahkan dia.”
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_model extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'title',
        'short_desc',
        'text',
        'type',
        'image',
        'video',
        'quote_text',
        'quote_author',
        'author',
        'slug',
        'status',
        'images_code',
        'order',
        'category_id'
    ];
}