@extends('layouts.app')
{{-- <html lang="{{ app()->getLocale() }}" > --}}
    {{-- dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.headline')</title>
 @push('styles')
 <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
            /* direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}; */
        }

        .lang-switcher {
            margin-bottom: 20px;
        }

        .lang-switcher a {
            margin: 0 5px;
            text-decoration: none;
            font-weight: normal;
        }

        .lang-switcher .active {
            text-decoration: underline;
            color: #007BFF;
            font-weight: bold;
        }
    </style>
@endpush


@section('content')
    <div class="lang-switcher">
        <strong>@lang('messages.language'):</strong>
        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a> |
        <a href="{{ route('lang.switch', 'ar') }}" class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}">العربية</a>
    </div>

    <h1>@lang('messages.welcome')</h1>
    <h2>@lang('messages.headline')</h2>
    <p>@lang('messages.description')</p>

@endsection

