<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Spatie\PdfToImage\Enums\OutputFormat;
use Spatie\PdfToImage\Pdf as PdfToImage;

class LabelService
{
    public string $shippingLabel;

    public function __construct($orderId){
        $this->shippingLabel = Storage::disk('private')->path(sprintf('shipping_label_%s.pdf', $orderId));
    }

    public function saveLabel(string $labelUrl): void
    {
        try {
            $response = Http::withBasicAuth(
                config('services.qls.username'),
                config('services.qls.password')
            )->get($labelUrl );

            if ($response->failed()) {
                throw new Exception('Fout bij het aanmaken van de zending: ' . $response->body());
            }

            Storage::disk('private')->put(basename($this->shippingLabel), base64_decode($response->json()['data']));
        } catch (Exception $e) {
            throw new \Exception('Cannot obtain label');
        }
    }

    public function convertLabel(string $orderId): string
    {
        if( ! file_exists($this->shippingLabel) ) {
            throw new \Exception('Shipping label not found, try again');
        }

        $shippingLabelImage = str_replace('.pdf', '.png', $this->shippingLabel);

        // PDF to image convertion
        $pdf = new PdfToImage($this->shippingLabel);
        $pdf->quality(1);
        $pdf->resolution(288);
        $pdf->format(OutputFormat::Png);
        $pdf->save($shippingLabelImage);

        $this->rotateLabel($shippingLabelImage);

        return $shippingLabelImage;
    }

    /*
     * Check and fix rotation, always landscape due to sticker position
     */
    public function rotateLabel(string $label): void
    {
        $manager = new ImageManager(
            new Driver()
        );

        $shippingLabelImage = $manager->read($label);

        if ($shippingLabelImage->height() > $shippingLabelImage->width()) {
            $shippingLabelImage->rotate(-90);
        }

        $shippingLabelImage->save($label);
    }

}
