<?php

namespace Modules\Incidents\Entities;

use Illuminate\Database\Eloquent\Model;


class Incident extends Model{

    protected $fillable = [
    	'title',
    	'description',
			'criticality',
			'type_id',
			'status'
    ];

	
}
