<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = json_decode(Storage::get('articles.json', true));
        return view('home', [
          'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
       {
         $artikel = [];
            $artikelId = 1;

            if (Storage::exists('/articles.json')) {
                $artikel = json_decode(Storage::get('/articles.json'));
                $lastid = collect($artikel)->last();
                $artikelId = $lastid ? collect($artikel)->last()->id + 1 : 1;
            }

            $data = $request->only(['title', 'author', 'konten']);
            $data['date_time'] = date('Y-m-d H:i:s');
            $data['id'] = $artikelId;

            array_push($artikel, $data);

            Storage::put('/articles.json', json_encode($artikel, JSON_PRETTY_PRINT));



            return redirect('/blog');

       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = json_decode(Storage::get('articles.json'));

        abort_if(!isset($data[$id]), 404);


        return view('detail', [
          'id' => $id,
          'artikel' => $data[$id]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = json_decode(Storage::get('articles.json'));

        abort_if(!isset($data[$id]), 404);

        return view('edit', [
          'id' => $id,
          'artikel' => $data[$id]
        ]);
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
      $data = json_decode(Storage::get('articles.json'), true);
      abort_if(!isset($data[$id]), 404);

      $data[$id] = array_replace($data[$id], $request->except(['_method', 'token']));
      Storage::put('articles.json', json_encode($data));

      return redirect('/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = json_decode(Storage::get('articles.json'), true);
      abort_if(!isset($data[$id]), 404);

      array_splice($data, $id, 1);

      Storage::put('articles.json', json_encode($data));
      return redirect('/blog');
    }
}
