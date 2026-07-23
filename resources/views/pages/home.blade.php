@extends('layouts.master')
@section('title', 'Home')
@section('content')

@include('components.user-profile-section')
@include('components.btns')
@include('components.about')

@include('components.testimonial')
@include('components.faq')

@endsection