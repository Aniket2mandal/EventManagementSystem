@extends('USER.layouts.navigation')

@section('content1')
    {{-- FOR SUCESS MESSAGE --}}
    {{-- @include('admin.message') --}}

    <div class="success">
        @if (session('success'))
            <div class='container alert alert-success'>{{ session('success') }}</div>
        @endif
    </div>

    <div class="error">
        @if (session('error'))
            <div class='container alert alert-success'>{{ session('error') }}</div>
        @endif
    </div>
    <div class="category-header">
        <h1>CATEGORY TABLE</h1>
    </div>

    <table class=" table">
        <thead>
            <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach($category_data as $items)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$items->name}}</td>
                <td><a href="{{route('categories.edit',$items->id)}}" class="btn-primary "><img src="/raw/editimg.png" style="height:25px;width:20px"></a>
                    <a href="{{route('categories.delete',$items->id)}}" class="btn-danger" id="del_btn"><img src="/raw/deleteimg.png"
                            style="height:25px;width:20px"></a>

                </td>
            </tr>
@endforeach
        </tbody>
    </table><br>
    <a href="{{ route('categories.create') }}"class=" btn-success">Create Category</a>
@endsection
