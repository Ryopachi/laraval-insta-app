<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;


class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(4);

        $uncategorized_post = 0;         // it hold how many post that are uncategorized
        $all_posts = $this->post->all(); //retrieved all the posts
        foreach ($all_posts as $post) {
            if ($post->categoryPost->count() == 0) { // if true that count is 0
                $uncategorized_post++; //increment this property if the post don't have any category
            }
        }
        return view('admin.categories.index')
            ->with('all_categories', $all_categories)
            ->with('uncategorized_post', $uncategorized_post);
    }

    public function store(Request $request){
        # 1. Validate the data first
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        $this->category->name = ucwords(strtolower($request->name)); //SWIMMING -> swimming -> Swimming
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'new_name' => 'required|min:1|max:50|unique:categories,name,' . $id
        ]);

        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->new_name));
        $category->save();

        return redirect()->back();
    }

    public function destroy($id){
        $this->category->destroy($id);
        return redirect()->back();
    }
}
