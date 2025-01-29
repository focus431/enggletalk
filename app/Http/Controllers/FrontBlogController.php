<?php

// BlogController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
// ...

class FrontBlogController extends Controller
{


  public function latest()
  {
    
      $latestBlogs = Blog::latest()->take(5)->get(); // 获取最新的5篇博客
      return response()->json($latestBlogs);
  }
  



  public function showBlogDetails($id)
  {
      $blog = Blog::findOrFail($id); // 根據ID查找博客，如果沒有找到則拋出一個404異常
      return view('blog-details', compact('blog')); // 返回博客詳細信息的視圖，並傳遞博客數據
  }


  

  // 顯示博客列表
  public function showBlog()
  {
    $blogs = Blog::all();
    return view('blog-grid', compact('blogs'));
  }

  public function apiShowBlogs(Request $request)
{
    $perPage = 10;

    $query = Blog::query();

    // 如果有搜索词，则添加搜索条件
    if ($searchTerm = $request->input('search')) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        });
    }

    // 检查是否有分类参数
    if ($category = $request->input('category')) {
        $query->where('category', $category);
    }

    // 检查是否有子分类参数
    if ($subCategory = $request->input('subCategory')) {
        $query->where('sub_category', $subCategory);
    }

    // 根据查询条件获取博客并分页
    $blogs = $query->paginate($perPage);

    return response()->json($blogs);
}


}
