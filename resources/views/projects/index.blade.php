@extends ('layouts.app')

@section('content')
    
    <header class="flex items-center mb-3 py-4">

        <div class="flex justify-between items-center w-full">
            <h2 class="text-grey text-sm font-normal">My projects</h2>
            <a href="/projects/create" class="button">Create a new project</a>
        </div>
        

    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
        <div class="lg:w-1/3 px-4 pb-6">
            <div class="bg-white  p-5 rounded-lg shadow" style="height: 200px">
            <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
                <a href="{{$project->path()}}" class="text-black no-underline">{{$project->title}}</a>
                
            </h3>
            <div class="text-grey">{{ str_limit($project->description, 100)}}</div>
        </div>
        </div>

        @empty
            <li>No project yet</li>
        @endforelse
    </main>


@endsection