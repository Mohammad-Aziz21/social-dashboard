<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('pages.type', compact('types'));
    }

    public function store(Request $request) 
    {
        $check_id = $request->has('id') ? $request->input('id') : "";
        $validator = Validator::make($request->all(), [
            'type' => 'required|unique:types,type,'.$check_id,
            'description' => 'required',
            'start_date' => 'required',
            'services' => 'required'
        ]);
        if ($validator->fails()) {
            $error_bag = 'add';
            if ($request->has('id')) {
                $validator->getMessageBag()->add('edit_id', $request->input('id'));
                $error_bag = 'edit';
            }
            return redirect('type')->withErrors($validator, $error_bag)->withInput();
        }
        else{
            $validated = $validator->validated();
            if ($request->hasFile('file')) {
                $file = time().'.'.$request->file->extension();
                $request->file->move(public_path('uploads'), $file);
                $previous_file = $request->input('previous_file');
                if ($previous_file != "default.jpg") {
                    $previous_file_path = public_path('uploads/'.$previous_file);
                    if(file_exists($previous_file_path)){
                        unlink($previous_file_path);
                    }
                }
            }
            else{
                $file = $request->input('previous_file');
            }
            $validated['file'] = $file;
            if ($request->has('id')) {
                $id = $request->input('id');
                Type::find($id)->fill($validated)->save();
                $action = 'Edited';
            }
            else{
                Type::create($validated);
                $action = 'Created';
            }
            return redirect('type')->with('success', "Type ".$action." Successfully.");
        }
    }
}
