@extends('layouts.app')

@section('content')
<div class="container">
	{{ Breadcrumbs::render('c') }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Administrer:') }}</div>
                <div class="card-body">
                    @foreach ($condos as $condo)
                        <p><a href="{{ route('c-edit', $condo->orgnr) }}">{{ $condo->orgnr ?? '' }} &middot; {{ $condo->name ?? '' }}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
