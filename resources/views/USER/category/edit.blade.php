@extends('USER.layouts.navigation')

@section('content1')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Edit Category</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('categories.update',$category_data->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" class="form-control" id="name" value="{{$category_data->name}}" name="name">
                        {{-- Error Message --}}
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-create">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
