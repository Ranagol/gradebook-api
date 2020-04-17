<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Gradebook;
use App\Student;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    
    public function index()
    {
        return Professor::with('gradebook', 'first_picture' )->get();
    }

    

    public function availableProfessors(){
        $availableProfessors = Professor::doesntHave('gradebook')->get();
        return $availableProfessors;
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'picture_urls.*.url' => 'required|url'//this will check all picture_url's, and every object has to have a key-value pair url string.
            
        ]);

        $professor = new Professor();
        $professor->first_name = $request->first_name;
        $professor->last_name = $request->last_name;
        $professor->save();

        if($request->gradebook_id !== null && $request->gradebook_id !==''){
            $gradebook = Gradebook::find($request->gradebook_id);
            $gradebook->professor()->associate($professor);
            $gradebook->save();
        }

        //this is the picture handling part below
        foreach ($request->picture_urls as $value) {
            $pictures[] = new Picture(['picture_url' => $value['url']]);
        }
        $professor->pictures()->saveMany($pictures);
        return $professor;
    }

    
    public function show($id)
    {
        $professor = Professor::with('gradebook', 'gradebook.students')->find($id);
        return $professor;
    }

    
    public function update(Request $request, $id)
    {
        
        $professor = Professor::find($id);
        $professor->first_name = $request->first_name;
        $professor->last_name = $request->last_name;
        $professor->save();
        return $professor;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return new JsonResponse(true);
    }
}
