<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function a_user_can_create_a_project(){

        $attibutes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph

        ];

        $this->post('/projects', $attibutes);

        $this->assertDatabaseHas('projects', $attibutes);

    }
}
