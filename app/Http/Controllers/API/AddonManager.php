<?php

namespace App\Http\Controllers\API;

use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class AddonManager extends Controller
{
    public function installWooCommerce(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:zip'
        ]);

        if ($request->file('file')) {
            $zipFile = $request->file('file');
            $zipPath = $zipFile->store('addons');

            // Extract the zip file
            $zip = new ZipArchive;
            if ($zip->open(storage_path('app/' . $zipPath)) === true) {
                // Extract the zip file contents to a temporary directory
                $extractPath = storage_path('app/temp');
                $zip->extractTo($extractPath);
                $zip->close();

                // Check if woocommerce.php exists and move to the routes directory
                if (file_exists($extractPath . '/woocommerce.php')) {
                    rename($extractPath . '/woocommerce.php', base_path('routes/woocommerce.php'));
                }

                // Check if WoocommerceController.php exists and move to the controller directory
                if (file_exists($extractPath . '/WoocommerceController.php')) {
                    rename($extractPath . '/WoocommerceController.php', base_path('app/Http/Controllers/API/WoocommerceController.php'));
                }

                // Delete the temporary directory and the extracted zip file
                $this->deleteDirectory($extractPath);
                Storage::delete($zipPath);

                $editor = DotenvEditor::load();
                $editor->setKey('IS_WOOCOMMERCE_INSTALL', 'true');
                $editor->setKey('IS_WOOCOMMERCE_ACTIVE', 'true');
                $editor->setKey('WOOCOMMERCE_APP_URL', '');
                $editor->setKey('WOOCOMMERCE_CONSUMER_KEY', '');
                $editor->setKey('WOOCOMMERCE_CONSUMER_SECRET', '');
                $editor->save();

                return response()->json(['message' => 'Addon installed successfully'], 200);
            } else {
                return response()->json(['error' => 'Failed to extract zip file'], 500);
            }
        } else {
            return response()->json(['error' => 'Invalid file'], 400);
        }
    }

    //  function to delete a directory
    private function deleteDirectory($directory)
    {
        if (!file_exists($directory)) {
            return true;
        }

        if (!is_dir($directory)) {
            return unlink($directory);
        }

        foreach (scandir($directory) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($directory . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($directory);
    }


    public function manageWooCommerceAddon(Request $request){

        $action = $request->action;
        $editor = DotenvEditor::load();
        
        if($action == 'enable'){
            $editor->setKey('IS_WOOCOMMERCE_ACTIVE', 'true');
        }
        if($action == 'disable'){
            $editor->setKey('IS_WOOCOMMERCE_ACTIVE', 'false');
        }
        if($action == 'uninstall'){
            $filePaths = [
                base_path('routes/woocommerce.php'),
                base_path('app/Http/Controllers/API/WoocommerceController.php'),
            ];

            foreach ($filePaths as $filePath) {
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            $editor->setKey('IS_WOOCOMMERCE_INSTALL', 'false');
            $editor->setKey('IS_WOOCOMMERCE_ACTIVE', 'false');
        }

        $editor->save();
        return response()->json(['message' => 'Action performed successfully'], 200);
    }
}
