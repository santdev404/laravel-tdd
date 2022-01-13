<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;



class ProjectsController extends Controller
{
    public function index(){

        // $projects = Project::all();
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project){

        $this->authorize('update', $project);

        return view('projects.show', compact('project'));


    }

    public function create(){
        return view('projects.create');
    }

    public function store(){


        $attributes = $this->validateRequest();

        $project = auth()->user()->projects()->create($attributes);
        

        //redirect

        return redirect($project->path());

    }

    public function update(UpdateProjectRequest $request){

        
        //$project->update($request->validated());
        $request->save();

        return redirect($request->project()->path());
    }


    public function edit(Project $project){

        return view('projects.edit',compact('project'));

    }

    public function destroy(Project $project){

        $this->authorize('update', $project);

        $project->delete();

        return redirect('/projects');
    }

    protected function validateRequest(){

        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);

    }

}
