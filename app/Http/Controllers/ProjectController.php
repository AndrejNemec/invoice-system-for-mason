<?php

namespace App\Http\Controllers;

use App;
use App\Catalog;
use App\Http\Requests\SaveProjectItemRequest;
use App\Http\Requests\SaveProjectRequest;
use App\Http\Resources\ProjectGroupResource;
use App\Project;
use App\ProjectItem;
use PDF;
use Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $projects = Project::all();

        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProjectRequest $request)
    {
        $project = Project::create($request->all());
        return redirect()->route('project.show', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type = '1')
    {
        $project = Project::findOrFail($id);
        $catalogs = Catalog::all();
        //return $project->groupItems;
        return view('project.show')->with('project', $project)->with('catalogs', $catalogs)->with('type', $type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('project.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProjectRequest $request, $id)
    {


        $project = Project::findOrFail($id);

        $project->update($request->all());

        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        ProjectItem::where('project_id', $id)->delete();

        $project->delete();

        return redirect(url()->previous());
    }

    public function invoice($id, $type)
    {
        $project = Project::findOrFail($id);

        $project->invoice_number = Request::input('invoice_number');
        $project->purchaser = Request::input('purchaser');
        $project->date_of_issue = Request::input('date_of_issue');
        $project->due_date = Request::input('due_date');

        $project->save();

        $data = [
            'invoice_number' => $project->invoice_number,
            'purchaser' => $project->purchaser,
            'date_of_issue' => $project->date_of_issue,
            'due_date' => $project->due_date,
            'type' => $type,

        ];

        switch ($type) {
            case 1:
                $data['table'] = $project->groupItems;
                break;
            case 2:
                $data['table'] = $project->groups;
                break;
            default: redirect(url()->previous());
        }

        $pdf = PDF::loadView('project.invoice', $data);

        return $pdf->stream('faktura.pdf');
    }
}
