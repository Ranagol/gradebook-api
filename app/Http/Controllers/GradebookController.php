<?php

namespace App\Http\Controllers;

use App\Gradebook;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use JWTAuth;

class GradebookController extends Controller
{
    
    public function index()
    {
        return Gradebook::all();
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);

        $gradebook = new Gradebook();
        $gradebook->name = $request->name;
        $user = JWTAuth::parseToken()->authenticate();
        $professor = $user->professor();//TODO: WE need the professor id for the gradebook creation. We can get the user id from jwt, and through relationship we can get from the user the belonging professor object. cHECK THIS
        $professorId = $professor->id;
        $gradebook->professor_id = $professorId;
        $gradebook->save();
        return $gradebook;
    }

    
    public function show($id)
    {
        return Gradebook::find($id);
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);

        $gradebook = Gradebook::find($id);
        $gradebook->name = $request->name;
        //TODO POSSIBLE ISSUE: since so far gradebook belongs only to one professor, and one professor can have only one gradebook, I don't want the user to mess with the gradebook's professor_id
        //TODO: IF they change the relationships regarding the user/professor/gradebook then I will have to change my controllers and validations everywhere... fuck.
        $gradebook->save();
        return $gradebook;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradebook $gradebook)
    {
        $gradebook->delete();
        return new JsonResponse(true);
    }
}
