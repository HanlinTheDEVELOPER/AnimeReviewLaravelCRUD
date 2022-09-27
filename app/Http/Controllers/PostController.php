<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //customer create page or home page
    public function create()
    {
        $posts = Post::when(request('searchKey'), function ($query) {
            $key = request('searchKey');
            $query->where('title', 'like', '%' . $key . '%');
        })
            ->orderBy('created_at', 'desc')->paginate(3);
        // dd($posts);
        return view('create', compact('posts'));
    }

    //creating new post
    public function createPost(Request $res)
    {

        $this->checkValidate($res);
        $response = $this->getPostData($res);

        if ($res->hasFile('postImage')) {
            $imageName = uniqid() . $res->file('postImage')->getClientOriginalName();
            $res->file('postImage')->storeAs('public', $imageName);
            $response['image'] = $imageName;
        }

        Post::create($response);
        return redirect()->route('post#home')->with(['createSession' => 'Created Successfully']);
    }

    //deleting post
    public function deletePost($id)
    {
        $photoToDelete = Post::select('image')->where('id', $id)->first()->image;
        if ($photoToDelete != null) {
            Storage::delete('/public/' . $photoToDelete);
        }
        Post::where('id', $id)->delete();
        return back();
    }

    //view Page
    public function updatePage($id)
    {
        $post = Post::where('id', $id)->get()->toArray()[0];
        return view('update', compact('post'));
    }

    //edit Page
    public function editPage($id)
    {
        $post = Post::where('id', $id)->first()->toArray();
        return view('edit', compact('post'));
    }

    //saving edit data
    public function saveEdit(Request $request, $id)
    {
        $this->checkValidate($request);

        $editData = $this->getPostData($request);

        if ($request->hasFile('postImage')) {

            $photoToDelete = Post::select('image')->where('id', $id)->first()->image;
            Storage::delete('/public/' . $photoToDelete);

            $imageName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public', $imageName);
            $editData['image'] = $imageName;
        }
        Post::where('id', $id)->update($editData);
        return redirect()->route('updatePage', $id)->with(['updateSession' => 'Updated Successfully']);
    }
    //get post data
    private function getPostData($data)
    {
        return [
            'title' => $data->postTitle,
            'descrption' => $data->postDescription,
        ];
    }
    //checking validation
    private function checkValidate($res)
    {
        $validateRules = [
            "postTitle" => "required|min:2|unique:posts,title," . $res->postId,
            'postDescription' => "required",
            'postImage' => 'mimes:jpg,jpeg,img,webp,png',
        ];
        $validateMesage = [
            'postTitle.required' => 'You must supply anime title',
            'postTitle.min' => 'Anime Title must be at least 2 characters',
            'postTitle.unique' => 'There is already a post with this title. Try another one.',
            'postDescription.required' => 'You must supply the review',
        ];
        Validator::make($res->all(), $validateRules, $validateMesage)->validate();
    }
}
