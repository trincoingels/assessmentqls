@extends('components.layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Order Overzicht</h2>
        <p><strong>Ordernummer:</strong> {{ $order->number }}</p>

        <h3 class="text-lg font-semibold mt-6">Factuuradres</h3>
        <p>{{ $order->billing_address->name }}</p>
        <p>{{ $order->billing_address->street }} {{ $order->billing_address->housenumber }}</p>
        <p>{{ $order->billing_address->zipcode }} {{ $order->billing_address->city }}, {{ $order->billing_address->country }}</p>
        <p>Email: <span class="text-blue-600">{{ $order->billing_address->email }}</span></p>
        <p>Telefoon: {{ $order->billing_address->phone }}</p>

        <h3 class="text-lg font-semibold mt-6">Bezorgadres</h3>
        <p>{{ $order->delivery_address->name }}</p>
        <p>{{ $order->delivery_address->street }} {{ $order->delivery_address->housenumber }}</p>
        <p>{{ $order->delivery_address->zipcode }} {{ $order->delivery_address->city }}, {{ $order->delivery_address->country }}</p>

        <h3 class="text-lg font-semibold mt-6">Bestelde artikelen</h3>
        <div class="overflow-x-auto mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">Aantal</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Naam</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">SKU</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">EAN</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->order_lines as $line)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $line->amount_ordered }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $line->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $line->sku }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $line->ean }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <livewire:package-slip-buttons :order="$order" />

{{--        <button onclick="Livewire.dispatch('openModal', { component: 'package-slip-modal', arguments: { order_number: {{ $order->id }} } })"--}}
{{--                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded mt-6">--}}
{{--            Pakbon maken--}}
{{--        </button>--}}

{{--        <button onclick="window.location=window.location.href+'/label'"--}}
{{--                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded mt-6">--}}
{{--            Pakbon printen--}}
{{--        </button>--}}
    </div>
@endsection
