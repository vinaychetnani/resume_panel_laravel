<?php

namespace App\Http\Controllers;
// use Auth;
use Illuminate\Support\Facades\Auth;
use App\CsvData;
use App\Test;

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
