<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'option_id',
        'user_id',
        'voter_ip',
    ];

    /**
     * Get the poll that owns the vote.
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    /**
     * Get the option selected in this vote.
     */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    /**
     * Get the user who voted (nullable).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
