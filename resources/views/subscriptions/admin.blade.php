@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', [
'title' => __('app.subscriptions.admin'),
'icon' => __('list-ol')
])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justifiy-content-around">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Plan</th>
                    <th scope="col">ID Subscripción</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Finaliza</th>
                    <th scope="col">Cancelar / Reanudar</th>
                </tr>
                </thead>
                <tbody>
                @forelse($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->name }}</td>
                        <td>{{ $subscription->stripe_plan }}</td>
                        <td>{{ $subscription->stripe_id }}</td>
                        <td>{{ $subscription->quantity }}</td>
                        <td>{{ $subscription->created_at->format('d/m/Y') }}</td>
                        <td>{{ $subscription->trial_ends_at ? $subscription->trial_ends_at->format('d/m/Y') : 'Subscripcion activa' }}</td>
                        <td>
                            @if($subscription->ends_at)
                                <form action="{{route('subscription.resume')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{$subscription->name}}">
                                    <button class="btn btn-success">Reanudar</button>
                                </form>
                            @else
                                <form action="{{route('subscription.cancel')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{$subscription->name}}">
                                    <button class="btn btn-danger">Cancelar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr colspan="8">No hay ninguna suscripción disponible</tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
