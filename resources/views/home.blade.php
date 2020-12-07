@extends('template')

@section('title', 'Home Blog')

@section('content')

<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="my-4">Artikel
      </h1>

      <!-- Blog Post -->
      @foreach((array)$data as $artikel)

        <div class="card mb-4">
          <div class="card-body">
            <h2 class="card-title">{{ $artikel->title }}</h2>
            <p class="card-text">{{ substr($artikel->konten, 0, 50) }}</p>
            <a href="{{ route('blog.show',$loop->index) }}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          
        </div>
      @endforeach


    </div>
  </div>
  <!-- /.row -->

</div>

@endsection
