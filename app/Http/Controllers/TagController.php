<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Exception;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.tag.index', compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|min:3|max:50',
        ]);

        try {
            $tag = Tag::create([
                'name' => $request->name,
                'slug' => str::slug($request->name)
            ]);
            return redirect('/tag')->with(['success' => 'Tag : <strong>' . $tag->name . '</strong> Ditambah']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:50'
        ]);

        try {
            $tag = Tag::findOrFail($id);
            $tag->update([
                'name' => $request->name,
                'slug' => str::slug($request->name)
            ]);
            return redirect('/tag')->with(['success' => 'Tag : <strong>' . $tag->name . '</strong> Diupdate']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->back()->with(['success' => 'Tag : <strong>' . $tag->name . '</strong> Diupdate']);
    }
}
