<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index () {
        return Tag::all();
    }
    public function show($id) {
        return Tag::find($id);
    }
    public function store (Request $request ) {
        $request->validate([
            'title' => 'bail|required|string|max:255'
        ]);
        return Tag::create($request->all());
    }
    public function update (Request $request, $id) {
        $Tag = Tag::findOrFail($id);
        $request->validate([
            'title' => 'bail|required|string|max:255',
        ]);
        $Tag->update($request->all());

        return $Tag;
    }
    public function delete( Request $request, $id) {
        $Tag = Tag::findOrFail($id);
        $Tag->tasks()->detach();
        $Tag->delete();

        return 204;
    }
}
