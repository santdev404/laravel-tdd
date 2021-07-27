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

        if( auth()->user()->isNot($project->owner)){
            abort(403);
        }

        return view('projects.show', compact('project'));


    }

    public function create(){
        return view('projects.create');
    }

    public function store(){

        

        //validate

        // $attributes['owner_id'] = auth()->id();

        auth()->user()->projects()->create(request()->validate(['title'=>'required', 'description'=>'required']));

        //persist

        

        //redirect

        return redirect('/projects');

    }

}
