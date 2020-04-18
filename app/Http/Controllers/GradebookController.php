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
    //EXAMPLE FOR PAGINATION+SEARCHTerm
    /*
    public function index()
        {
            //example for a  url request: /movies?take=10&skip=5&title=night
            $title = request()->input('title');//take the title from the url request
            $skip = request()->input('skip', 0);//take the skip value from the url request
            $take = request()->input('take', Movie::count());//take the take value from the url request. If the take is not defined, return all the movies.

            if ($title) {//if title exists in url...
                return Movie::search($title, $skip, $take);//...search by title, return pagination
            } else {
                return Movie::skip($skip)->take($take)->get();//...or return paginated response
            }
        }

    */
    
    public function index()
    {
        /* // THIS IS THE FULLY OPERATIONAL ORIGINAL CODE
        return Gradebook::with('professor', 'students')->get();
        */

        //example for a  url request: /gradebooks?take=10&skip=5&name=randomSearchTerm


        //TESTED IN POSTMAN, THIS IS FULLY OPERATIONAL
        $name = request()->input('name');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Gradebook::count());

        if ($name) {
            return Gradebook::search($name, $skip, $take);
        } else {
            return Gradebook::skip($skip)->take($take)->get();
        }
        //TODO LOSI - ez tesztelve van Postmannal, teljesen működőképes. Tudsz ehhez frontend reszt csinalni? Vagy k0nnyeb lenne szamodra, ha te csinalnad meg a backendet is, egy masikat ez helyett?
        


    }

    public function availableGradebooks(){
        //https://laravel.com/docs/7.x/eloquent-relationships#querying-relationship-absence
        $availableGradebooks = Gradebook::doesntHave('professor')->get();//desnt working
        return $availableGradebooks;
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:255',
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
        $gradebook = Gradebook::with('comments.user', 'students', 'professor')->find($id);
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
        // $gradebook = Gradebook::with('comments.user', 'students', 'professor')->where('user_id', $userId)->first();
        return $gradebook;

    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);

        $gradebook = Gradebook::find($id);
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
