@extends('USER.layouts.navigation')

@section('content1')
    <div class="success">
        @if(session('success'))
            <div class='container alert alert-success'>{{ session('success') }}</div>
        @endif
    </div>
    <div class="category-header">
        <h1>EVENTS TABLE</h1>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Location</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($event_data as $items)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $items->title }}</td>
                    <td>{{ $items->category->name }}</td>
                    <td>{{ $items->date }}</td>
                    <td>{{ $items->location }}</td>
                    <td>{{ $items->description }}</td>
                    <td>
                        <a href="{{ route('events.edit', $items->id) }}" class="btn-primar">
                            <img src="/raw/editimg.png" style="height:25px;width:20px">
                        </a>
                        <a href="{{ route('events.delete', $items->id) }}" class="btn-dange" id="del_btn">
                            <img src="/raw/deleteimg.png" style="height:25px;width:20px">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('events.create') }}"class=" btn-success">Create Event</a>
    {{-- <button class="btn btn-successs" data-toggle="modal" data-target="#createEventModal">Create Event</button> --}}

    <!-- Modal -->
    <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" value="{{ old('title') }}" name="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" value="{{ old('date') }}" name="date">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" value="{{ old('location') }}" name="location">
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categoriesid as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#eventForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData); // Debug statement

            $.ajax({
                url: '{{ route('events.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log("Success response:", response); // Debug statement
                    alert('Event created successfully');
                    location.reload();
                },
                error: function(xhr) {
                    console.log("Error response:", xhr); // Debug statement
                    var errors = xhr.responseJSON ? xhr.responseJSON.errors : {'error': 'Internal Server Error'};
                    var errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('.modal-body').prepend(errorHtml);
                }
            });
        });
    });
</script>

@endsection
