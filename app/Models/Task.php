<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use Searchable;

    protected $primaryKey = 'id_task';
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'project_id', 
        'member_id', 
    ];

    public function project(){
        return $this->belongsTo(Board::class, 'project_id', 'id_projet');
    }

    public function assignedMember(){
        return $this->belongsTo(Member::class, 'member_id', 'id_member');
    }

    public function isUrgent(){
    
        return $this->due_date && \Carbon\Carbon::parse($this->due_date)->isToday()
        || \Carbon\Carbon::parse($this->due_date)->isPast();
    }
    public function toSearchableArray()
    {
        return [
            'type' => 'task',
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

}
