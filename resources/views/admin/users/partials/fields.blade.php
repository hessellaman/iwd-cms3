{{ csrf_field() }}

@if (!$errors->isEmpty())

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
    
        <li>{{$message}}</li>

        @endforeach
    </ul>

</div>

@endif

<!-- Toon de velden die gebruikt worden voor het maken/bewerken van een pagina -->
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" 
        name="title" value="{{$model->title}}" />
</div>
<div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" 
        name="url" value="{{$model->url}}" />
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content">{{$model->content}}</textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit" />
</div>