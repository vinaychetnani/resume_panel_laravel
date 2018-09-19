<?php

namespace App\Http\Controllers;
// use Auth;
use Illuminate\Support\Facades\Auth;
use App\CsvData;
use App\Test;
use App\Resume_panel_vn;
use App\Resume_panel_phrase;
use App\Resume_panel_antiphrase;
use App\Resume_panel_hs_ss;
use App\Resume_panel_antivn;
use Illuminate\Http\Request;
use App\Http\Requests\ResumeFormRequest;

class TryController extends Controller
{
    public function show()
    {
        $data = CsvData::where('owner_email', Auth::user()->email)->get();
        $data1 = [];
        $data2 =[];
        foreach ($data as $key => $value) {
            $data1 [] = json_decode($value->csv_data, true);
        }
        
        return response(sizeof($data1));
        // return Auth::user()->email;
    }

    public function showForm()
    {
        if (!Auth::check()){
            return redirect('/login')->with('status', 'Not Login into account!');
        } 
        return view('resume_form');
        // return Auth::user()->email;
    }

    public function tryExec()
    {   
        // $st = "done";
        // exec("mkdir try_exec");
        // return response($st);
        return view('try_selectpicker');
    }

    public function pushDatabase(Request $request){
        $jso['jsonobj_vn'] = $request->get('jsonObj_vn');
        $jso['jsonobj_phrase'] = $request->get('jsonObj_phrase');
        $jso['jsonobj_antiphrase'] = $request->get('jsonObj_antiphrase');
        $jso['jsonobj_hs_ss'] = $request->get('jsonObj_hs_ss');
        $jso['jsonobj_antivn'] = $request->get('jsonObj_antivn');
        $resume_id = $request->get('resume_id');
        if ($jso['jsonobj_vn'] != null){
            foreach ($jso['jsonobj_vn'] as $key => $value) {
                $res_vn = new Resume_panel_vn;
                $res_vn->resume_id = $resume_id;
                $res_vn->user_id = Auth::user()->name;
                $res_vn->verb = $value['verb'];
                $res_vn->noun = $value['noun'];
                $res_vn->skill_type = $value['skill_type'];
                $res_vn->skill = $value['skill'];
                $res_vn->action = $value['action'];
                $res_vn->save();
            }
        }
        if ($jso['jsonobj_phrase'] != null){
            foreach ($jso['jsonobj_phrase'] as $key => $value) {
                $res_phrase = new Resume_panel_phrase;
                $res_phrase->resume_id = $resume_id;
                $res_phrase->user_id = Auth::user()->name;
                $res_phrase->phrase = $value['phrase'];
                $res_phrase->phrase_type = $value['phrase_type'];
                $res_phrase->sub_type = $value['sub_type'];
                $res_phrase->competency = $value['competency'];
                $res_phrase->action = $value['action'];
                $res_phrase->save();
            }
        }
        if ($jso['jsonobj_antiphrase'] != null){
            foreach ($jso['jsonobj_antiphrase'] as $key => $value) {
                $res_antiphrase = new Resume_panel_antiphrase;
                $res_antiphrase->resume_id = $resume_id;
                $res_antiphrase->user_id = Auth::user()->name;
                $res_antiphrase->phrase = $value['phrase'];
                $res_antiphrase->skill = $value['skill'];
                $res_antiphrase->skill_type = $value['skill_type'];
                $res_antiphrase->save();
            }
        }
        if ($jso['jsonobj_hs_ss'] != null){
            foreach ($jso['jsonobj_hs_ss'] as $key => $value) {
                $res_hs_ss = new Resume_panel_hs_ss;
                $res_hs_ss->resume_id = $resume_id;
                $res_hs_ss->user_id = Auth::user()->name;
                $res_hs_ss->hs = $value['hs'];
                $res_hs_ss->ss = $value['ss'];
                $res_hs_ss->save();
            }
        }
        if ($jso['jsonobj_antivn'] != null){
            foreach ($jso['jsonobj_antivn'] as $key => $value) {
                $res_antivn = new Resume_panel_antivn;
                $res_antivn->resume_id = $resume_id;
                $res_antivn->user_id = Auth::user()->name;
                $res_antivn->verb = $value['verb'];
                $res_antivn->noun = $value['noun'];
                $res_antivn->competency = $value['competency'];
                $res_antivn->save();
            }
        }
        // return response()->json(['success'=>'Data is successfully added']);
        return response($jso);
    }

