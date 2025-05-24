<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;


class Board extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'boards';
    protected $primaryKey = 'id_projet';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'title_projet',
        'description_projet',
        'budget',
        'delai',
        'user_id',
    ];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function members(){
        return $this->belongsToMany(Member::class, 'board_member', 'project_id', 'member_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id_projet');
    }

    public function toSearchableArray()
    {
        return [
            'type' => 'board',
            'title' => $this->title_projet,
            'description' => $this->description_projet,
        ];
    }
}