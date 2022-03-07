@extends('tenantsite::layouts.master')
@if(session()->has("currentTenant"))
    @section('title')
       {{ __(session("currentTenant")->name) }}
    @endsection
@endif
@section('content')
    <h1>Hello World</h1>
    <p>
        This view is loaded from module: {!! config('tenantsite.name') !!}  @if(session()->has("currentTenant")) with Tennant: {{ __(session('currentTenant')->name) }}@endif
    </p>
    <div>
        <span>{{ auth()->user()->email }}</span>
        @foreach($posts as $postTitle)
            <p>{{ $postTitle}}</p>
        @endforeach
    </div>
@endsection
