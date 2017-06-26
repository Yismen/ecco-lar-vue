<style>
    ._PersonalSettings {
        color: #ffffff;
    }
</style>
<div class="_PersonalSettings">
    <form action="#" class="sidebar-form" method="post">
        {{ csrf_field() }}
        <div class="form-group  form-group-sm">
            <select class="form-control" name="skin" id="skin">
                <option value="skin-blue">Blue Skin</option>     
                <option value="skin-black">Black Skin</option>    
                <option value="skin-purple">Purple Skin</option>   
                <option value="skin-yellow">Yellow Skin</option>   
                <option value="skin-red">Red Skin</option>      
                <option value="skin-green">Green Skin</option>
            </select>
        </div>
        <!-- /.form-group  form-group-sm -->
        <div class="form-group  form-group-sm">
            <select class="form-control" name="layout" id="layout">
                <option value="fixed">Fixed Layout</option>     
                <option value="layout-boxed">Boxed Layout</option>    
                <option value="top-nave">Top Nav Layout</option>   
            </select>
        </div>
        <!-- /.form-group  form-group-sm -->
        <div class="form-group  form-group-sm">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="sidebar-mini">
                    Mini sidebar
                </label>
                <!-- /label -->
            </div>
            <!-- /.checkbox -->

            <div class="checkbox">
                <label>
                    <input type="checkbox" value="sidebar-collapse">
                    Sidebar Collapse
                </label>
                <!-- /label -->
            </div>
            <!-- /.checkbox -->
        </div>
        <!-- /.form-group  form-group-sm -->

        <div class="row">
            <div class="form-group  form-group-sm">
                <button class="btn btn-primary form-control">SUBMIT-CHANGES</button>
            </div>
        </div>
        <!-- /.row -->
    </form>
</div>