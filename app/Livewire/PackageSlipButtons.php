<?php

namespace App\Livewire;

use App\Services\PackageSlipService;
use Livewire\Component;

class PackageSlipButtons extends Component
{
    public bool $printed;

    public object $order;

    protected $listeners = ['packingSlipPrinted' => 'updatePrintedStatus'];

    public function mount(object $order)
    {
        $this->order = $order;
        $this->printed = (new PackageSlipService($this->order))->exists();
    }

    public function updatePrintedStatus()
    {
        $this->printed = (new PackageSlipService($this->order))->exists();
    }

    public function render()
    {
        return view('livewire.package-slip-buttons');
    }
}
