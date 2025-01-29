<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->take(4)->get(); // 獲取最新的5篇博客
        return view('index', compact('blogs'));
    }
}
