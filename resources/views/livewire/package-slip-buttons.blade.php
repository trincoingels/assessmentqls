<div>
    @if (! $printed)
        <button onclick="Livewire.dispatch('openModal', { component: 'package-slip-modal', arguments: { order_number: {{ $order->id }} } })"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded mt-6">
            Pakbon maken
        </button>
    @endif

    @if ($printed)
        <button onclick="window.location=window.location.href+'/label'"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded mt-6">
            Pakbon printen
        </button>
    @endif
</div>
