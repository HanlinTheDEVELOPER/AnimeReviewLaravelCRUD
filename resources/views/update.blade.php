@extends('master')

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="my-3">
                <a href="{{ route('post#home') }}" class="text-decoration-none text-black">
                    <i class="fa-solid fa-arrow-left me-2"></i>back
                </a>
                {{-- @if (session('updateSession'))
                    <span>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> {{session('updateSession')}} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </span>
                @endif --}}
            </div>
            <div class="mt-3">
                <h1>{{ $post['title'] }}</h1>
                <div class="row mt-5">
                    @if ($post['image'] == null)
                        <img src="{{ asset('/storage/myanimelist_m.png') }}" alt="" class="col-4 img-thumbnail">
                    @else
                        <img src="{{ asset('/storage/' . $post['image']) }}" class="col-4 img-thumbnail">
                    @endif
                    <p class="col-7 offset-1">{{ $post['descrption'] }}</p>
                </div>
            </div>
            <div class="offset-11 mt-3">
                <a href="{{ route('editPage', $post['id']) }}" class="btn btn-info px-3 text-white">
                    <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endsection
