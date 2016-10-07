<div class="table-responsive">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Week</th>
                <th>Date</th>
                <th>Source</th>
                <th>Client</th>
                <th>Production Hours</th>
                <th>Prod. Downtime</th>
                <th>Records</th>
                <th>TP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productions as $production)
                <tr>
                    <td>{{ $production->year }}</td>
                    <td>{{ $production->month }}</td>
                    <td>{{ $production->week }}</td>
                    <td>
                        <a href="{{ route('admin.productions.show', $production->insert_date) }}">
                            {{ $production->insert_date }}
                        </a>                        
                    </td>
                    <td>{{ $production->source->name }}</td>
                    <td>{{ $production->client->name }}</td>
                    <td>{{ $production->production_hours }}</td>
                    <td>{{ $production->downtime }}</td>
                    <td>{{ number_format($production->production ) }}</td>
                    <td>{{ number_format($production->production / $production->production_hours, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" text-align="right">Totals</th>
                <th>{{ $productions->sum('production_hours') }}</th>
                <th>{{ $productions->sum('downtime') }}</th>
                <th>{{ number_format($productions->sum('production')) }}</th>
                <th>{{ number_format($productions->sum('production') / $productions->sum('production_hours'), 2, ".", ",") }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="text-center">
    {{ $productions->render() }}
</div>