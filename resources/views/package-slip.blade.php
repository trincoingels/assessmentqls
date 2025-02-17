<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakbon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
<div class="flex justify-between p-6 min-h-screen items-stretch border border-gray-300">
    <!-- Left side: Order details -->
    <div class="w-1/2 p-6 border-r border-gray-300">
        <h2 class="text-xl font-semibold text-left mb-4">Order {{ $order->number }}</h2>
        <div class="flex justify-between mb-6">
            <div class="w-1/2">
                <h3 class="text-lg font-semibold">Afzender</h3>
                <p class="text-sm">{{ $order->billing_address->name }}</p>
                <p class="text-sm">{{ $order->billing_address->street }} {{ $order->billing_address->housenumber }}</p>
                <p class="text-sm">{{ $order->billing_address->zipcode }} {{ $order->billing_address->city }}</p>
                <p class="text-sm">{{ $order->billing_address->country }}</p>
            </div>
            <div class="w-1/2">
                <h3 class="text-lg font-semibold">Ontvanger</h3>
                <p class="text-sm">{{ $order->delivery_address->name }}</p>
                <p class="text-sm">{{ $order->delivery_address->street }} {{ $order->delivery_address->housenumber }}</p>
                <p class="text-sm">{{ $order->delivery_address->zipcode }} {{ $order->delivery_address->city }}</p>
                <p class="text-sm">{{ $order->delivery_address->country }}</p>
            </div>
        </div>
        <div class="mt-6">
            <h4 class="text-lg font-semibold">Artikelen</h4>
            <table class="w-full text-sm border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-2 py-1">Aantal</th>
                    <th class="border border-gray-300 px-2 py-1">Naam</th>
                    <th class="border border-gray-300 px-2 py-1">SKU</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->order_lines as $line)
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">{{ $line->amount_ordered }}</td>
                        <td class="border border-gray-300 px-2 py-1">{{ $line->name }}</td>
                        <td class="border border-gray-300 px-2 py-1">{{ $line->sku }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right side: Shipping label -->
    <div class="w-1/2 p-6 text-center">
        <img src="data:image/png;base64,{{ $shipping_label }}" alt="Verzendlabel" class="w-3/4 mx-auto">
    </div>
</div>
</body>
</html>
