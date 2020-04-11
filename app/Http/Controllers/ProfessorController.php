<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use JWTAuth;

class ProfessorController extends Controller
{
    
    public function index()
    {
        return Professor::all();
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            //TODO I kinda think that the picture validation (which is a must) needs to happen in the picture controller, not here??
        ]);

        $professor = new Professor();
        $professor->first_name = $request->first_name;
        $professor->last_name = $request->last_name;
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $professor->user_id = $userId;
        $professor->save();
        return $professor;
    }

    
    public function show($id)
    {
        return Professor::find($id);
    }

    
    public function update(Request $request, $id)
    {
        //there is no validation here, because so far there is no update at all.
        //TODO
        /*IN THE TASK THERE IS REQUEST FOR THIS FUNCTION
        $professor = Professor::find($id);
        $professor->first_name = $request->first_name;
        $professor->last_name = $request->last_name;
        //since so far professor can belong only to one user, and user can have only one professor, I don't want anyubody to fuck up the sytem by editing the professors user_id. 
        $professor->save();
        return $professor;
        */
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
