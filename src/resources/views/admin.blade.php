@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
<ul class="header-nav">
    @if (Auth::check())
    <li class="header-nav__item">
        <form class="logout__link" action="/logout" method="post">
            @csrf
            <button class="logout__button-submit">logout</button>
        </form>
    </li>
    @endif
</ul>
@endsection

@section('content')
    @livewire('admin-modal')
</div>

@endsection
