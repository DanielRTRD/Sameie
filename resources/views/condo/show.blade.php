@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ $orgnr ?? '' }} &middot; {{ $name ?? '' }}</div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Informasjon fra BRREG</div>
                <div class="card-body">
                    <p>{{ __('Navn:') }} {{ $navn }}</p>
                    <p>{{ __('Organisasjonsform:') }} {{ $organisasjonsform['beskrivelse'] }}</p>
                    <p>{{ __('Stiftelsesdato:') }} {{ ucfirst(\Carbon\Carbon::parse($stiftelsesdato)->isoFormat('LL')) }}</p>
                    <p>{{ __('Registreringsdato:') }} {{ ucfirst(\Carbon\Carbon::parse($registreringsdatoEnhetsregisteret)->isoFormat('LL')) }}</p>
                    <p>{{ __('Adresse:') }}</p>
                    <address>
                        {{ $forretningsadresse['adresse'][0] }}<br>
                        {{ $forretningsadresse['adresse'][1] }}<br>
                        {{ $forretningsadresse['postnummer'] }} {{ $forretningsadresse['poststed'] }}
                    </address>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
