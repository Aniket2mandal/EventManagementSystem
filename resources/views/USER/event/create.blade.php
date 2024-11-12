@extends('USER.layouts.navigation')
@section('content1')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Create Event</h4>
            </div>
            <div class="card-body">
                <form id="formevent" method="POST" action="{{ route('events.store') }}" >
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="{{ old('title') }}" name="title">
                        {{-- Error Message --}}
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea class="form-control" name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                        {{-- Error Message --}}
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" value="{{ old('date') }}" name="date">
                        {{-- Error Message --}}
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Location">Location</label>
                        <input type="place" class="form-control" value="{{ old('location') }}" name="location">
                        {{-- Error Message --}}
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" class="form-control" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ old('CategoryId') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        {{-- Error Message --}}
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-create">Add Event</button>
                </form>
            </div>
        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#formevent').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('events.store') }}',
                    type: 'POST',
                    data: formData,
                })
            })
        })
    </script> --}}
@endsection
