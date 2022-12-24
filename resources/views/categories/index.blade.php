@extends('layouts.main')

@section('content')
    <ul>
        @include('categories.subcategories',['categories'=>$categories])
    </ul>
@endsection
