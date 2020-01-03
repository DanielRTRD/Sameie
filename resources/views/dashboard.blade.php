@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Abonnementene dine</div>
                <ul class="list-group list-group-flush">
                    @if($subscriptions->count() === 0)
                        <li class="list-group-item"><em>Du har ingen.</em></li>
                    @endif
                    @foreach($subscriptions as $subscription)
                        <li class="list-group-item">{{ ucfirst($subscription->name) }} ({{ ucfirst($subscription->stripe_plan) }}) <div class="badge badge-primary float-right">{{ ucfirst($subscription->stripe_status) }}</div></li>
                    @endforeach
                </ul>
            </div>
        </div>
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
