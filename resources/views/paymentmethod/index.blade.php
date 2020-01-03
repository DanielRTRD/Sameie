@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-4">
        <div class="card">
            <div class="card-header">Dine kort</div>
            <ul class="list-group list-group-flush">
                @if($paymentmethods->count() === 0)
                	<li class="list-group-item"><em>Du har ingen.</em></li>
                @endif
                @foreach($paymentmethods as $method)
                    <li class="list-group-item">
                    	<span class="mr-2">{{ $method->card->brand }}</span> <span class="mr-3">&middot;&middot;&middot;&middot; {{ $method->card->last4 }}</span> {{ $method->card->exp_month }} / {{ $method->card->exp_year }}
                    	<form method="post" action="{{ route('pm.destroy', $method->id) }}" class="d-inline"> 
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger">Delete</button>
						</form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Legg til Betalingsmetode</div>
            <div class="card-body">
                <form id="paymentMethod-form" action="{{ route('pm.store') }}" method="post">
                    @csrf

                    <div class="form-group">
					    <label for="card-element">Name on card</label>
                    	<input id="card-holder-name" class="form-control" type="text">
                    </div>
                    
                    <div class="form-group">
					    <label for="card-element">Credit or debit card</label>
					    <div id="card-element" class="form-control" style="height: 2.4em; padding-top: .7em;">
					    	<!-- A Stripe Element will be inserted here. -->
					    </div>
						</div>

						<div id="stripe-errors"></div>
						<input id="card-token" name="card-token" class="hidden" type="hidden">
                    <button id="card-button" class="btn btn-block btn-success">
                        Oppdater betalingsmetode
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
	$(document).ready(function() {
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});
	});

    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements({
		locale: 'nb',
	});
    const cardElement = elements.create('card', {
    	hidePostalCode: true,
    });

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
	const cardButton = document.getElementById('card-button');

	cardButton.addEventListener('click', async (e) => {
		e.preventDefault();
	    const { paymentMethod, error } = await stripe.createPaymentMethod(
	        'card', cardElement, {
	            billing_details: { name: cardHolderName.value }
	        }
	    );
	    if (error) {
	        console.log(response.error.message);
	        document.getElementById('stripe-errors').value(response.error.message).addClass('alert alert-danger');
	    } else {
	        console.log(paymentMethod)
	        document.getElementById("card-token").value = paymentMethod.id;
	        document.getElementById("paymentMethod-form").submit();
	    }
	});
</script>
@endsection