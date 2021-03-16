<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\TermUpdateRequest;
use App\Http\Requests\PoliticUpdateRequest;
use App\Http\Requests\ContactUpdateRequest;

class SettingController extends Controller
{
    public function editTerms() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.terms', compact("setting"));
    }

    public function updateTerms(TermUpdateRequest $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $setting->fill($request->all())->save();

        if ($setting) {
            return redirect()->route('terminos.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los términos y condiciones han sido editados exitosamente.']);
        } else {
            return redirect()->route('terminos.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function editPolitics() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.politics', compact("setting"));
    }

    public function updatePolitics(PoliticUpdateRequest $request) {

        $setting=Setting::where('id', 1)->firstOrFail();
        $setting->fill($request->all())->save();

        if ($setting) {
            return redirect()->route('politicas.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Las políticas han sido editadas exitosamente.']);
        } else {
            return redirect()->route('politicas.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function editContacts() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.contacts', compact("setting"));
    }

    public function updateContacts(ContactUpdateRequest $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $setting->fill($request->all())->save();

        if ($setting) {
            return redirect()->route('contactos.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los ajustes de contacto han sido editados exitosamente.']);
        } else {
            return redirect()->route('contactos.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }
}
