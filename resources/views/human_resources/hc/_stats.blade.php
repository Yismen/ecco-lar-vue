
<div class="row">
    {{-- By Status --}}
    <div class="col-lg-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <headcount-by-status
                            :info="{{ collect($stats['headcounts']['by_status']) }}"
                        ></headcount-by-status>
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
                        <headcount-by-site
                            :info="{{ $stats['headcounts']['by_site'] }}"
                        ></headcount-by-site>
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
                            <headcount-by-gender
                                :info="{{ $genders }}"
                                site="{{ $site }}"
                            ></headcount-by-gender>
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
                            <headcount-by-department
                                :info="{{ $departments }}"
                                site="{{ $site }}"
                            ></headcount-by-department>
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
                            <headcount-by-project
                                :info="{{ $projects }}"
                                site="{{ $site }}"
                            ></headcount-by-project>
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
                            <headcount-by-supervisor
                                :info="{{ $supervisors }}"
                                site="{{ $site }}"
                            ></headcount-by-supervisor>
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
                            <headcount-by-position
                                :info="{{ $positions }}"
                                site="{{ $site }}"
                            ></headcount-by-position>
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
                            <headcount-by-nationality
                                :info="{{ $nationalities }}"
                                site="{{ $site }}"
                            ></headcount-by-nationality>
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
