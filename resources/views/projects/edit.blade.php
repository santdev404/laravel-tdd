
@extends ('layouts.app')

@section('content')
    
    
    <form method="POST" action="{{$project->path()}}" >

        @csrf
        @method('PATCH')

        <h1 class="haeding is-1">Edit your project</h1>

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="" value="{{$project->title}}">
            </div>
        </div>
            
        <div class="field">

            <label class="label" for="description">Description</label>

            <div class="control">
                <textarea  class="textarea" name="description" >{{$project->description}}</textarea>
            </div>

        </div>


        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link" >Edit project</button>
                <a href="{{$project->path()}}">Cancel</a>
            </div>
        </div>



        
    </form>

@endsection