<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_a_project(){
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    function updating_a_project(){

        $project = ProjectFactory::create();
        $project->update(['title' => 'Changed']);
        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);


    }

    /** @test */
    function creating_a_new_task(){
        $project = ProjectFactory::create();
        $project->addTask('Some task');
        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function ($activity){
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->assertEquals('Some task', $activity->subject->body);

        });

    }

    /** @test */
    function completing_a_task(){
        
        $project = ProjectFactory::withTasks(1)->create();
        
        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(),[
                'body' => 'footbar',
                'completed' => true
            ]);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);

    }

        /** @test */
        function incompleting_a_task(){
        
            $project = ProjectFactory::withTasks(1)->create();
            
            $this->actingAs($project->owner)
                ->patch($project->tasks[0]->path(),[
                    'body' => 'footbar',
                    'completed' => true
                ]);
            
            $this->assertCount(3, $project->activity);

            $this->patch($project->tasks[0]->path(),[
                'body' => 'footbar',
                'completed' => false
            ]);

            //dd($project->fresh()->activity->toArray());

            $project->refresh();

    
            $this->assertCount(4, $project->activity);

            $this->assertEquals('incompleted_task', $project->activity->last()->description);
    
        }

        /** @test */
        function deleting_a_task(){

            $project = ProjectFactory::withTasks(1)->create();

            $project->tasks[0]->delete();

            $this->assertCount(3, $project->activity);


        }

}