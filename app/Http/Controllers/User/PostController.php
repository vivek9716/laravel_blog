<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\user\like;
use App\Model\user\comment;
use App\Model\user\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\user\commentlike;

class PostController extends Controller {

    public function post(post $post) {
        $currentUser = Auth::user();
        $userData = json_encode(array(
            'name' => ($currentUser) ? $currentUser->name : '',
            'email' => ($currentUser) ? $currentUser->email : '',
        ));

        //$postId = $post->id;
        
        /* $comments = comment::select('comments.*', \Illuminate\Support\Facades\DB::raw("COUNT(commentlikes.id) as number_of_likes"))
                ->leftjoin('commentlikes', 'commentlikes.comment_id', '=', 'comments.id')
                ->where('comments.approved', 1)
                ->where('comments.post_id', $postId)
                ->groupBy('comments.id')
                ->orderBy('comments.id', 'desc')                
                ->get();*/
        
        return view('user.post', compact('userData', 'post'));
    }

    public function getAllPosts() {
        return $posts = post::with('likes')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
    }

    public function saveLike(request $request) {
        $likecheck = like::where(['user_id' => Auth::id(), 'post_id' => $request->id])->first();
        if ($likecheck) {
            like::where(['user_id' => Auth::id(), 'post_id' => $request->id])->delete();
            return 'deleted';
        } else {
            $like = new like;
            $like->user_id = Auth::id();
            $like->post_id = $request->id;
            $like->save();
        }
    }

    public function addComment(request $request) {
        $response = array();
        if (empty($request->comment)) {
            $response = array(
                'response_code' => 202,
                'response_status' => 'error',
                'message' => 'Please enter your comment.',
            );
        } else {
            $comment = new comment();
            //$currentUser = Auth::user();
            $comment->name = $request->name;
            $comment->email = $request->email;
            $userId = Auth::id();
            $comment->user_id = ($userId) ? $userId : 0;
            $comment->comment = $request->comment;

            $comment->approved = 0;
            $comment->post_id = $request->post_id;

            $isCommentAdded = $comment->save();

            if ($isCommentAdded) {
                $response = array(
                    'response_code' => 200,
                    'response_status' => 'success',
                    'message' => 'Thanks for your comment, when your comment approved we will display.',
                );
            } else {
                $response = array(
                    'response_code' => 201,
                    'response_status' => 'error',
                    'message' => 'Comment not added.',
                );
            }
        }
        echo json_encode($response);
    }

    public function saveCommentLike(request $request) {
        $likecheck = commentlike::where(['user_id' => Auth::id(), 'comment_id' => $request->commentid, 'post_id' => $request->postid])->first();
        $response = array(
            'response_code' => 205,
            'response_status' => 'error',
            'message' => 'Some thing went wrong.',
        );
        if ($likecheck) {
            $isDeleted = commentlike::where(['user_id' => Auth::id(), 'comment_id' => $request->commentid, 'post_id' => $request->postid])->delete();
            if ($isDeleted) {
                $response = array(
                    'response_code' => 203,
                    'response_status' => 'success',
                    'message' => 'Successfully unlike.',
                );
            }
        } else {
            $like = new commentlike;
            $like->user_id = Auth::id();
            $like->post_id = $request->postid;
            $like->comment_id = $request->commentid;
            $saved = $like->save();
            if ($saved) {
                $response = array(
                    'response_code' => 204,
                    'response_status' => 'success',
                    'message' => 'Successfully like.',
                );
            }
        }

        return json_encode($response);
    }
    
    
}
