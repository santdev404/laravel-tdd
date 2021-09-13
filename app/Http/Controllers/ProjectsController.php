<?php

namespace App\Http\Controllers;

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

        

        //validate

        // $attributes['owner_id'] = auth()->id();

        //auth()->user()->projects()->create(request()->validate(['title'=>'required', 'description'=>'required']));

        //persist
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);
        

        $project = auth()->user()->projects()->create($attributes);
        

        //redirect

        return redirect($project->path());

    }

    public function update(Project $project){

        $this->authorize('update', $project);

        // if( auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }

        // $project->update([
        //     'notes'=>request('notes')
        // ]);

        $project->update(request(['notes']));

        return redirect($project->path());
    }

}
