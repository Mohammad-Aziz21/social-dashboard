<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $records = Record::where('created_by', auth()->user()->id)->get();
        return view('pages.record', compact('records', 'types'));
    }

    public function store(Request $request) 
    {
        $check_id = $request->has('id') ? $request->input('id') : "";
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type_id' => 'required',
            'due_date' => 'required',
            'public_details' => 'required',
            'reminder_date' => 'required',
            'step_1_description' => 'required',
            'step_2_description' => 'required'
        ]);
        if ($validator->fails()) {
            $error_bag = 'add';
            if ($request->has('id')) {
                $validator->getMessageBag()->add('edit_id', $request->input('id'));
                $error_bag = 'edit';
            }
            return redirect('record')->withErrors($validator, $error_bag)->withInput();
        }
        else{
            $validated = $validator->validated();
            if ($request->hasfile('step_1_file')) {
                $step_1_file = time().'.'.$request->step_1_file->extension();
                $request->step_1_file->move(public_path('uploads'), $step_1_file);
                $previous_step_1_file = $request->input('previous_step_1_file');
                if ($previous_step_1_file != "default.jpg") {
                    $previous_step_1_file_path = public_path('uploads/'.$previous_step_1_file);
                    if(file_exists($previous_step_1_file_path)){
                        unlink($previous_step_1_file_path);
                    }
                }
            }
            else{
                $step_1_file = $request->input('previous_step_1_file');
            }
            if ($request->hasfile('step_2_file')) {
                $step_2_file = time().'.'.$request->step_2_file->extension();
                $request->step_2_file->move(public_path('uploads'), $step_2_file);
                $previous_step_2_file = $request->input('previous_step_2_file');
                if ($previous_step_2_file != "default.jpg") {
                    $previous_step_2_file_path = public_path('uploads/'.$previous_step_2_file);
                    if(file_exists($previous_step_2_file_path)){
                        unlink($previous_step_2_file_path);
                    }
                }
            }
            else{
                $step_2_file = $request->input('previous_step_2_file');
            }
            $validated['step_1_file'] = $step_1_file;
            $validated['step_2_file'] = $step_2_file;
            if ($request->has('id')) {
                $id = $request->input('id');
                Record::find($id)->fill($validated)->save();
                $action = 'Edited';
            }
            else{
                Record::create($validated);
                $action = 'Created';
            }
            return redirect('record')->with('success', "Record ".$action." Successfully.");
        }
    }
}
