<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class employeecontroller extends Controller
{
    public function add()
    {
        return view('add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'salary'=>'required'
        ]);
        $input = new employee();
        $input->name = $request->input('name');
        $input->email = $request->input('email');
        $input->salary = $request->input('salary');
        $input->stateid = $request->input('stateid');
        $input->cityid = $request->input('cityid');
        $input->image = $request->input('image');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $input->image = $filename;
        }
        $input->save();

        return redirect('employeelist');
    }
    public function show()
    {
        $Datas = DB::table('employees')
            ->join('states', 'employees.stateid', '=', 'states.id')
            ->join('citys', 'employees.cityid', '=', 'citys.id')
            ->select('employees.*', 'states.StateName', 'citys.CityName')->get();
        return view('employeelist', ['datas' => $Datas]);
    }
    public function deleteEmployee($id)
    {
        $Data = DB::table('employees')->where('employees.id', '=', $id)->delete();
        return true;
    }

    public function edit($id)
    {
        $Data = employee::find($id);
        return view('edit', ['data' => $Data]);
    }
    public function update(Request $request)
    {
        $id = $request->input('id');
        $input = employee::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $input->name = $request->input('name');
        $input->email = $request->input('email');
        $input->salary = $request->input('salary');
        $input->stateid = $request->input('stateid');
        $input->cityid = $request->input('cityid');
        $input->image = $request->input('image');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $input->image = $filename;
        }
        $input->save();

        return redirect('employeelist');
    }
    public function getEmployeeById($id)
    {
        $Data = employee::find($id);
        return $Data;
    }
}
