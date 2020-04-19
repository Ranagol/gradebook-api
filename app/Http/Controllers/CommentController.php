<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Gradebook;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    //Route::get('/gradebooks/{gradebook}/comments/create', 'CommentController@store');
    public function store(Request $request, $gradebookId)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $comment->user_id = $userId;
        $comment->gradebook_id = $gradebookId;
        $comment->save();
        $comment = Comment::where('id', '=', $comment->id)->with('user')->first();
        return $comment;
    }

    

    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $commentId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $commentId)
    {
        $comment = Auth()->user()->comments()->where('id', '=', $commentId)->first();

        if ($comment === null) {
            throw new \RuntimeException('This comment is not yours to delete.');
        }

        $comment->delete();


    }
}
