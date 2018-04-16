<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Count</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resource as $date)
            <tr>
                <td>{{ $date->date }}</td>
                <td>{{ $date->count }}</td>
                <td>                            
                    {!! Form::open(['url'=>[$route, $date->date], 'method'=>'DELETE']) !!}
                        
                        <button name="deleteBtn" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Del</button>
                        
                    {!! Form::close() !!}
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $resource->render() }}