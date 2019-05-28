<?php

namespace Modules\Incidents\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Incidents\Entities\Incident;
use Modules\Incidents\Repositories\IncidentsRepository;
use Modules\Incidents\Http\Requests\IncidentsSaveRequest;
use View;

class IncidentsController extends Controller
{

    public function __construct() 
    {
        $this->incident_repository = new IncidentsRepository();
        View::share ( 'types_incidents', $this->incident_repository->getTypesIncidents() ); 
        View::share ( 'criticality', $this->incident_repository->getCriticality() );
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $incidents = $this->incident_repository->getIncidents(); 
        return view('incidents::index',compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('incidents::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(IncidentsSaveRequest $request)
    {
        $data = $request->all(); 
        if( $this->incident_repository->save($data) )
        {
            alert()->success('Item criado com sucesso','');
        }else{
            alert()->warning('Ocorreu um erro, tente novamente','');
        }
        return response()->redirectToRoute('incidents.create');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->incident_repository->edit($id); 
        return view('incidents::edit',compact('data'));
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
        if( $this->incident_repository->update($data) )
        {
            alert()->success('Item criado com sucesso','');
        }else{
            alert()->warning('Ocorreu um erro, tente novamente','');
        }
        return response()->redirectToRoute('incidents.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all(); 
        if (Incident::findOrFail($data['id'])->delete() ) {
            $message = ['msg' => 'Item deletado', 'delete'=>1];
        } else {
            $message = ['msg' => 'O item não foi deletado!!!', 'delete'=>0];
        }
        return $message;
    }
}
