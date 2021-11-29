<?php

namespace App\Http\Controllers\Admin;

use App\Setting;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Auth;
use Validator;
use App\User;


use Storage;

class SettingsController extends Controller{

    /**
     * Admin - Settings
     * URL: /admin/settings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private $typeArr;

    public function __construct(){
        $this->typeArr = config('custom.setting_types_arr');
    }

    public function index(Request $request){
        
        $settingRow = '';

        $method = $request->method();
        //prd($method);
        $setting_id = $request->setting_id;
        $type = (isset($request->type))?$request->type:'website';

        //prd($type);

        $admin_id = auth()->user()->id;

        //prd($admin_id);

        if(is_numeric($setting_id) && $setting_id > 0){
            $settingRow = Setting::find($setting_id);
        }

        if($method == 'POST' || $method == 'post'){

            //prd($request->toArray());

            $rules = [];
            $rules['label'] = 'required';
            $rules['name'] = 'required|unique:website_settings,name,'.$setting_id;
            $rules['value'] = 'required';

            $validator = $this->validate($request, $rules);

            $setting = new Setting;

            $old_value = '';

            $old_file = '';

            if(isset($settingRow->id) && $settingRow->id == $setting_id){
                $setting = $settingRow;

                $old_value = $settingRow->value;

                $old_file = $settingRow->value;
            }

            $fieldType = $request->field_type;

            $setting->type = $request->type;
            $setting->name = $request->name;
            $setting->label = $request->label;
            $setting->css_class = $request->css_class;
            $setting->field_type = $request->field_type;
            $setting->old_value = $old_value;

            if($fieldType != 'file'){
                $setting->value = $request->value;
            }


            $isSaved = $setting->save();

            if($isSaved){

                $this->saveFile($request, $setting, $old_file);

                $success_msg = 'Setting has been saved successfully';

                session()->flash('alert-success', $success_msg);

                return redirect(url('admin/settings?type='.$type));
            }
        }

        //prd($this->typeArr);


        $data = [];

        $settingsQuery = Setting::orderBy('id', 'asc');        

        if(!empty($type) && isset($this->typeArr[$type])){
            $settingsQuery->where('type', $type);
        }

        $settings = $settingsQuery->get();

        $data['type'] = $type;
        $data['settings'] = $settings;
        $data['settingRow'] = $settingRow;
        $data['breadcum'] = 'Website Setting';

        return view('admin.settings.index', $data);
    }

    private function saveFile($request, $setting, $old_file=''){

        $file = $request->file('value');

        //prd($old_file);

        if($file && $setting){

            $path = 'settings';

            $result = CustomHelper::UploadFile($file, $path);

            //prd($result);

            if($result['success']){
                $setting->value = $result['file_name'];

                $setting->save();

                $filePath = 'settings/';

                $storage = Storage::disk('public');

                if(!empty($old_file) && $storage->exists($filePath.$old_file)){
                    $storage->delete($filePath.$old_file);
                }
            }
        }

    }

    /**
     * Admin - Update Setting
     * URL: /admin/settings/{setting} (PUT)
     *
     * @param Request $request
     * @param $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $setting){

        $data = $request->all();

        $setting->state = isset($data['state']);

        $result = $setting->save();

        if ($result) {
            return redirect(route('admin.settings.index'))->with('alert-success', 'The setting has been updated successfully.');
        } else {
            return back()->with('alert-danger', 'The setting cannot be updated, please try again or contact the administrator.');
        }
    }
}