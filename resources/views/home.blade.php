@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Dashboard</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
						<table class="table">
							<thead>
							<tr>
								<th>Transaction ID</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Card details</th>
							</tr>
							</thead>
							<tbody>
							@forelse($transactions as $transaction)
								<tr>
									<td>{{$transaction->id}}</td>
									<td>@php printf('%.2f',$transaction->amount)@endphp</td>
									<td>{{$transaction->date}}</td>
									<td>
										<p>Card#: {{$transaction->card->cno}}</p>
										<p>YY: {{$transaction->card->yy}}</p>
										<p>MM: {{$transaction->card->mm}}</p>
										<p>CVV2: {{$transaction->card->cvv2}}</p>
									</td>
								</tr>
							@empty <p>Nothing found</p>
							@endforelse
							</tbody>
							<tfoot>
							<tr>
								<td colspan="4">{{$links}}</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
