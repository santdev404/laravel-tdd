<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;


class ProjectTasksController extends Controller
{

    /**
     * Add a task to the given project
     * 
     * @param Project $project
     * @return Illuminate\Http\RedirectResponse
     * @throws Illuminate\Auth\AccessAuthorizationException
     */

    public function store(Project $project){

        $this->authorize('update', $project);
        
        // if(auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }


    public function update(Project $project, Task $task){

        $this->authorize('update', $task->project);
        // if(auth()->user()->isNot($task->project->owner)){
        //     abort(403);
        // }
        
        request()->validate(['body' => 'required']);

        $task->update([
            'body'=>request('body'),
            'completed'=>request()->has('completed')
        ]);

        return redirect($project->path());

    }
}
