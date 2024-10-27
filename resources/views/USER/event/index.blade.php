@extends('USER.layouts.navigation')

@section('content1')

    {{-- FOR SUCESS MESSAGE --}}
    {{-- @include('admin.message') --}}

    <div class="success">
        @if(session('success'))
        <div class='container alert alert-success'>{{session('success')}}</div>
       @endif
      </div>
    <div class="category-header">
        <h1>EVENTS TABLE</h1>
    </div>

  <table  class=" table">
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
        @php
        $i=1;
        @endphp
        @foreach($event_data as $items)
      <tr>
        <th scope="row">{{$i++}}</th>
        <td>{{$items->title}}</td>
        <td>
            {{-- USED BELONGSTO RELATION IN EVENT MODEL --}}
          {{$items->category->name}}
        </td>
        <td>{{$items->date}}</td>
        <td>{{$items->location}}</td>
        <td>{{$items->description}}</td>
        <td><a href="{{route('events.edit',$items->id)}}" class="btn-primary "><img src="/raw/editimg.png" style="height:25px;width:20px"></a>
        <a href="{{route('events.delete',$items->id)}}" class="btn-danger" id="del_btn"><img src="/raw/deleteimg.png" style="height:25px;width:20px"></a>

    </td>
      </tr>
@endforeach
    </tbody>
  </table><br>
  <a href="{{route('events.create')}}"class=" btn-success">Create Event</a>
@endsection
