@if (Session::has('data') && count(Session('data')) > 0)
    <div class="col-sm-6">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Data imported!</strong>
        </div>
    </div>
@endif

@if (Session::has('errors') && count(Session::get('Errors')) > 0)
    <div class="col-sm-6">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach (Session('errors')->toArray() as $error)
                    <li>{{ $error[0] }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif