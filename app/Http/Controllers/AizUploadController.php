<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use App\Upload;
use Response;
use Auth;
use Illuminate\Support\Arr;
use Storage;
use Image;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class AizUploadController extends Controller
{


    public function index(Request $request)
    {

        $all_uploads = Upload::query();
        $search = null;
        $sort_by = null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%' . $request->search . '%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)->appends(request()->query());

        return view('backend.uploaded_files.index', compact('all_uploads', 'search', 'sort_by'));
    }

    public function create()
    {
        return view('backend.uploaded_files.create');
    }


    public function show_uploader(Request $request)
    {
        return view('uploader.aiz-uploader');
    }
    public function upload(Request $request)
    {
        $type
            =
            json_decode(get_setting("extension_upload"), true);

        if ($request->hasFile('aiz_file')) {
            $upload = new Upload;
            $extension = strtolower($request->file('aiz_file')->getClientOriginalExtension());

            if (isset($type[$extension])) {
                $upload->file_original_name = null;
                $arr = explode('.', $request->file('aiz_file')->getClientOriginalName());
                for ($i = 0; $i < count($arr) - 1; $i++) {
                    if ($i == 0) {
                        $upload->file_original_name .= $arr[$i];
                    } else {
                        $upload->file_original_name .= "." . $arr[$i];
                    }
                }

                $path = $request->file('aiz_file')->store('uploads/all', 'local');
                $size = $request->file('aiz_file')->getSize();

                if ($type[$extension] == 'image' && get_setting('disable_image_optimization') != 1) {
                    try {
                        $img = Image::make($request->file('aiz_file')->getRealPath())->encode();
                        $height = $img->height();
                        $width = $img->width();
                        if ($width > $height && $width > 1500) {
                            $img->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } elseif ($height > 1500) {
                            $img->resize(null, 800, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $img->save(base_path('public/') . $path);
                        clearstatcache();
                        $size = $img->filesize();

                        if (env('FILESYSTEM_DRIVER') == 's3') {
                            Storage::disk('s3')->put($path, file_get_contents(base_path('public/') . $path));
                            unlink(base_path('public/') . $path);
                        }
                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }

                $upload->extension = $extension;
                $upload->file_name = $path;
                $upload->user_id = Auth::user()->id;
                $upload->type = $type[$upload->extension];
                $upload->file_size = $size;
                $upload->save();
            }
            return '{}';
        }
    }

    public function get_uploaded_files(Request $request)
    {
        $uploads = Upload::where('user_id', Auth::user()->id);
        if ($request->search != null) {
            $uploads->where('file_original_name', 'like', '%' . $request->search . '%');
        }
        if ($request->sort != null) {
            switch ($request->sort) {
                case 'newest':
                    $uploads->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $uploads->orderBy('created_at', 'asc');
                    break;
                case 'smallest':
                    $uploads->orderBy('file_size', 'asc');
                    break;
                case 'largest':
                    $uploads->orderBy('file_size', 'desc');
                    break;
                default:
                    $uploads->orderBy('created_at', 'desc');
                    break;
            }
        }
        return $uploads->paginate(60)->appends(request()->query());
    }

    public function destroy(Request $request, $id)
    {
        try {
            if (env('FILESYSTEM_DRIVER') == 's3') {
                Storage::disk('s3')->delete(Upload::where('id', $id)->first()->file_name);
            } else {
                unlink(public_path() . '/' . Upload::where('id', $id)->first()->file_name);
            }
            Upload::destroy($id);
            flash(translate('File deleted successfully'))->success();
        } catch (\Exception $e) {
            Upload::destroy($id);
            flash(translate('File deleted successfully'))->success();
        }
        return back();
    }

    public function get_preview_files(Request $request)
    {
        $ids = explode(',', $request->ids);
        $files = Upload::whereIn('id', $ids)->get();
        return $files;
    }

    //Download project attachment
    public function attachment_download($id)
    {
        $project_attachment = Upload::find($id);
        try {
            $file_path = public_path($project_attachment->file_name);
            return Response::download($file_path);
        } catch (\Exception $e) {
            flash(translate('File does not exist!'))->error();
            return back();
        }
    }
    //Download project attachment
    public function file_info(Request $request)
    {
        $file = Upload::findOrFail($request['id']);
        return view('backend.uploaded_files.info', compact('file'));
    }

    public function upload_path($path)
    {
        $file2 = file_get_contents($path);
        $file = pathinfo($path);
        $file_name = time() . "." . $file["extension"];
        $folder_path = "uploads/all/" . $file_name;

        FacadesStorage::put($folder_path, $file2);


        $upload = new Upload;
        $extension = strtolower($file["extension"]);
        $size = filesize(public_path() . "/" .  $folder_path);

        $upload->extension = $extension;
        $upload->file_name = $folder_path;
        $upload->user_id = 1;
        $upload->type = $file["extension"];
        $upload->file_size = $size;
        $upload->save();

        return $upload;
    }

    public function update_extension(Request $req)
    {
        $arr = array_keys(json_decode(get_setting('extension_upload'), true));
        $arr2 = json_decode(get_setting('extension_upload'), true);

        $data = Arr::flatten(json_decode($req->value, true));
        $data = array_values($data);

        $check_new_items = false;
        if ($req->type == "remove") {
            foreach ($arr as $item) {
                if (!in_array($item, $data)) {
                    unset($arr2[$item]);
                }
            }
            $check_new_items = true;
        } else {
            foreach ($data as $item) {
                if (!in_array($item, $arr)) {
                    $arr2[$item] = "document";
                    $check_new_items = true;
                }
            }
        }



        if ($check_new_items) {
            $busniss_setting = BusinessSetting::where("type", "extension_upload")->first();
            $busniss_setting->value = json_encode($arr2);
            $busniss_setting->save();
        }
    }
}
