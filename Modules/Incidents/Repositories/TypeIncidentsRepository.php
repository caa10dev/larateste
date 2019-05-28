<?php

namespace Modules\Incidents\Repositories;

use Modules\Incidents\Entities\TypesIncident;

class TypeIncidentsRepository 
{
	public function getTypesIncidents()
	{
		return TypesIncident::pluck('title','id');
	}

	public function getTypesIncidentsPaginate()
	{
		return TypesIncident::paginate(8);;
	}

	public function save(array $data=[])
	{ 
		return TypesIncident::create($data);
	}

	public function edit($id)
	{
		return TypesIncident::findOrFail($id);
	}

	public function update(array $data=[])
	{
		$id = $data['id'];
		unset($data['id']); 
		return TypesIncident::find($id)->update($data);
	}
}
