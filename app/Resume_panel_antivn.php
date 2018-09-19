<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume_panel_antivn extends Model
{
    protected $table = 'resume_panel_data_antivn';
    
	protected $fillable = ['resume_id', 'user_id', 'verb', 'noun', 'competency'];
}
