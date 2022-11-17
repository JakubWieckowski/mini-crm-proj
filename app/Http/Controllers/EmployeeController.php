<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(5);
    
        return view('employees.index',compact('employees'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'comp' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $result = $request->all();        

        $company = Company::where('name', '=', $request->comp)->get();
                if ($company === null) {
                    return redirect()->route('employees.index')->with('failure','Company does not exist.');
                }
                else {
                    //dd($company);
                    $employee = new Employee();
                    $employee->first_name = $request->first_name;
                    $employee->last_name = $request->last_name;
                    //$employee->company = $company->name;                    
                    $employee->email = $request->email;
                    $employee->phone = $request->phone;
                    //$company->employees()->associate($employee);
                    //$company->save();
                    //$employee->company()->associate($company); 
                    //$employee->company_id = 1;
                       
                    $employee->company()->associate($company[0]); 
                    //dd($employee);
                    $company[0]->save();                                    
                    $employee->save();    
                    return redirect()->route('employees.index')->with('success','Employee created successfully.');                                   
                }
    
        //Employee::create($request->all());
     
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'comp' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
    
        //$employee->update($request->all());       
        $company = Company::where('name', '=', $request->comp)->get();
                if ($company === null) {
                    return redirect()->route('employees.index')->with('failure','Company does not exist.');
                }
                else {                    
                    
                    $employee->first_name = $request->first_name;
                    $employee->last_name = $request->last_name;                                        
                    $employee->email = $request->email;
                    $employee->phone = $request->phone;              
                    $employee->company()->associate($company[0]);                     
                    $company[0]->save();                                    
                    $employee->save();    
                    return redirect()->route('employees.index')->with('success','Employee updated successfully.');                                   
                }
     
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee deleted successfully.');
    }
    
    public function home() {         
        return view('home'); 
       } 
   

}
