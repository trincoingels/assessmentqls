<div class="p-5">
    <h2 class="text-lg font-bold mb-4">Maak een pakbon aan.</h2>

    <div class="mt-4">
        <label for="shipping_method" class="block text-sm font-medium text-gray-700">Gewicht in kg</label>
        <input type="number" wire:model.live="weight" class="w-full border p-2 rounded">
        @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mt-4">
        <label for="shipping_method" class="block text-sm font-medium text-gray-700">Verzendmethode</label>
        <select id="shipping_method" class="w-full border p-2 rounded" wire:model="shippingMethod">
            <option value="">Kies een verzendmethode</option>
            @foreach($shippingMethods as $method)
                <option value="{{ $method['combinations'][0]['id'] }}">{{ $method['name'] }}</option> <!-- use first combination as ID -->
            @endforeach
        </select>
        @error('shippingMethod') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mt-4 flex justify-end">
        <button wire:click="dispatch('closeModal')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuleren</button>
        <button wire:click="download" class="bg-blue-500 text-white px-4 py-2 rounded">Printen</button>
    </div>
</div>

