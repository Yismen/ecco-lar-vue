<form action="/tasks" method="POST" role="form">
    {{ csrf_field() }}
    
    <legend>Create New Task</legend>

    <div class="form-group">
        <label for="">Task:</label>
        <input type="text" class="form-control" id="" placeholder="Input field">
    </div>

    

    <button type="submit" class="btn btn-primary">SAVE</button>
</form>