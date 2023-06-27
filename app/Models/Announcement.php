<?php

namespace App\Models;

use App\Events\AnnouncementCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
      'created'=> AnnouncementCreated::class
    ];
}
