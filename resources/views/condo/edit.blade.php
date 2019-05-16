@extends('layouts.app')

@section('content')
<div class="container">
	{{ Breadcrumbs::render('c') }}
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">EDIT: {{ $orgnr ?? '' }} &middot; {{ $name ?? '' }}</div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
