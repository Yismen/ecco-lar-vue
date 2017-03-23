@if(isset($users))
    <div class="col-sm-6">
                
        <div class="box box-warning">
            <h3>Count By Users</h3>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Client:</th>
                            <th>Count:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->escalations_records_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Total:</th>
                        <th>{{ $users->sum('escalations_records_count') }}</th>
                    </tfoot>
                </table>
            </div>
        </div>
        
    </div>
@endif