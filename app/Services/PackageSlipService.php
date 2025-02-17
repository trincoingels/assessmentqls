<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;

class PackageSlipService
{
    public object $order;
    public string $packageSlipName;

    public function __construct(object $order)
    {
        $this->order = $order;
        $this->packageSlipName = sprintf('package_slip_%s.pdf', $this->order->id);
    }

    public function download()
    {
        $packageSlip = Storage::disk('private')->path($this->packageSlipName);

        if (! $this->exists())
        {
            $labelService = new LabelService($this->order->id);
            $shippingLabel = $labelService->convertLabel($this->order->id);

            if(! $shippingLabel) {
                throw new \Exception('Shipping label not found, try again or create first');
            }

            Pdf::view('package-slip', [
                'order' => $this->order,
                'shipping_label' => base64_encode(file_get_contents($shippingLabel)),
            ])
                ->format('A4')
                ->landscape()
                ->save($packageSlip);
        }

        return Storage::disk('private')->download($this->packageSlipName);
    }

    public function exists(): bool
    {
        return Storage::disk('private')->exists($this->packageSlipName);
    }
}
