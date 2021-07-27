<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
    
    
    <form method="POST" action="/projects" class="container" style="padding-top: 40px">

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
            </div>
        </div>



        
    </form>

</body>
</html>