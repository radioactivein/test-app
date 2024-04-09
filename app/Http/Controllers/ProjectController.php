<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    protected $project;
    public function __construct(){
        $this->project = new Project();
    }

    public function index()
    {
        return $this->project->all();
    }

    public function store(Request $request)
    {
        // dd($request);
        return $this->project->create($request->all());
    }

    public function show(string $id)
    {
        $project = $this->project->find($id);
    }

    public function update(Request $request, string $id)
    {
        $project = $this->project->find($id);
        $project->update($request->all());
        return $project;
    }

    public function destroy(string $id)
    {
        $project = $this->project->find($id);
        return $project->delete();
    }
}
