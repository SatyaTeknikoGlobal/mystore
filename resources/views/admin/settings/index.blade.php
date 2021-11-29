@include('admin.common.sidebar')

<?php

$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

$setting_id = 0;

$setting_id = (isset($settingRow->id))?$settingRow->id:0;
$type = (isset($settingRow->type))?$settingRow->type:$type;
$name = (isset($settingRow->name))?$settingRow->name:'';
$label = (isset($settingRow->label))?$settingRow->label:'';
$field_type = (isset($settingRow->field_type))?$settingRow->field_type:'text';
$css_class = (isset($settingRow->css_class))?$settingRow->css_class:'';
$value = (isset($settingRow->value))?$settingRow->value:'';
    //$type = (isset($settingRow->type))?$settingRow->type:'text';

$action_url = url($ADMIN_ROUTE_NAME.'/settings');

$name_readonly = '';

$form_heading = 'Add Setting';

if(is_numeric($setting_id) && $setting_id > 0){
    $action_url = url($ADMIN_ROUTE_NAME.'/settings', $setting_id);
    $name_readonly = 'readonly';

    $form_heading = 'Update Setting';
}

$inputTypesArr = config('custom.input_types_arr');
$settingTypesArr = config('custom.setting_types_arr');

$path = 'settings/';

$storage = Storage::disk('public');

?>


<div class="row">

    <div class="col-sm-6">
        <h1>
            <!-- Settings({{$settingTypesArr[$type]}}) -->


            

            <div class="pull-right {{ $errors->has('type') ? ' has-error' : '' }}" style="font-size:14px;">
                <strong class="pull-left">Select Type:&nbsp;</strong>

                <select name="select_type" class="form-select">
                    <option value="">--select--</option>

                    <?php
                    if(!empty($settingTypesArr) && count($settingTypesArr) > 0){
                        foreach($settingTypesArr as $saKey=>$saVal){
                            $selected = '';
                            if($saKey == $type){
                                $selected = 'selected';
                            }
                            ?>
                            <option value="{{$saKey}}" {{$selected}}>{{$saVal}}</option>
                            <?php
                        }
                    }
                    ?>

                </select>

                @include('snippets.errors_first', ['param' => 'type'])

            </div>

        </h1>

        @include('snippets.errors')
        @include('snippets.flash')
    </div>

    <div class="col-md-12">
        <div class="topsearch">

            <h4>{{ $form_heading }} </h4>
            <br>
            <form name="settingForm" method="POST" action="{{ $action_url }}" accept-charset="UTF-8" role="form" class="form-inline heightform" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group col-md-2 {{ $errors->has('type') ? ' has-error' : '' }} ">
                    <label for="type" class="control-label required">Type:</label>

                    <select name="type" class="form-control">
                        <option value="">--select--</option>

                        <?php
                        if(!empty($settingTypesArr) && count($settingTypesArr) > 0){
                            foreach($settingTypesArr as $saKey=>$saVal){
                                $selected = '';
                                if($saKey == $type){
                                    $selected = 'selected';
                                }
                                ?>
                                <option value="{{$saKey}}" {{$selected}}>{{$saVal}}</option>
                                <?php
                            }
                        }
                        ?>

                    </select>

                    @include('snippets.errors_first', ['param' => 'type'])

                </div>


                <div class="form-group col-md-2 {{ $errors->has('name') ? ' has-error' : '' }} ">
                    <label for="name" class="control-label required">Name:</label>

                    <input type="text" name="name" class="form-control" value="{{ old('name', $name) }}" maxlength="255" {{ $name_readonly }} />

                    <?php
                    /*@include('snippets.errors_first', ['param' => 'name'])*/
                    ?>
                </div>

                <div class="form-group col-md-2 {{ $errors->has('title') ? ' has-error' : '' }} ">
                    <label for="label" class="control-label required">Label:</label>

                    <input type="text" name="label" class="form-control" value="{{ old('label', $label) }}" maxlength="255" />

                    <?php
                    /*@include('snippets.errors_first', ['param' => 'label'])*/
                    ?>
                </div>

                <div class="form-group col-md-2 {{ $errors->has('title') ? ' has-error' : '' }} ">
                    <label for="css_class" class="control-label required">CSS Class:</label>

                    <input type="text" name="css_class" class="form-control" value="{{ old('css_class', $css_class) }}" maxlength="255" />

                    <?php
                    /*@include('snippets.errors_first', ['param' => 'amount'])*/
                    ?>
                </div>

                <div class="form-group col-md-2 {{ $errors->has('title') ? ' has-error' : '' }} ">
                    <label for="field_type" class="control-label required">Field Type:</label>

                    <select name="field_type" class="form-control">
                        <option value="">--select--</option>

                        <?php
                        if(!empty($inputTypesArr) && count($inputTypesArr) > 0){
                            foreach($inputTypesArr as $iaKey=>$iaVal){
                                $selected = '';
                                if($iaKey == $field_type){
                                    $selected = 'selected';
                                }
                                ?>
                                <option value="{{$iaKey}}" {{$selected}}>{{$iaVal}}</option>
                                <?php
                            }
                        }
                        ?>

                    </select>

                    <?php
                    /*@include('snippets.errors_first', ['param' => 'amount'])*/
                    ?>
                </div>


                <div class="form-group col-md-4 {{ $errors->has('value') ? ' has-error' : '' }} ">
                    <label for="value" class="control-label required">Value:</label>
                    <div class="fileBox">

                        <input type="file" name="value">

                        <?php
                        if($field_type == 'file'){

                            if(!empty($value) && $storage->exists($path.$value)){
                                ?>
                                <p style="font-size: 12px;">
                                    <a href="{{url('public/storage/'.$path.$value)}}" target="_blank">
                                        
                                     <strong>Uploaded File:</strong> {{$value}}
                                 </a>
                             </p>
                             <?php
                         }
                     }
                     ?>

                 </div>

                 <div class="valBox">
                    <p style="font-size: 12px;">for multiple values separate with semicolon(;)</p>
                    <textarea name="value" id="value" class="form-control" cols="25" />{{ old('value', $value) }}</textarea>
                </div>

                @include('snippets.errors_first', ['param' => 'value'])

            </div>

            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="setting_id" value="{{ $setting_id }}">

            <button class="btn btn-success btn1search"><i class="fa fa-save"></i> Save</button>

            <?php
            if($setting_id > 0){
                ?>
                <a href="{{ url($ADMIN_ROUTE_NAME.'/settings') }}" class="btn resetbtn btn-primary btn1search" title="Cancel">Cancel</a>
                <?php
            }
            ?>

        </form>

    </div>
