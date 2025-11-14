<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function landing()
    {
        return view('index');
    }

    public function blogsLanding()
    {
        $blogs = Blogs::with('category')->where('status', 1)->get();

        return view('Layouts.contents.blogs', compact('blogs'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Admin.dashboard');
        return view('Admin.layouts.app');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function home()
    {
        return view('Admin.contents.home');
    }

    public function users()
    {
        $users = User::all();

        return view('Admin.contents.users', compact('users'));
    }

    public function blogs()
    {
        $blogs = Blogs::with('category')->get();
        $categories = Categories::all();

        return view('Admin.contents.blogs', compact('blogs', 'categories'));
    }

    public function categories()
    {
        $categories = Categories::all();

        return view('Admin.contents.categories', compact('categories'));
    }
}
