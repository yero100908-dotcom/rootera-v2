<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request, \App\Services\WebpConverterService $webpService)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                
                $setting = Setting::firstOrCreate(['key' => $key]);
                $webpService->deleteIfExists($setting->value);

                $path = $webpService->convertAndStore($file, 'settings');

                $setting->update([
                    'value' => $path,
                    'type'  => 'image'
                ]);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
