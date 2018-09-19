<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume_panel_phrase extends Model
{
    protected $table = 'resume_panel_data_phrase';
    
	protected $fillable = ['resume_id', 'user_id', 'phrase', 'phrase_type', 'sub_type', 'competency', 'action'];
}
