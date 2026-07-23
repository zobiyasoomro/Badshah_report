@extends('layouts.master')

@section('content')

@include('components.pagesbanner', [
    'banner_title' => 'ABOUT US',
    'banner_button_text' => 'LEARN MORE',
    'banner_button_url' => 'WHY YOU CHOOSE US',
    'banner_description' => 'Have questions, feedback, or want to talk with us? Our team is ready to assist you anytime.'
])

@include('components.about')

@endsection