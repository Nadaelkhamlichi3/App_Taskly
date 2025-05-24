<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Member extends Model
{
    use HasFactory;
    use Searchable;

    protected $primaryKey = 'id_member';

    protected $fillable = [
        'name',
        'email',
        'role', // rôle global ou d'inscription
    ];

    public $timestamps = true;

    public function boards(){
        return $this->belongsToMany(Board::class, 'board_member', 'member_id', 'project_id');
    }

    public function toSearchableArray()
    {
        return [
            'type' => 'member',
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];
    }
}
