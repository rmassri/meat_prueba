<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Answer;
use Validator;


/**
 * Comments and answers
 *
 * @category Comments
 * @package  App
 * @author   Richard Massri <richardmassri22@gmail.com>
 * @license  MIT License Copyright (c)
 * @link     https://meat.cl
 */
class CommentsController extends Controller
{

    /**
     * Endpoint that creates comments
     *
     * @return json
     */
    public function createComment(Request $request, Comment $comment){
        $comment->body = $request->body;
        $comment->user_id = $request->user_id;

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()){
            return $validator->messages();
        }

        $comment->save();
        return $comment;
    }


    /**
     * Method that creates response by comment
     *
     * @param integer $comment_id comment identifier
     *
     * @return json
     */
    public function createAnswer($comment_id, Request $request){
        $answer = new Answer();

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'comment_id' => 'required'
        ]);
 
        if ($validator->fails()){
            return $validator->messages();
        }

        $answer->body = $request->body;
        $answer->comment_id = $comment_id;
        $answer->save();
        return $answer;
    }


    /**
     * Method that returns all comments with their responses
     * 
     * @return void
     */
    public function getComments(){
        $answers_comments = Comment::select('id','body','created_at')->with('answer')->get();
        return $answers_comments;
    }
}
