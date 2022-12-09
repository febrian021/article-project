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
                                    Article Management
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route($route . 'index') }}" class="btn btn-md btn-secondary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage') . '/' . $article->article_image }}" width="30%">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <h4><b>{{ $article->title }}</b></h4>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <div class="col-md-10">
                                <p>{{ $article->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
