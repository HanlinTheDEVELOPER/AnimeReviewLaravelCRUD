@extends('master')

@section('content')
  <div class="container">
    <div class="row mt-5">
      <div class="col-5 p-3">
        <div>
          {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif --}}
          <form action="{{ route('createPost') }}"
                enctype="multipart/form-data"
                method="POST">
            @csrf
            <div class="mb-3">
              <label class="text-primary">Anime Title</label>
              <input class="form-control @error('postTitle')
                            is-invalid
                        @enderror"
                     name="postTitle"
                     placeholder="Enter Anime Title"
                     type="text"
                     value="{{ old('postTitle') }} ">
              @error('postTitle')
                <small class="text-danger">{{ $message }}</small>
              @enderror

            </div>
            <div class="mb-3">
              <label class="text-primary">Review</label>
              <textarea class="form-control @error('postDescription')
                            is-invalid
                        @enderror mb-3"
                        cols="30"
                        name="postDescription"
                        placeholder="Enter Your Review..."
                        rows="10">{{ old('postDescription') }} </textarea>
              @error('postDescription')
                <small class="text-danger">{{ $message }}</small>
              @enderror

            </div>
            <div class="mb-3">
              <input class="form-control @error('postImaage')
                            is-invalid
                        @enderror"
                     name="postImage"
                     type="file">
              @error('postImage')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div>
              <input class="btn btn-primary float-end"
                     type="submit"
                     value="Post">
            </div>
          </form>

        </div>
      </div>
      <div class="col-7">
        <div class="data-container">
          <div class="row">
            <div class="col-5">
              <h6> Total:{{ $posts->total() }}</h6>
            </div>
            <form action="{{ route('post#home') }}"
                  class="col-5 offset-2 d-flex"
                  method="get">
              <input class="form-control"
                     name="searchKey"
                     placeholder="Enter Post Title"
                     type="search">
              <button class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
            </form>
          </div>
          @foreach ($posts as $each)
            <div class="post mb-3 p-3 shadow-sm">
              <div class="row">
                <h5 class="col-5">{{ $each['title'] }}</h5>
                <h5 class="col-5 offset-2">{{ $each['created_at']->format('F-j Y') }}</h5>
              </div>
              <div class="row">
                @if ($each['image'] == null)
                  <img alt=""
                       class="col-2"
                       src="{{ asset('/storage/myanimelist_m.png') }}">
                @else
                  <img alt=""
                       class="col-2"
                       src="{{ asset('/storage/' . $each['image']) }}">
                @endif
                <p class="text-muted col-10">
                  {{ Str::words($each['descrption'], 20, '...') }}
                </p>
              </div>
              <div class="text-end">
                <a href="{{ route('deletePost', $each['id']) }}">
                  <button class="btn btn-danger"><i class="fa-solid fa-trash me-1"></i>
                    ဖျက်သိမ်းရန်</button>
                </a>
                <a href="{{ route('updatePage', $each['id']) }}">
                  <button class="btn btn-primary"><i class="fa-solid fa-file-lines me-1"></i>အပြည့်အစုံ
                    ဖတ်ရန်</button>
                </a>
              </div>
            </div>
          @endforeach
        </div>
        {{-- @foreach ($posts['links'] as $each)
                <a href="{{ $each['url'] }}" class="btn btn-dark text-white">{{$each['label']}} </a>
            @endforeach --}}
        {{ $posts->appends(request()->query())->links() }}
      </div>
    </div>
  </div>
@endsection
