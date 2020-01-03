@extends('layouts.app')

@section('content')
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
		    <div class="card-header">Abonnement</div>
		    <div class="card-body">
				<form action="{{ route('s.store') }}" method="POST" id="subscribe-form">

				    {!! csrf_field() !!}

				    <div class="form-group">
				    	<label>Abonnementsplan</label>
				    	<select class="form-control" name="plan">
				    		<option value="monthly">Månedlig (200kr / 1 måneder)</option>
				    		<option value="plan_GLJHY7nlKS6PzM">Kvartal (600kr / 3 måneder)</option>
				    		<option value="plan_GSGH1B3vNnKzqe">Halvårlig (1200kr / 6 måneder)</option>
				    		<option value="plan_GLIM0Gw3QDHUGm">Årlig (2400kr / 12 måneder)</option>
				    	</select>
				    </div>

				    <div class="form-group">
				        <button type="submit" class="btn btn-success">Abonner</button>
				    </div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection