<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume_panel_antiphrase extends Model
{
    protected $table = 'resume_panel_data_antiphrase';
    
	protected $fillable = ['resume_id', 'user_id', 'phrase', 'skill', 'skill_type'];
}
