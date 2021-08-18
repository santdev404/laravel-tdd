
@extends ('layouts.app')

@section('content')


    <header class="flex items-center mb-3 py-4">

        <div class="flex justify-between items-center w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My projects </a> / {{$project->title}}</p>
            <a href="/projects/create" class="button">Create a new project</a>
        </div>
        

    </header>

    <main>
        <div class="flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">

                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Task</h2>
                    {{-- task --}}

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">{{$task->body}}</div>
                    @endforeach

                    <form action="{{ $project->path() . '/tasks'}}" method="POST">
                        @csrf
                        <div class="card mb-3"><input placeholder="Begin adding task" class="w-full" name="body"></div>
                    </form>

                </div>

                <div>
                    
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    {{-- general notes --}}
                    <textarea class="card w-full" style="min-height: 200px">Lorem ipsum</textarea>
                </div>


            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
        


@endsection