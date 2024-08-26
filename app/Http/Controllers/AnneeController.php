<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class AnneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Annee::orderBy('libelle', 'DESC')->get();
        return view("welcome", compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
            'debut' => 'required',
            'fin' => 'required',
        ]);

        if ($request->debut == $request->fin) {
            return back()->with('error', 'Les annees ne peuvent pas etre identique !');
        }

        $check = Annee::whereLibelle($request->debut . '-' . $request->fin)->first();
        if ($check) {
            return back()->with('error', 'Cette annee existe deja');
        }

        $annee = Annee::create([
            'libelle' => $request->debut . '-' . $request->fin,
            'active' => 0,
            'statut' => 0,
        ]);

        if ($annee) {
            session()->put('annee_libelle', $annee->libelle);
            session()->put('anneeId', $annee->id);

            $annee_en_cours = Annee::find($annee->id);
            Annee::where('active', 1)->update(['active' => 0]);
            $annee_en_cours->active = 1;
            $annee_en_cours->save();

            return back()->with('success', 'Annee ajoutée avec succès');
        } else {
            return back()->with('error', 'Problème lors de l\'ajout d\'une Annee');
        }
    }

    public function ActiveAnnee($id)
    {
        $annee_en_cours = Annee::find($id);
        if ($annee_en_cours) {
            Annee::where('active', 1)->update(['active' => 0]);

            session()->put('annee_libelle', $annee_en_cours->libelle);
            session()->put('anneeId', $annee_en_cours->id);

            $annee_en_cours->active = 1;
            $annee_en_cours->save();
            return back()->with('success', 'Annee activée avec succès');
        }
        return back()->with('error', 'Annee introuvable !');
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
