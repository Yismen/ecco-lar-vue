<h4>{{ $title }}</h4>
<div class="table-responsive no-padding" 
        style="height: 200px; background-color: white; padding: 3px; box-shadow: gray -1px 1px 4px 0px;">
    @if ($employees->count() > 0)
        <table class="table table-hover table-condensed table-striped">
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>
                            <a href="{{ route('admin.attendances.employee', $employee->employee->id) }}" title="See details for this employee!">{{ $employee->employee->full_name }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">0</h1>
    @endif
</div>
    