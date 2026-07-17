@extends('layouts.master')
@section('title', 'Home')
@section('content')

@include('components.user-profile-section')
@include('components.btns')

@include('components.faq')
@include('components.testimonial')

@endsection