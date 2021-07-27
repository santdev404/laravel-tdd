@extends ('layouts.app')

@section('content')
    
    <div class="flex items-center">

        
        <a href="/projects/create">Create a new project</a>

    </div>

    <ul>
    @forelse ($projects as $project)
        <li>
            
            <a href="{{$project->path()}}">{{$project->title}}</a> 
        </li>

    @empty

        <li>No project yet</li>    

    @endforelse
    </ul>

@endsection