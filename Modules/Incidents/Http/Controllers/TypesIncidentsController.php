<?php

namespace Modules\Incidents\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Incidents\Entities\TypesIncident;
use Modules\Incidents\Repositories\IncidentsRepository;  
use Modules\Incidents\Repositories\TypeIncidentsRepository;
use Modules\Incidents\Http\Requests\TypeIncidentsSaveRequest;
use View;

class TypesIncidentsController extends Controller
{

    public function __construct() 
    {
        $this->incident_repository = new IncidentsRepository();
        $this->type_incident_repository = new TypeIncidentsRepository();
        View::share ( 'criticality', $this->incident_repository->getCriticality() );
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tp_incidents = $this->type_incident_repository->getTypesIncidentsPaginate(); //dd($tp_incidents);
        return view('incidents::types_incidents', compact('tp_incidents'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('incidents::create_type');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TypeIncidentsSaveRequest $request)
    {
        $data = $request->all(); 
        if( $this->type_incident_repository->save($data) )
        {
            alert()->success('Item criado com sucesso','');
        }else{
            alert()->warning('Ocorreu um erro, tente novamente','');
        }
        return response()->redirectToRoute('tp_incidents.index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->type_incident_repository->edit($id); 
        return view('incidents::edit_type',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $data = $request->all(); 
        if( $this->type_incident_repository->update($data) )
        {
            alert()->success('Item criado com sucesso','');
        }else{
            alert()->warning('Ocorreu um erro, tente novamente','');
        }
        return response()->redirectToRoute('tp_incidents.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all(); 
        if (TypesIncident::findOrFail($data['id'])->delete() ) {
            $message = ['msg' => 'Item deletado', 'delete'=>1];
        } else {
            $message = ['msg' => 'O item não foi deletado!!!', 'delete'=>0];
        }
        return $message;
    }
}
