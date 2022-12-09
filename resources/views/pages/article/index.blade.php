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
                                    <a href="{{ route($route . 'create') }}" class="btn btn-md btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Article Image</th>
                                    <th scope="col">Article Creator</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $key => $data)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ Str::of($data->content)->limit(60) }}</td>
                                        <td> <a target="_blank"
                                                href="{{ asset('storage') . '/' . $data->article_image }}">Click
                                                Image</a> </td>
                                        <td>{{ $data->user->name }} </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                    class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route($route . 'edit', $data->id) }}">Edit</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route($route . 'show', $data->id) }}">Show</a></li>
                                                    <hr>
                                                    <li> <a href="#" class="dropdown-item">
                                                            <form method="POST" id="delete-form"
                                                                action="{{ route($route . 'destroy', $data->id) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <span type="button" class="btnDelete">Delete</span>
                                                            </form>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $articles->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // console.log('sadasd')
            $(document).ready(function() {

                $('.btnDelete').click(function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).parent().submit()
                        }
                    })
                })

            })
        </script>
    @endpush
@endsection
