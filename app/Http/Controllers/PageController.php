<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $data = Page::all();
        $users = DB::table('pages')->get();

        dump($users);
        return view('page.index', ['data' => $data]);
    }

    public function show($slug)
    {
        $index = Page::all();
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            abort(404);
        }

        return view('page.show', ['pages' => $index, 'form' => $page]);
    }

    public function update(Request $request)
    {
        $data = request()->except('_token');
        
        $page = Page::where('slug', $data['slug'])->first();

        $page->content = $data['content'];
        $page->save();

        Session::flash('message',  'Page Updated Successfully !');
        return redirect('pages/' . $data['slug']);
    }
}
