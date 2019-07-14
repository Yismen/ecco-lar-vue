
<div class="row">
    {{-- By Status --}}
    <div class="col-lg-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <hc-rotations
                            :hires="{{ $stats['headcounts']['by_status']['actives'] }}"
                            :terminations="{{ $stats['headcounts']['by_status']['inactives']}}"
                            title="HC By Status "
                            go-to-route="{{ route('admin.human_resources.index') }}"
                        ></hc-rotations>
                    </div>
                    <div class="box-footer">
                        <a href="#" title="View Details by Status"
                        target="_employees_">
                            <i class="fa fa-eye"></i> Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- By Site --}}
    <div class="col-lg-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <headcounts
                            :info="{{ $stats['headcounts']['by_site'] }}"
                            title="HC By Site"
                            :colorset="{{ json_encode(["rgba(33,150,243,1)", "rgba(255,193,7,1)"]) }}"
                        ></headcounts>
                    </div>
                    <div class="box-footer">
                        <a href="/admin/sites" title="View Details by Site"
                        target="_employees_">
                            <i class="fa fa-eye"></i> Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- .by-gender --}}
    @foreach ($stats['headcounts']['by_gender'] as $site => $genders)
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <headcounts
                                :info="{{ $genders }}"
                                title="HC By Genders: {{ $site }}"
                                :colorset="{{ json_encode(["rgba(233,30,99 ,1)", "rgba(21,101,192 ,1)"]) }}"
                            ></headcounts>
                        </div>
                        <div class="box-footer">
                            <a href="/admin/human_resources/head_count/by_gender" title="View Details by Gender"
                            target="_employees_">
                                <i class="fa fa-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- By Department --}}
    @foreach ($stats['headcounts']['by_department'] as $site => $departments)
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <headcounts
                                :info="{{ $departments }}"
                                title="HC By Depts.: {{ $site }}"
                                :sort-data="true"
                            ></headcounts>
                        </div>
                        <div class="box-footer">
                            <a href="/admin/departments" title="View Details by Departments"
                            target="_employees_">
                                <i class="fa fa-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- .by-project --}}
    @foreach ($stats['headcounts']['by_project'] as $site => $projects)
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <headcounts
                                :info="{{ $projects }}"
                                title="HC By Projects: {{ $site }}"
                                :sort-data="true"
                            ></headcounts>
                        </div>
                        <div class="box-footer">
                            <a href="/admin/projects" title="View Details by Project"
                            target="_employees_">
                                <i class="fa fa-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- .by-supervisors --}}
    @foreach ($stats['headcounts']['by_supervisor'] as $site => $supervisors)
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <headcounts
                                :info="{{ $supervisors }}"
                                title="HC Supervisors: {{ $site }}"
                                :sort-data="true"
                            ></headcounts>
                        </div>
                        <div class="box-footer">
                            <a href="/admin/supervisors" title="View Details by Supervisor"
                            target="_employees_">
                                <i class="fa fa-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- .by-positions --}}
    @foreach ($stats['headcounts']['by_position'] as $site => $positions)
        <div class="col-lg-6">
             <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <headcounts
                                :info="{{ $positions }}"
                                title="HC Positions: {{ $site }}"
                                :sort-data="true"
                            ></headcounts>
                        </div>
                        <div class="box-footer">
                            <a href="/admin/positions" title="View Details by Position"
                            target="_employees_">
                                <i class="fa fa-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- .by-nationality --}}
    @foreach ($stats['headcounts']['by_nationality'] as $site => $nationalities)
        <div class="col-lg-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <headcounts
                                :info="{{ $nationalities }}"
                                title="HC By Nation: {{ $site }}"
                                :sort-data="true"
                            ></headcounts>
                        </div>
                        <div class="box-footer">
                            <a href="/admin/nationalities" title="View Details by Nationality"
                            target="_employees_">
                                <i class="fa fa-eye"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
