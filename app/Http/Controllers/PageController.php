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
        $pages = Page::get()->first()->getAttributes();

        $data = [];

        foreach ($pages as $key => $page) {
            array_push($data, [
                'name' => ucwords(str_replace('_', ' ', strtolower($key))),
                'slug' => str_replace('_', '-', strtolower($key))
            ]);
        }

        return view('page.index', ['data' => $data]);
    }

    public function show($slug)
    {
        $key = str_replace('-', '_', strtolower($slug));
        $query = Page::get()->first()->getAttributes();

        if (!array_key_exists($key, $query)) {
            abort(404);
        }

        $pages = [];

        foreach ($query as $key => $page) {
            array_push($pages, [
                'name' => ucwords(str_replace('_', ' ', strtolower($key))),
                'slug' => str_replace('_', '-', strtolower($key)),
                'key' => $key,
                'text' => $page
            ]);
        }

        $page = null;

        foreach ($pages as $item) {
            if ($item['slug'] === $slug) {
                $page = $item;
            }
        }

        return view('page.show', ['pages' => $pages, 'form' => $page]);
    }

    public function update(Request $request)
    {
        $data = request()->except('_token');
        $query = DB::table('pages')
            ->where('how_it_works', '=', null)
            ->orWhere('how_it_works', '!=',  null);

        // dump($data);
        $query->update($data);

        Session::flash('message',  'Page Updated Successfully !');

        $slug = str_replace('_', '-', strtolower(key($data)));
        return redirect('pages/' . $slug);
    }
}
