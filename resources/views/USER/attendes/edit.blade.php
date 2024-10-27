@extends('USER.layouts.navigation')
@section('content1')



<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Add Attendee</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('attendes.update',$attendee_data->id)}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control"  value="{{$attendee_data->name}}" name="name">
                    {{-- Error Message --}}
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control"  value="{{$attendee_data->email}}" name="email">
                    {{-- Error Message --}}
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="event_id">Event</label>
                    <select id="event_id" class="form-control" name="event_id">
                        <option value="">Select Event</option>
                        @foreach($events as $item)
                            <option value="{{ $item->id }}" {{ old('event_id') == $item->id ? 'selected' : '' }}>{{ $item->title}}</option>
                        @endforeach
                    </select>
                    {{-- Error Message --}}
                    @error('event_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-create">Edit Attendee</button>
            </form>
        </div>
    </div>
</div>

@endsection

