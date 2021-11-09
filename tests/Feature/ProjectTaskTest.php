<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks(){

        $project = ProjectFactory::ownedBy($this->signIn())->create();

        $this->post($project->path().'/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');
        
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks(){

        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);

    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task(){

        $project= ProjectFactory::withTasks(1)->create();

        $this->signIn();

        $this->patch($project->tasks->first()->path(), ['body' => 'changed'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);

    }

    /** @test */
    public function a_task_require_a_body(){

        $project = ProjectFactory::ownedBy($this->signIn())->create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }


    /** @test*/
    public function a_task_can_be_updated(){

        $project = ProjectFactory::withTasks(1)->create();
        //$project = factory(Project::class)->create();


        $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
        ]);

        $this->assertDatabaseHas('tasks', [
            'body'  => 'changed',
        ]);
    }

    /** @test*/
    public function a_task_can_be_completed(){

        $project = ProjectFactory::withTasks(1)->create();
        //$project = factory(Project::class)->create();


        $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body'  => 'changed',
            'completed' => true
        ]);
    }

    /** @test*/
    public function a_task_can_be_marked_as_incompleted(){

        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();
        //$project = factory(Project::class)->create();


        $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body'  => 'changed',
            'completed' => false
        ]);
    }
}
