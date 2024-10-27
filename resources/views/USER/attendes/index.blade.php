@extends('USER.layouts.navigation')

@section('content1')
    {{-- FOR SUCESS MESSAGE --}}
    {{-- @include('admin.message') --}}

    <div class="success">
        @if (session('success'))
            <div class='container alert alert-success'>{{ session('success') }}</div>
        @endif
    </div>
    <div class="category-header">
        <h1>ATTENDES TABLE</h1>
    </div>

    <table class=" table">
        <thead>
            <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Event</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($attendee as $items)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $items->name }}</td>
                    <td>{{ $items->email }}</td>
                    <td>{{$items->event->title }}</td>
                    <td><a href="{{ route('attendes.edit', $items->id) }}" class="btn-primary "><img src="/raw/editimg.png"
                                style="height:25px;width:20px"></a>
                        <a href="{{ route('attendes.delete', $items->id) }}" class="btn-danger" id="del_btn"><img
                                src="/raw/deleteimg.png" style="height:25px;width:20px"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table><br>
    <a href="{{ route('attendes.create') }}"class=" btn-success">Create Attendee</a>
@endsection
