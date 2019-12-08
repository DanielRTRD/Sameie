@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Du er medlem av disse:') }}</div>
                <div class="card-body">
                    @foreach (Auth::user()->condos as $condo)
                        <p class="mb-2"><a href="{{ route('c-show', $condo->orgnr) }}">{{ $condo->orgnr ?? '' }} &middot; {{ $condo->name ?? '' }}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
