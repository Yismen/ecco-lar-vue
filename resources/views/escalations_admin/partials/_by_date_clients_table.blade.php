@if(isset($clients))
    <div class="col-sm-6">

        <div class="box box-success">
            <h3>Count By Clients</h3>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Client:</th>
                            <th>Count:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->escal_records_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Total:</th>
                        <th>{{ $clients->sum('escal_records_count') }}</th>
                    </tfoot>
                </table>
            </div>

            {{-- <canvas id="clientsChart" height="100%" width="60px"></canvas> --}}
        </div>

    </div>
@endif