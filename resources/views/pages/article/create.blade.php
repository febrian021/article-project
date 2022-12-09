@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mt-2">
                                    Article Management Create
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route($route . 'store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea class="form-control" name="content" rows="5"></textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Article Image</label>
                                <input class="form-control" name="article_image" type="file" id="formFile">
                                @error('article_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input class="form-control" name="user_id" hidden type="text">

                            {{-- <div class="mb-3">
                                <label for="formFile" class="form-label">Article Creator</label>
                                <select class="form-select" name="user_id" aria-label="Default select example">
                                    <option selected disabled>Select Creator</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-3">Submit</button>
                                <a href="{{ route($route . 'index') }}" class="btn btn-secondary ml-3">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
