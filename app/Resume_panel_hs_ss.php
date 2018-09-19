<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume_panel_hs_ss extends Model
{
    protected $table = 'resume_panel_data_hs_ss';
    
	protected $fillable = ['resume_id', 'user_id', 'hs', 'ss'];
}
