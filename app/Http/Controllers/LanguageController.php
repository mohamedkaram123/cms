<?php

namespace App\Http\Controllers;

use App\Exports\TransExport;
use App\Imports\TransImport;
use Illuminate\Http\Request;
use Session;
use File;
use App\Language;
use App\Translation;
use Excel;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
    	$request->session()->put('locale', $request->locale);
        $language = Language::where('code', $request->locale)->first();
    	flash(translate('Language changed to ').$language->name)->success();
    }

    public function index(Request $request)
    {
        $languages = Language::paginate(10);
        return view('backend.setup_configurations.languages.index', compact('languages'));
    }

    public function create(Request $request)
    {
        return view('backend.setup_configurations.languages.create');
    }

    public function store(Request $request)
    {
        $language = new Language;
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){

            flash(translate('Language has been inserted successfully'))->success();
            return redirect()->route('languages.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        $sort_search = null;
        $language = Language::findOrFail(decrypt($id));

        $query = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'));

        if ($request->has('search')) {
            $query = Translation::where('lang', !empty($language) ? $language->code : env('DEFAULT_LANGUAGE', 'en'));

            $sort_search = $request->search;

            $lang_keys = $query->clone();

            $lang_keys = $lang_keys->where('lang_key', 'like', '%' . $sort_search . '%');

            if (count($lang_keys->get()) == 0) {

                $query = $query->where('lang_value', 'like', '%' . $sort_search . '%');
            }

            $lang_keys = count($lang_keys->get()) != 0 ? $lang_keys->paginate(50) : $query->paginate(50);
        } else {
            $lang_keys =  $query->paginate(50);
        }


        return view('backend.setup_configurations.languages.language_view', compact('language', 'lang_keys', 'sort_search'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail(decrypt($id));
        return view('backend.setup_configurations.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){
            flash(translate('Language has been updated successfully'))->success();
            return redirect()->route('languages.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function key_value_store(Request $request)
    {
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) {
            $translation_def = Translation::where('lang_key', $key)->where('lang', $language->code)->first();
            if($translation_def == null){
                $translation_def = new Translation;
                $translation_def->lang = $language->code;
                $translation_def->lang_key = $key;
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
            else {
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
        }
        flash(translate('Translations updated for ').$language->name)->success();
        return back();
    }

    public function update_rtl_status(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $language->rtl = $request->status;
        if($language->save()){
            flash(translate('RTL status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        if (env('DEFAULT_LANGUAGE') == $language->code) {
            flash(translate('Default language can not be deleted'))->error();
        }
        else {
            if($language->code == Session::get('locale')){
                Session::put('locale', env('DEFAULT_LANGUAGE'));
            }
            Language::destroy($id);
            flash(translate('Language has been deleted successfully'))->success();
        }
        return redirect()->route('languages.index');
    }



    public function export_trans($lang){

        //   return "fddf";
           return Excel::download(new TransExport(decrypt($lang)), 'trans.xlsx');
       }


       public function import_trans(Request $request)
       {
           if($request->hasFile('trans_file')){
               Excel::import(new TransImport, request()->file('trans_file'));
           }
           flash(translate('Trans imported successfully'))->success();
           return back();
       }
}
