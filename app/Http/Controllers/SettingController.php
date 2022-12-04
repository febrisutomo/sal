<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\UploadFileTrait;

class SettingController extends Controller
{

    use UploadFileTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.setting.edit', [
            'setting' => Setting::get(),
        ]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'nama_manager' => 'required',
            'ttd_manager' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('ttd_manager')) {
            $fileName = $this->uploadFile($request->file('ttd_manager'));
            
            $this->deleteFile(Setting::get()->ttd_manager);
        }
        else{
            $fileName = Setting::get()->ttd_manager;
        }

        $validated['ttd_manager'] = $fileName;

        Setting::set($validated);

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }

   
}
