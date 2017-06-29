<style>
    ._PersonalSettings {
        color: #ffffff;
    }
</style>
<div class="_PersonalSettings">
        
    <div class="box-body">
        {!! Form::open(['route'=>['admin.users.update_settings', $user->id], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}    

            <div class="form-group form-group-sm {{ $errors->has('skin') ? 'has-error' : null }}">
                {{-- {!! Form::label('skin', 'Skin:', ['class'=>'']) !!} --}}
                {!! Form::select('skin', $layout_colors, $layout_color, ['class'=>'form-control input-sm']) !!}
                {!! $errors->first('skin', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group form-group-sm {{ $errors->has('layout') ? 'has-error' : null }}">
                {{-- {!! Form::label('layout', 'Layouts:', ['class'=>'']) !!} --}}
                {!! Form::select('layout', $layouts, $layout, ['class'=>'form-control input-sm']) !!}
                {!! $errors->first('layout', '<span class="text-danger">:message</span>') !!}
            </div>
            <!-- /. Layouts -->
           
            
            <div class="form-group  form-group-sm">
                <div class="checkbox">
                    <label>
                        {{-- <input type="checkbox" name="sidebar-mini" value="sidebar-mini"> --}}
                        {{ Form::checkbox('mini', 1, $sidebar_mini ) }}
                        Show mini sidebar
                    </label>
                    <!-- /label -->
                </div>
                <!-- /.checkbox -->

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('collapse', 1, $sidebar_collapse ) }}
                        Collapse the sidebar
                    </label>
                    <!-- /label -->
                </div>
                <!-- /.checkbox -->
            </div>
            <!-- /.form-group  form-group-sm -->

            <div class="">
                <div class="form-group  form-group-sm">
                    <button class="btn btn-primary form-control">SUBMIT-CHANGES</button>
                </div>
            </div>
    
        {!! Form::close() !!}
    </div>  
</div>