<?php

namespace App\Http\Concerns;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

/**
 * Trait partagé pour l'upload Cloudinary.
 * Utilisé par AdminController et MesureController.
 */
trait UploadsToCloudinary
{
    protected function uploadToCloudinary(UploadedFile $file, string $folder = 'vetements'): string
    {
        $cloudName = config('cloudinary.cloud_name');
        $apiKey    = config('cloudinary.api_key');
        $apiSecret = config('cloudinary.api_secret');

        if (empty($cloudName) || empty($apiKey) || empty($apiSecret)) {
            Log::error('Cloudinary: credentials manquants', [
                'cloud_name' => $cloudName,
                'api_key'    => $apiKey ? '***' : 'NULL',
                'api_secret' => $apiSecret ? '***' : 'NULL',
            ]);
            throw new \RuntimeException('Cloudinary non configuré — vérifiez les variables d\'environnement.');
        }

        $client = new Cloudinary(
            sprintf('cloudinary://%s:%s@%s', $apiKey, $apiSecret, $cloudName)
        );

        $result = $client->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
        ]);

        return $result['secure_url'];
    }

    protected function normalizeWhatsAppPhone(?string $raw): ?string
    {
        if ($raw === null || trim($raw) === '') {
            return null;
        }

        $digits  = preg_replace('/\D+/', '', $raw);
        if ($digits === '') {
            return null;
        }

        $country = preg_replace('/\D+/', '', (string) config('services.whatsapp.default_country_code', '221'));
        if ($country === '') {
            $country = '221';
        }

        if (str_starts_with($digits, $country)) {
            return $digits;
        }

        if (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        return $country . $digits;
    }
}
