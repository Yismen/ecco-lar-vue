<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" 
    style="position: fixed; z-index: 1020; right: 35%; top: 10%;">
    Filter Results <i class="fa fa-caret-down"></i>
</button>

<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="GET"class="form-inlined">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Apply Filters</h4>
                </div>

                <div class="modal-body">
                    <div class="col-xs-6 col-lg-4">
                        <div class=form-group>
                            <label for="">Site</label>
                            <select name="site[]" id="" class="form-control" multiple size="10">
                                <option value="%">All</option>
                                @foreach ($sites as $site)
                                <option value="{{ $site->name }}"
                                    {{ in_array($site->name, old('site', [])) ? 'selected' : '' }}
                                >{{ $site->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- /.col --}}
                    <div class="col-xs-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Project</label>
                            <select name="project[]" id="" class="form-control" multiple size="10">
                                <option value="%">All</option>
                                @foreach ($projects as $project)
                                <option value="{{ $project->name }}"
                                    {{ in_array($project->name, old('project', [])) ? 'selected' : '' }}
                                >{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                    {{-- /.col                   --}}
                    <div class="col-xs-6 col-lg-4">
                        <div class="form-group">
                            <label for="">Departments</label>
                            <select name="department[]" id="" class="form-control" multiple size="10">
                                <option value="%">All</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->name }}"
                                    {{ in_array($department->name, old('department', [])) ? 'selected' : '' }}
                                >{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                    {{-- /.col                   --}}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        Apply 
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>