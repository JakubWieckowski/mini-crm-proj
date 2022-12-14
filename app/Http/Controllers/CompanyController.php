<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(5);
    
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'name' => 'required',
            'email' => 'required',            
            'website' => 'required',  
            'image' => 'mimes:jpeg,bmp,png',           

        ]);      

            
        $request->file('file')->storeAs('public');
            
        $company = new Company([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $request->file->hashName(),
            'website' => $request->get('website'),

        ]);
        $company -> save(); */
        

        /* $request->validate([
            'name' => 'required',
            'email' => 'required',            
            'website' => 'required',  
            'image' => 'required|mimes:jpeg,bmp,png',     
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();


        $request -> image -> move(public_path(), $newImageName);

        Company::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $newImageName,            
            'website' => $request->get('website'),
        ]);   
       
     
        return redirect()->route('companies.index')->with('success','Company added successfully.'); */

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required',
            'website' => 'required',
        ]);
    
        Company::create($request->all());
     
        return redirect()->route('companies.index')->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required',
            'website' => 'required',           

        ]);
    
        $company->update($request->all());
     
        return redirect()->route('companies.index')->with('success','Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company deleted successfully.');
    }

    public function home() {         
        return view('home'); 
       } 
}
