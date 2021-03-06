<?php

namespace App\Http\Controllers;

use App\Gradebook;
use App\Comment;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class GradebookController extends Controller
{
    
    public function index()
    {
        $name = request()->input('name');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Gradebook::count());

        //https://laravel.com/docs/7.x/eloquent#local-scopes
        return Gradebook::search($skip, $take, $name)->get();
       
    }

    public function availableGradebooks(){
        //https://laravel.com/docs/7.x/eloquent-relationships#querying-relationship-absence
        $availableGradebooks = Gradebook::doesntHave('professor')->get();
        return $availableGradebooks;
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|between:2,255',
        ]);

        $gradebook = new Gradebook();
        $gradebook->name = $request->name;
        if ($request->professor_id !== null) {
            $gradebook->professor_id = $request->professor_id;
        }
        $gradebook->save();
        return $gradebook;
    }

    
    public function show($id)
    {
        $gradebook = Gradebook::with('comments.user', 'students', 'professor')->findOrFail($id);
        return $gradebook;
        
    }

    public function myGradebook(){
        $professor = Auth::user()
            ->professor()
            ->with(
                'gradebook.professor',
                'gradebook.comments.user',
                'gradebook.students'
                )
            ->first();//Losi way
        $gradebook = $professor->gradebook;
        return $gradebook;

    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);

        $gradebook = Gradebook::findOrFail($id);
        $gradebook->name = $request->name;
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
