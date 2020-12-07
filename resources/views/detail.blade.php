@extends('template')

@section('title', $artikel->title)

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">



      <div class="card my-5">
        <div class="card-body">
          <h1>{{ $artikel->title }}</h1>
          <p class="text-muted">Posted on {{ $artikel->date_time }} by {{ $artikel->author }}</p>
          <p>{{ $artikel->konten }}</p>
        </div>
        <div class="card-footer">
          <a href="{{ route('blog.index') }}" class="btn btn-primary">Kembali</a>
          <a href="{{ route('blog.edit', $id) }}" class="btn btn-primary">Edit</a>
          <input type="submit" form="formDelete" role="button" class="btn btn-primary" value="Delete"></input>

        </div>
      </div>
    </div>
  </div>
</div>

<form action="{{ route('blog.destroy', $id) }}" id="formDelete" method="POST">
  @method('DELETE')
  @csrf

</form>

@endsection
