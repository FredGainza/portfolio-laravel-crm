<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Entreprise, Employe};
use App\Http\Requests\Employe as EmployeRequest;
use App\Mail\Ajout;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployesExport;

class EmployeController extends Controller
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
    public function index($name = null)
    {
        $query = $name ? Entreprise::whereName($name)->firstOrFail()->employes() : Employe::query();
        $employes = $query->oldest('lastname')->paginate(5);
        $entreprises = Entreprise::all();
        return view('employes.index', compact('employes', 'entreprises', 'name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entreprises = Entreprise::all();
        return view('employes.create', compact('entreprises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeRequest $employeRequest)
    {
        Employe::create($employeRequest->all());

        // Transfert de l'email
        $title = 'Ajout en tant qu\'employé dans notre CRM';
        $content = $employeRequest->firstname. ' ' .$employeRequest->lastname;

        Mail::to($employeRequest->email)->cc('contact@fgainza.fr')->send(new Ajout($title, $content));

		 return redirect()->route('employes.index')->with('info', 'L\'employé ' .$employeRequest->firstname. ' ' .$employeRequest->lastname. ' a été ajouté et un e-mail lui a été envoyé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        $entreprise = $employe->entreprise->name;
        return view('employes/show', compact('employe', 'entreprise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise, Employe $employe)
    {
        $entreprises = Entreprise::all();
        return view('employes.edit', compact('employe', 'entreprises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeRequest $employeRequest, Employe $employe)
    {
        $employe->update($employeRequest->all());
        return redirect()->route('employes.index')->with('info', 'Les informations de l\'employé ' .$employe->firstname. ' ' .$employe->lastname. ' ont bien été modifiées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employe::find($id)->delete();
        return "true";
        // $employe->delete();
        // return back()->with('info', 'L\'employé ' .$employe->firstname. ' ' .$employe->lastname. ' a bien été supprimé de la base de données.');
    }

    public function export()
    {
        return Excel::download(new EmployesExport, 'employes.csv');
    }
}
