<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class ApplicationManagementController extends Controller
{

    public function getUpdateVersion()
    {
        $updatedVersion = config('app.nextAppVersion');

        return response()->json([
            'status' => 'success',
            'data' => $updatedVersion,
        ]);
    }

    public function updateApplication()
    {
        $editor = DotenvEditor::load();
        $currentAppVersion = $editor->getKey('APP_VERSION')['value'];
        $refinedAppVersion = ltrim($currentAppVersion, 'v');

        $updatedVersion = config('app.nextAppVersion');
        if ($updatedVersion) {
            if ($refinedAppVersion == $updatedVersion) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'The application is up to date',
                ]);
            } else {
                try {
                    $migrateExitCode = Artisan::call('migrate', ['--force' => true]);
                    $migrateOutput = Artisan::output();

                    Artisan::call('db:seed', ['--class' => 'MenuSeeder', '--force' => true]);
                    $this->addNewPermissions();

                    $editor->setKey('APP_VERSION', $updatedVersion);
                    $editor->save();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Application updated successfully',
                        'migrate_exit_code' => $migrateExitCode,
                        'migrate_output' => $migrateOutput,
                    ]);
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ]);
        }
    }

    private function addNewPermissions()
    {
        $superAdminRole = DB::table('roles')->where('slug', 'super-admin')->first();
        if (!$superAdminRole) {
            throw new \Exception('Super Admin role not found');
        }

        $newPermissions = [
            // application update permissions
            [
                'name' => 'Update',
                'guard_name' => 'Application Management',
                'slug' => 'update-application',
            ],
        ];

        foreach ($newPermissions as $permissionData) {
            $permission = DB::table('permissions')->where('slug', $permissionData['slug'])->first();

            if (!$permission) {
                $permissionId = DB::table('permissions')->insertGetId($permissionData);

                DB::table('user_permission')->insert([
                    'user_id' => 1,
                    'permission_id' => $permissionId,
                ]);

                DB::table('role_permission')->insert([
                    'role_id' => $superAdminRole->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    }
}
