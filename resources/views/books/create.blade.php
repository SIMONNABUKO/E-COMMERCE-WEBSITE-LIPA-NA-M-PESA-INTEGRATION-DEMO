@extends('layouts.store')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header mb-5">{{ __('Create Book') }}</div>

                <div class="card-body">
                    <form method="POST" class="mb-5" action="{{ route('book.store') }}">
                        @csrf

                        <div class="form-group row mb-1">
                            <label for="Book Title" class="col-md-4 col-form-label text-md-right">{{ __('Book Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Book Price')
                                }}</label>

                            <div class="col-md-6">
                                <input id="price" type="price" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="desc" class="col-md-4 col-form-label text-md-right">{{ __('Book Description')
                                }}</label>

                            <div class="col-md-6">
                                <textarea name="desc" id="" cols="55" rows="10"></textarea>

                                @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Book') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection