@extends('master')

@section('content')
    <div class="container p-5">
        <div class="row">
            <form action="{{ route('saveEdit', $post['id']) }}" method="POST" class="my-3" enctype="multipart/form-data">
                @csrf
                <div class="mt-3">
                    <input type="hidden" name="postId" value="{{ $post['id'] }}">
                    <label class="mb-2">Anime Title</label>
                    <input type="text" name="postTitle"
                        class="form-control @error('postTitle')
                        is-invalid
                    @enderror"
                        value="{{ old('postTitle', $post['title']) }}">
                    @error('postTitle')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3 row">
                    <div class="col-5">
                        <label for="">Cover Photo</label>
                        <img src="{{ asset('/storage/' . $post['image']) }}" alt="" class="img-thumbnail">
                        <input type="file" name="postImage"
                            class="form-control @error('postImage')
                        is-invalid
                    @enderror">
                        @error('postImage')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-7">
                        <label class="mb-2">Review</label>
                        <textarea cols="30" rows="10" name="postDescription"
                            class="form-control @error('postDescription')
                        is-invalid
                    @enderror">{{ old('postDescription', $post['descrption']) }}</textarea>
                        @error('postDescription')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 row ">
                    <input type="submit" class="btn btn-danger col-4 offset-1" value="Save">

                    <a href="{{ route('updatePage', $post['id']) }}" class="btn btn-outline-danger col-4  offset-1">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
@endsection
