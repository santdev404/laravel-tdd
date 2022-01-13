
<div class="card" style="height: 200px">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
        <a href="{{$project->path()}}" class="text-black no-underline">{{$project->title}}</a>
        
    </h3>
    <div class="text-grey mb-4">{{ str_limit($project->description, 100)}}</div>


    <footer>
        <form method="POST" action="{{$project->path()}}" class="text-right">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-xc">Delete</button>
        </form>
    </footer>
</div>
