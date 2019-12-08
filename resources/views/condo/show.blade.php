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
            <h3>{!! $condo->orgnr.' &middot;' ?? '' !!} {{ $condo->name ?? '' }}</h3>
            <hr>
            <div class="card">
                <div class="card-header">Registrerte enheter</div>
                <ul class="list-group list-group-flush">
                    @foreach($condo->units as $unit)
                        <li class="list-group-item">{{ $unit->name }} &middot; {{ $unit->resident->name ?? 'N/A' }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Informasjon fra BRREG</div>
                <div class="card-body">
                    @if($brreg)
                        <p>{{ __('Navn:') }} {{ $brreg['navn'] ?? '' }}</p>
                        <p>{{ __('Organisasjonsform:') }} {{ $brreg['organisasjonsform']['beskrivelse'] ?? '' }}</p>
                        <p>{{ __('Stiftelsesdato:') }} {{ ucfirst(\Carbon\Carbon::parse($brreg['stiftelsesdato'])->isoFormat('LL')) ?? '' }}</p>
                        <p>{{ __('Registreringsdato:') }} {{ ucfirst(\Carbon\Carbon::parse($brreg['registreringsdatoEnhetsregisteret'])->isoFormat('LL')) ?? '' }}</p>
                        <p>{{ __('Adresse:') }}</p>
                        <address>
                            {{ $brreg['forretningsadresse']['adresse'][0] ?? '' }}<br>
                            {{ $brreg['forretningsadresse']['adresse'][1] ?? '' }}<br>
                            {{ $brreg['forretningsadresse']['postnummer'] ?? '' }} {{ $brreg['forretningsadresse']['poststed'] ?? '' }}
                        </address>
                    @else
                        <p class="m-0 p-0"><em>Finner ikke noe informasjon...</em></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