</div>



<div class="col-md-12">


    <?php
    if(!empty($settings) && count($settings) > 0){
        ?>
        <table class="table table-striped">
            <tr>
                <th>Label</th>
                <th>Type</th>
                <th>CSS Class</th>
                <th>Field Type</th>
                <th>Value</th>

                <th>Edit</th>
            </tr>

            <?php
            foreach ($settings as $setting){
                ?>
                <tr>
                    <td>{{$setting->label}}</td>

                    <td>
                        <?php
                        if(isset($settingTypesArr[$setting->type])){
                            echo $settingTypesArr[$setting->type];
                        }
                        ?>
                    </td>

                    <td>{{$setting->css_class}}</td>
                    <td>{{$setting->field_type}}</td>

                    <td>
                        <?php
                        $value = $setting->value;
                        if($setting->field_type == 'file'){
                            if(!empty($value) && $storage->exists($path.$value)){
                                ?>
                                <a href="{{url('public/storage/'.$path.$value)}}" target="_blank">{{$value}}</a>
                                <?php
                            }
                        }
                        else{
                            ?>
                            {{$value}}
                            <?php
                        }
                        ?>

                    </td>



                    <td>

                        <a href="{{ url($ADMIN_ROUTE_NAME.'/settings/'.$setting->id. '?type='.$setting->type) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    else{
        ?>
        <div class="alert alert-warning">There are no settings at the present.</div>
        <?php
    }
    ?>

</div>

</div>




<script type="text/javascript">

  $(document).on("change", "[name=field_type]", function(){
    var fieldType = $(this).val();
        //alert(fieldType);

        toggleValBox(fieldType);        
    });

  var fieldType = "{{$field_type}}";

  function toggleValBox(fieldType){

    var settingForm = $("form[name=settingForm]");

    fieldType = fieldType.trim();

    if(fieldType == 'file'){
        settingForm.find(".valBox").hide();
        settingForm.find(".fileBox").show();
    }
    else{
        settingForm.find(".valBox").show();
        settingForm.find(".fileBox").hide();
    }

}

toggleValBox(fieldType);

$("select[name=select_type]").change(function(){
    var type = $(this).val();
    window.location = "{{url($ADMIN_ROUTE_NAME.'/settings?type=')}}"+type;
});
</script>

@include('admin.common.footer')