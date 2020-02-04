@if ($employee->changes->count() > 0)
    <div class="table-responsive">
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>Changes (Latest {{ $employee->changes->count() }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employee->changes as $change)
                    <tr>
                        <td>
                            @php
                                $after = json_decode($change->after);
                            @endphp
                            On {{ $change->updated_at->format('d/M/Y') }}, {{ $change->user->name }} Changed:
                            <ul>
                                @foreach (json_decode($change->before) as $key => $value)
                                <li>
                                    Field {{ $key }}, 
                                    from <span class="text-blue">{{ $value }}</span> 
                                    to <span class="text-green">{{ collect($after->$key)->first() }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
@endif
