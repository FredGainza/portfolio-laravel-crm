<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\Ajout;
use App\Http\Requests\Entreprise as EntrepriseRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EntreprisesExport;
// use Maatwebsite\Excel\Excel;



class EntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises = Entreprise::paginate(5);
        // $entNameCrt= Entreprise::orderBy('name', 'asc')->paginate(5);
        // $entNameDct= Entreprise::orderBy('name', 'desc')->paginate(5);
        return view('entreprises.index', compact('entreprises'));
        // return view('entreprises.index', compact('entreprises', 'entNameCrt', 'entNameDct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entreprises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('logo')) {
            $logo_name= Str::slug($request->name, '-');
            $extension = $request->file('logo')->extension();
            $logo_title = $logo_name.'_logo.'.$extension;
            $file = $request->file('logo')
                ->storeAs('compagnies', $logo_title, 'public');
            // $path = $file->path();
            // dd($logo_title);
        }


        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'email',
            'logo' => 'image | dimensions:min_width=150,min_height=150',
            'site' => 'string',
        ]);
        // dd($request);
        $ent = new Entreprise;
        $ent->name = $request->name;
        isset ($request->email) ? $ent->email= $request->email : '';
        isset ($request->logo) ? $ent->logo = $logo_title : '';
        isset ($request->site) ? $ent->site = 'http://www.'.strtolower(str_replace(' ', '-', $request->site)) : '';
        // dd($ent->logo);
        $ent->save();

        // Transfert de l'email
        $title = 'Ajout de votre entreprise dans notre CRM';
        $content = $ent->name;

        Mail::to($ent->email)->cc('contact@fgainza.fr')->send(new Ajout($title, $content));

        return redirect()->route('entreprises.index')->with('info', 'L\'entreprise ' .$ent->name. ' a bien été ajoutée et le message envoyé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
        $employes = Entreprise::find($entreprise->id)->employes;
        return view('entreprises.show', compact('employes', 'entreprise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise)
    {
        return view('entreprises.edit', compact('entreprise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        if ($request->file('logo')) {
            $logo_name= Str::slug($request->name, '-');
            $extension = $request->file('logo')->extension();
            $logo_title = $logo_name.'_logo.'.$extension;
            $file = $request->file('logo')
                ->storeAs('compagnies', $logo_title, 'public');
            // $path = $file->path();
        }
        // dd($request);

        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'email',
            'logo' => 'image',
            'site' => 'string'
        ]);

        // dd($entreprise);
        $entreprise->name = $request->name;
        isset ($request->email) ? $entreprise->email= $request->email : '';
        isset ($request->logo) ? $entreprise->logo = $logo_title : '';
        isset ($request->site) ? $entreprise->site = strtolower(str_replace(' ', '-', $request->site)) : '';
        // echo($entreprise->logo);exit;

        $entreprise->save();
        return redirect()->route('entreprises.index')->with('info', 'Les informations de l\'entreprise ' .$entreprise->name. ' ont bien été modifiées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $entreprise->delete();
        Entreprise::find($id)->delete();
        return "true";
                // return back()->with('info', 'L\'entreprise ' .$entreprise->name. ' a bien été supprimé de la base de données.');
    }

    public function export()
    {
        return Excel::download(new EntreprisesExport, 'entreprises.csv');
    }
}
