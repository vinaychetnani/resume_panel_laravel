<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume_panel_vn extends Model
{
    protected $table = 'resume_panel_data_vn';
    
	protected $fillable = ['resume_id', 'user_id', 'verb', 'noun', 'skill_type', 'skill', 'action'];

}
