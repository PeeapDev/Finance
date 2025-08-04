<?php

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\API\GeneralController;

function invoiceThankYouMessage(){
   return $message = GeneralSetting::where('key', 'invoice_thank_you_message')->first()->value;
}

 function getPrefix()
{
    $generalController = new GeneralController();
    $getGeneralSettings = $generalController->getGeneralSettings();
    return $getGeneralSettings;
}

if (!function_exists('handleGeneralSettingsImage')) {
    function handleGeneralSettingsImage($imageData, $existingImageName, $imagePrefix)
    {
        if ($existingImageName) {
            @unlink(public_path('images/' . $existingImageName));
        }

        $imageExtension = explode(
            '/',
            explode(':', substr($imageData, 0, strpos($imageData, ';')))[1]
        )[1];
        $imageName = $imagePrefix . '.' . $imageExtension;

        if ($imageExtension === 'svg' || $imageExtension === 'svg+xml') {
            $imageName = $imagePrefix . '.' . 'svg';
            $imageData = explode(',', $imageData)[1];
            File::put(public_path('images/') . $imageName, base64_decode($imageData));
        } else {
            Image::make($imageData)->save(public_path('images/') . $imageName);
        }

        return $imageName;
    }
}