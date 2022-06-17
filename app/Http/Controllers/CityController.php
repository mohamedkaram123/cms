<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\CityTranslation;
use App\Exports\CitiesExport;
use App\Imports\CityImport;
use App\Models\Governorate;
use App\myTraits\CgcData;
use App\Upload;
use Illuminate\Support\Facades\DB;
use Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf as FacadesPdf;
use PDF;

class CityController extends Controller
{
    use CgcData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
     public function __construct(){
                ini_set('max_execution_time', 300);
                ini_set("memory_limit","512M");
    }
    public function index()
    {
        $cities = City::orderBy("id", "desc")->paginate(15);
        $countries = Country::get();
        return view('backend.setup_configurations.cities.index', compact('cities', 'countries'));
    }

    public function index_front()
    {


        $cities = City::orderBy("id", "desc")->paginate(15);
        $countries = Country::get();
        return view('frontend.cities.index', compact('cities', 'countries'));
    }


    public function get_governorates($id)
    {
        return $this->governorate($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;

        $city->name = $request->name;
        $city->cost = $request->cost;
        $city->pool_area = $request->pool_area;
        $city->shipping_days = $request->shipping_days;

        $city->governorate_id = $request->governorate_id;

        $city->save();

        flash(translate('City has been inserted successfully'))->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang  = $request->lang;
        $city  = City::findOrFail($id);
        $countries = Country::where('status', 1)->get();
        $governorates = Governorate::where('country_id', $city->governorate->country->id)->get();

        return view('backend.setup_configurations.cities.edit', compact('city', 'lang', 'countries', 'governorates'));
    }

    public function edit_front(Request $request, $id)
    {

        $lang  = $request->lang;
        $city  = City::findOrFail($id);
        $countries = Country::where('status', 1)->get();
        $governorates = Governorate::where('country_id', $city->governorate->country->id)->get();

        return view('frontend.cities.edit', compact('city', 'lang', 'countries', 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $city->name = $request->name;
        }

        $city->governorate_id = $request->governorate_id;
        $city->cost = $request->cost;

        $city->save();

        $city_translation = CityTranslation::firstOrNew(['lang' => $request->lang, 'city_id' => $city->id]);
        $city_translation->name = $request->name;
        $city_translation->save();

        flash(translate('City has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);

        foreach ($city->city_translations as $key => $city_translation) {
            $city_translation->delete();
        }

        City::destroy($id);

        flash(translate('City has been deleted successfully'))->success();
        return redirect()->route('cities.index');
    }

    public function get_city(Request $request)
    {
        $country_info = Country::where('name', $request->country_name)->first();

        $cities = City::where('country_id', $country_info->id)->get();
        $html = '';

        foreach ($cities as $row) {
            //            $val = $row->id . ' | ' . $row->name;
            $html .= '<option value="' . $row->name . '">' . $row->getTranslation('name') . '</option>';
        }


        echo json_encode($html);
    }


    public function all_cities(Request $request)
    {
        $cities = DB::select("select name as label,id as value from cities where country_id = $request->country_id");
        return  response()->json([
            "cities" => $cities
        ]);
    }

    public function export_cities()
    {

        //   return "fddf";
        return Excel::download(new CitiesExport(), 'cities.xlsx');
    }


    public function import_city(Request $request)
    {

        if (!empty($request->city_file)) {

            $file = Upload::find($request->city_file);

            // $temp = tmpfile();

            // fwrite($temp, "Testing, testing.");
            // //Rewind to the start of file
            // rewind($temp);
            // //Read 1k from file
            // fread($temp, 1024);

            // //This removes the file
            // fclose($temp);
            $name_exp =  explode("/", $file->file_name);
            $file_name = $name_exp[count($name_exp) - 1];

            $file_disk = base_path("public/uploads/all/") . $file_name;

     //   return dd($file_disk);

            if ($file->extension == "xlsx") {


                if ($request->city_file) {

                    $import_city = new CityImport();
                    Excel::import($import_city, $file_disk);
                } else {

                    flash(translate('Please check your file data '))->error();
                    return back();
                }


                if ($import_city->num_row_create != 0) {
                    flash(translate('Cities imported successfully is number ') . $import_city->num_row_create)->success();
                } else {
                    flash(translate('the data entered before '))->warning();
                }

                return back();
            }
            flash(translate('Please check your file type must be xlsx '))->error();
            return back();
        } else {
            flash(translate('Please enter your file '))->error();
            return back();
        }
    }


    public function download_governorate()
    {
        $governorates = Governorate::all();

        return FacadesPdf::loadView('backend.downloads.governorates', [
            'governorates' => $governorates,
        ], [], [])->download('governorates.pdf');
    }
}
