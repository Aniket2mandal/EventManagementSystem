@extends('USER.layouts.navigation')

@section('content1')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Create Category</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('categories.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                            name="name">
                        {{-- Error Message --}}
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-create">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
