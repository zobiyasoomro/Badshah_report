@extends('layouts.master')
@section('content')

@include('components.pagesbanner', [
        'banner_title' => 'VIP Planes',
        'banner_button_text' => 'Boot Your Account',
        'banner_button_url' => 'We’re Here to Help',
        'banner_description' => 'Have questions, feedback, or want to talk with us? Our team is ready to assist you anytime.'
    ])


@include('components.btns')

<style>
  :root {
    --bg-dark: #142B40;
    --bg-card: #1E3A52;
    --accent-cyan: #25D1E0;
    --text-main: #FFFFFF;
    --text-dim: #A0B3C6;
    --border-line: rgba(37, 209, 224, 0.15);
  }

  body { background: var(--bg-dark); color: var(--text-main); font-family: 'Inter', sans-serif; }
</style>

@include('components.tiers')
@include('components.benefits')
@include('components.host')
@include('components.progression')
@include('components.faq')

@endsection