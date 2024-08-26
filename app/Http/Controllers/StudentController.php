<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /* Pour l'affichage des students*/
    public function index()
    {
        $students = Student::orderBy("name", "asc")->paginate(5);
        $classes = Classe::all();
        $schools = Inscription::where('eleve_id')->with('classe')->get();
        return view("student", compact("students", "classes"));
    }
    /*----------------------------------------------------------------------------------------------*/
    public function create()
    {
        $classes = Classe::all();
        return view("createStudent", compact("classes"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "regex:/^[A-Z\s]+$/"], // Valide les majuscules et les espaces uniquement
            "prenom" => ["required", "regex:/^[A-Z][a-zA-Z\s]*$/"], // Valide la première lettre majuscule et autorise les espaces
            "classe_id" => "required"
        ]);
        // Vérifier si un étudiant avec les mêmes informations existe déjà
        $existingStudent = Student::where([
            "name" => $request->name,
            "prenom" => $request->prenom,
            "classe_id" => $request->classe_id,
        ])->first();
        if ($existingStudent) {
            return back()->with("error", "Un étudiant avec les mêmes informations existe déjà.");
        }
        // Si l'étudiant n'existe pas, ajoutez-le à la base de données
        Student::create([
            "name" => $request->name,
            "prenom" => $request->prenom,
            "classe_id" => $request->classe_id,
        ]);
        return back()->with("success", "Étudiant ajouté avec succès.");
    }

    /*------------------------------------------------------------------------------------------------------------*/
    public function destroy(Student $student)
    {
        $nom_complet = $student->name . " " . $student->prenom;
        $student->delete();
        return back()->with("successDelete", " The student '$nom_complet' delete successfully!");
    }
    /*-----------------------------------------------------------------------------------------------------------*/
    public function edit($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                'status' => 404,
                'message' => 'Étudiant introuvable.'
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'student' => $student,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request);
        $stud_id = $request->input('stud_id');
        $student = Student::find($stud_id);
        $student->name = $request->input('name');
        $student->prenom = $request->input('prenom');
        $student->classe_id = $request->input('classe_id');
        $student->update();
        return back()->with("success", "Étudiant édité avec succès");
    }
}
