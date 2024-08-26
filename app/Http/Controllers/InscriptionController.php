<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Student;
use App\Models\Tuteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Inscription::with('eleve', 'classe')->get();
        return view('school', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inscription');
    }



    public function getAnneeInscriJson(){
        $data = Inscription::whereAnneeId(session()->get('anneeId'))->with('eleve','tuteur','classe')->get();
        return response()->json($data, 200);
    }


    public function getAllClasse()
    {
        $classe = Classe::all();
        return response()->json($classe, 200);
    }

    public function newRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|string|max:10',
            'nom_tuteur' => 'required|string|max:255',
            'prenom_tuteur' => 'nullable|string|max:255',
            'telephone_tuteur' => 'required|string|max:20',
            'adresse_tuteur' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {

            $student = Student::create([
                'matricule' => 123,
                'uid'=>$request->uid,
                'name' => $request->name,
                'prenom' => $request->prenom,
                'date_naissance' => $request->date_naissance,
                'sexe' => $request->sexe,
            ]);

            // Création du tuteur
            $tuteur = Tuteur::create([
                'nom' => $request->nom_tuteur,
                'prenom' => $request->prenom_tuteur,
                'telephone' => $request->telephone_tuteur,
                'adresse' => $request->adresse_tuteur,
            ]);

            // Création de l'inscription
            $inscription = Inscription::create([
                'eleve_id' => $student->id,
                'tuteur_id' => $tuteur->id,
                'annee_id' => session()->get('anneeId'),
                'classe_id' => $request->classe_id,
            ]);

            return redirect()->route('inscription')->with('success', 'Enregistrement réussi!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'L\'enregistrement a échoué. Veuillez réessayer.');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
