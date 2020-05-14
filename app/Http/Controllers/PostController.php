<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Exception;
use File;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $category = Category::all();
        return view('admin.post.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'category_id' => 'required|integer|exists:category,id',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            //default $photo = null
            $photo = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($request->hasFile('photo')) {
                //maka menjalankan method saveFile()
                $photo = $this->saveFile($request->title, $request->file('photo'));
            }


            //Simpan data ke dalam table products
            $post = Post::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'photo' => $photo,
                'slug' => str::slug($request->title),
                'user_id' => Auth::id(),
            ]);

            //menyimpan tag
            //tags itu nama array di select2
            //dan tag() ini adalah relasion di model Post
            $post->tag()->attach($request->tags);

            //jika berhasil direct ke produk.index
            return redirect('post')->with(['success' => '<strong>' . $post->title . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($title, $photo)
    {
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = str::slug($title) . time() . '.' . $photo->getClientOriginalExtension();
        //set path untuk menyimpan gambar
        $path = public_path('uploads/post');
        //cek jika uploads/post bukan direktori / folder
        if (!File::isDirectory($path)) {
            //maka folder tersebut dibuat
            File::makeDirectory($path, 0777, true, true);
        }
        //simpan gambar yang diuplaod ke folrder uploads/post
        Image::make($photo)->save($path . '/' . $images);
        //mengembalikan nama file yang ditampung divariable $images
        return $images;
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
        $post = Post::findOrFail($id);
        $category = Category::all();
        $tags = Tag::all();

        return view('admin.post.edit', compact('tags', 'post', 'category'));
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
            'title' => 'required|string|max:50',
            'category_id' => 'required|integer|exists:category,id',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //query select berdasakan id
            $post = Post::findOrFail($id);
            $photo = $post->photo;

            //cek jika ada gambar yang di kirim dari form
            if ($request->hasFile('photo')) {
                //cek, jika photo tidak kosong maka file yang yang ada di dalam folder uploads/post akan di hapus
                !empty($photo) ? File::delete(public_path('uploads/post/' . $photo)) : null;
                //upload file menggunakan method save file yang suda di buat
                $photo = $this->saveFile($request->title, $request->file('photo'));
            }

            //perbaharui data di database
            $post->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'photo' => $photo,
                'slug' => str::slug($request->title)
            ]);

            //menyimpan tag
            //tags itu nama array di select2
            //dan tag() ini adalah relasion di model Post
            $post->tag()->sync($request->tags);

            return redirect('post')->with(['success' => '<strong>' . $post->title . '</strong> Di Perbahrui']);
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
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with(['success' => '<strong>' . $post->title . '</strong> Dihapus']);
    }

    public function tampilHapus()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('admin.post.hapus', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with(['success' => '<strong>' . $post->title . '</strong> Direstore']);
    }

    public function delete($id)
    {
        //query untuk memilih data yang sudah di hapus berdasakan id
        $post = Post::withTrashed()->where('id', $id)->first();
        //mengecek, jika field foto tidak null / kosong (field foto terisi)
        if (!empty($post->photo)) {
            //file akan di hapus dari folder uploads/post
            File::delete(public_path('uploads/post/' . $post->photo));
        }
        //query hapus permanen data dari table
        $post->forceDelete();

        //hapus data dari table
        return redirect()->back()->with(['success' => '<strong>' . $post->title . '</strong> Berhail Dihapus']);
    }
}
