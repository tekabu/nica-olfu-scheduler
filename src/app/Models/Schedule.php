<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $appends = ['started_date', 'ended_date', 'completed_date'];

    public function getStartedDateAttribute()
    {
        return date('M. d, Y', strtotime($this->started_at));
    }
    public function getEndedDateAttribute()
    {
        return date('M. d, Y', strtotime($this->ended_at));
    }
    public function getCompletedDateAttribute()
    {
        if ($this->completed_at === null) {
            return null;
        }
        return date('M. d, Y', strtotime($this->completed_at));
    }
}
