<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role_id', 3)->get();
        return view('pages.customer', compact('customers'));
    }

    public function store(Request $request) 
    {
        $check_id = $request->has('id') ? $request->input('id') : "";
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$check_id,
            'password' => 'required|min:8',
            'phone' => 'required',
            'address' => 'required',
            'insurance_barmer' => 'required',
            'car_degree' => 'required',
        ]);
        if ($validator->fails()) {
            $error_bag = 'add';
            if ($request->has('id')) {
                $validator->getMessageBag()->add('edit_id', $request->input('id'));
                $error_bag = 'edit';
            }
            return redirect('customer')->withErrors($validator, $error_bag)->withInput();
        }
        else{
            $validated = $validator->validated();
            if ($request->hasFile('image')) {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads'), $image);
                $previous_image = $request->input('previous_image');
                if ($previous_image != "default.jpg") {
                    $previous_image_path = public_path('uploads/'.$previous_image);
                    if(file_exists($previous_image_path)){
                        unlink($previous_image_path);
                    }
                }
            }
            else{
                $image = $request->input('previous_image');
            }
            $validated['username'] = $validated['email'];
            $validated['role_id'] = 3;
            $validated['image'] = $image;
            if ($request->has('id')) {
                $id = $request->input('id');
                User::find($id)->fill($validated)->save();
                $action = 'Edited';
            }
            else{
                User::create($validated);
                $action = 'Created';
            }
            return redirect('customer')->with('success', "Customer ".$action." Successfully.");
        }
    }
}
