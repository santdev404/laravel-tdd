
@extends ('layouts.app')

@section('content')
    
    
    <form method="POST" action="/projects" >

        @csrf

        <h1 class="haeding is-1">Create a project</h1>

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="">
            </div>
        </div>
            
        <div class="field">

            <label class="label" for="description">Description</label>

            <div class="control">
                <textarea  class="textarea" name="description" ></textarea>
            </div>

        </div>


        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link" >Create project</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>



        
    </form>

@endsection