@extends ('layouts.app')

@section('content')
    
    <div class="flex items-center">

        
        <a href="/projects/create">Create a new project</a>

    </div>

    <div class="flex">
        @forelse ($projects as $project)
        <div class="bg-white mr-4 p-5 rounded shadow w-1/3" style="height: 200px">
            <h3 class="font-normal text-xl py-4">{{$project->title}}</h3>
            <div class="text-grey">{{ str_limit($project->description, 100)}}</div>
        </div>
        @empty
            <li>No project yet</li>  s
        @endforelse
    </div>


@endsection