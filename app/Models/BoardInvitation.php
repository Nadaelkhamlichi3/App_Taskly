<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardInvitation extends Model
{
    use HasFactory;

    protected $table = 'project_invitations';

    protected $fillable = [
        'board_id',
        'email',
        'name',
        'role',
        'token',
    ];

    public function project(){
        return $this->belongsTo(Board::class, 'board_id', 'id_projet');
    }

    public static function generateToken()
    {
        return bin2hex(random_bytes(16));
    }
}