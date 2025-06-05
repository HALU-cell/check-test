@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        <h2>お問い合わせありがとうございました</h2>
        <div class="thanks__lead">
            <p>Thank you</p>
        </div>
        <div class="form__button">
            <a href="{{ url('/') }}" class="form__button-home">HOME</a>
        </div>
    </div>
</div>
@endsection
