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

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('settings', 'public');
                
                $setting = Setting::firstOrCreate(['key' => $key]);
                if ($setting->value && !str_starts_with($setting->value, 'images/')) {
                    Storage::disk('public')->delete($setting->value);
                }
                
                $setting->update([
                    'value' => $path,
                    'type' => 'image'
                ]);
            } else {
                // If it's a regular text input and not a file
                // But for now, we only have file inputs. If we have text inputs later, handle here.
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
