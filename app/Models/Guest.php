<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GuestGroup;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'guest_group_id',
        'name',
        'email',
        'wishes_icon_type',
        'invitation_url',
        'max_attendance',
        'number_of_attendance',
        'wishes',
        'is_show_wishes',
        'is_attend'
    ];

    public function guestGroup() {
        return $this->belongsTo(GuestGroup::class);
    }
}