    public function parseForm(Request $request)
    {        
        if (!Auth::check()){
            return redirect('/login')->with('status', 'Not Login into account!');
        }
        $contact = [];
        $contact['r_id'] = $request->get('r_id');
        $contact['benchmark'] = $request->get('benchmark');
        $contact['community'] = $request->get('community');
        if ($contact['benchmark'] == ""){
            $contact['bemchmark'] = "add_ben";
        }
        if ($contact['community'] == ""){
            $contact['community'] = "add_comm";
        }
        $command = "/home/rahul/skills_dev_env/bin/python /home/rahul/skills/panel_data/resume_data.py ".$contact['r_id']." ".$contact['benchmark']." ".$contact['community'];
        exec($command);
        $str = file_get_contents('/Users/vinaychetnani/723026_early_princeton.json');
        $json_full = json_decode($str, true);
        $json = $json_full['data'];
        $json_s = $json_full['success'];
        $all_c = array();
        if ($json_s == True) {
            foreach ($json as $bullet) {
                $all_comp = array();
                $all_pos = array();
                $all_act = array();
                $tem_pos = array();
                $tem_act = array();

                foreach ($bullet['position'] as $key => $value) {
                    $tem_pos [] = $key;
                }
                foreach ($bullet['action'] as $key => $value) {
                    $tem_act [] = $key;
                }
                foreach ($bullet['position'] as $key => $value) {
                    $all_comp [] = $key;
                }
                foreach ($bullet['action'] as $key => $value) {
                    if (in_array($key, $all_comp)){
                        continue;
                    }
                    else{
                        $all_comp [] = $key;
                    }
                }
                foreach ($all_comp as $key => $value){
                    if (in_array($value, $tem_pos)){
                        $all_pos [] = $bullet['position'][$value];
                    }
                    else{
                        $all_pos [] = 0;
                    }
                }
                foreach ($all_comp as $key => $value){
                    if (in_array($value, $tem_act)){
                        $all_act [] = $bullet['action'][$value];
                    }
                    else{
                        $all_act [] = 0;
                    }
                }
                $tem_data = array();
                $tem_data [] = $all_comp;
                $tem_data [] = $all_pos;
                $tem_data [] = $all_act;
                $all_c [] = $tem_data;
            }
        }
        else {
        }
        return view('left_right_new', compact('json', 'all_c', 'json_s'));
    }

    public function collapseTry()
    {
        $str = file_get_contents('/Users/vinaychetnani/DS_training/723026_early_princeton.json');
        $json = json_decode($str, true);
        $test = Test::select()->orderBy('id')->get();
        // return response($test);
        return view('collapse')->with('test', $test);
    }

    public function filter_css()
    {
        return view('filter_css_try');
    }


    public function leftRight()
    {
        $json_s = True;
        $str = file_get_contents('/Users/vinaychetnani/723026_early_princeton.json');
        $json = json_decode($str, true);
        $all_c = array();
        foreach ($json as $bullet) {
            $all_comp = array();
            $all_pos = array();
            $all_act = array();
            $tem_pos = array();
            $tem_act = array();

            foreach ($bullet['position'] as $key => $value) {
                $tem_pos [] = $key;
            }
            foreach ($bullet['action'] as $key => $value) {
                $tem_act [] = $key;
            }
            foreach ($bullet['position'] as $key => $value) {
                $all_comp [] = $key;
            }
            foreach ($bullet['action'] as $key => $value) {
                if (in_array($key, $all_comp)){
                    continue;
                }
                else{
                    $all_comp [] = $key;
                }
            }
            foreach ($all_comp as $key => $value){
                if (in_array($value, $tem_pos)){
                    $all_pos [] = $bullet['position'][$value];
                }
                else{
                    $all_pos [] = 0;
                }
            }
            foreach ($all_comp as $key => $value){
                if (in_array($value, $tem_act)){
                    $all_act [] = $bullet['action'][$value];
                }
                else{
                    $all_act [] = 0;
                }
            }
            $tem_data = array();
            $tem_data [] = $all_comp;
            $tem_data [] = $all_pos;
            $tem_data [] = $all_act;
            $all_c [] = $tem_data;
        }
        // return response($all_c[16]); 
        return view('left_right_new', compact('json', 'all_c', 'json_s'));
    }

    public function tableLay()
    {
        $str = file_get_contents('/Users/vinaychetnani/723026_early_princeton.json');
        $json = json_decode($str, true);
        $all_comp = array();
        foreach ($json as $bullet) {
            $result = $bullet['position'];
            $key_array = array();
            foreach ($bullet['position'] as $key => $value) {
                $key_array [] = $key;
            }
            $tem_data = array();
            foreach ($bullet['action'] as $key => $value) {
                $tem_data [] = $key;
            }
            foreach ($bullet['action'] as $key => $value){
                if (in_array($key, $key_array)){
                    $tem = $result[$key] + $value;
                    $result[$key] = $tem;
                }
                else{
                    $result[$key] = $value;
                }
            }
            $all_comp [] = $result;
         }
         // return response($all_comp);
        return view('table_layout', compact('json', 'all_comp'));
    }
}
