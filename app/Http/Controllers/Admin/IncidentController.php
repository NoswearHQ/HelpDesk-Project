<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\User;
use Auth;
use Image;
use App\Traits\UploadImage;
class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Incident access|Incident create|Incident edit|Incident delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Incident create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Incident edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Incident delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Incident= Incident::paginate(4);
        $users= User::all();
        return view('incident.index',['incidents'=>$Incident,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incident.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $incident = new Incident();
        $incident->title= $request->title;  
        $incident->description= $request->description;
        $incident['user_id'] = Auth::user()->id;
        $incident->categorie= $request->categorie;
       
       
        if($request->hasFile('image')){
            $image = $request->file('image');
            
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location=public_path('images/' .$filename);
            Image::make($image)->resize(200,100)->save($location);
            // Image::make($image)->resize(300,300)->save( public_path('images/' . $filename ) );
            $incident->image = $filename;    
        }  


        $incident->save();
        return redirect()->back()->withSuccess('Incident created !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
       return view('incident.edit',['incident' => $incident]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incident $incident)
    {
        $incident->update($request->all());
        return redirect()->back()->withSuccess('Incident updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return redirect()->back()->withSuccess('Incident deleted !!!');
    }
}
