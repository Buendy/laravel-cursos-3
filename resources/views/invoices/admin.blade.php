@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Administrar mis facturas', 'icon' => 'archive'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th>{{ trans('app.invoices.view_admin_date') }}</th>
                    <th>{{ trans('app.invoices.view_admin_price') }}</th>
                    <th>{{ trans('app.invoices.view_admin_coupon') }}</th>
                    <th>{{ trans('app.invoices.view_admin_invoice') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->date()->format('d/m/Y') }}</td>
                        <td>{{ $invoice->total() }}</td>
                        @if ($invoice->hasDiscount())
                            <td>
                                {{ $invoice->coupon() }} / {{ $invoice->discount() }}
                            </td>
                        @else
                            <td>
                            <td>{{ trans('app.invoices.view_admin_no_coupon') }}</td>
                            </td>
                        @endif
                        <td>
                            <a class="btn btn-course" href="{{ route('invoices.download', ['id' => $invoice->id]) }}">
                                {{ trans('app.invoices.view_admin_download') }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ trans('app.invoices.view_admin_no_invoices') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
