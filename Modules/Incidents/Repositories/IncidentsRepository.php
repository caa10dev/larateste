<?php

namespace Modules\Incidents\Repositories;

use Modules\Incidents\Entities\TypesIncident;
use Modules\Incidents\Entities\Incident;

class IncidentsRepository 
{
	public function getTypesIncidents()
	{
		return TypesIncident::pluck('title','id');
	}

	public function getIncidents()
	{
		return Incident::paginate(8);
	}

	public function save(array $data=[])
	{
		return Incident::create($data);
	}

	public function edit($id)
	{
		return Incident::findOrFail($id);
	}

	public function update(array $data=[])
	{
		$id = $data['id'];
		unset($data['id']); 
		return Incident::find($id)->update($data);
	}

	public function getCriticality()
	{
		$criticality=[
			0=>'Baixa',
			1=>'Média',
			2=>'Alta'
		];
		return $criticality;
	}
	
}
