<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{

    public function __construct()
    {
        // Middleware only applied to these methods
        $this->middleware('Roles', [
            'only' => [
                'index' // Could add bunch of more methods too
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // CoreComponentRepository::instantiateShopRepository();
        $attributes = AttributeValue::orderBy('created_at', 'desc')->get();
        return view('backend.product.attribute_values.index', compact('attributes'));
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
        $attribute = new AttributeValue;
        $attribute->attribute_id = $request->attribute_id;
        $attribute->value = $request->value;

        $attribute->save();

        flash(translate('Attribute has been inserted successfully'))->success();
        return redirect()->route('attribute_values.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        return view('backend.product.attribute_values.edit', compact('attributeValue'));
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
        $attribute = AttributeValue::findOrFail($id);
        $attribute->attribute_id = $request->attribute_id;
        $attribute->value = $request->value;

        $attribute->save();


        flash(translate('Attribute has been updated successfully'))->success();
        return redirect()->route('attribute_values.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = AttributeValue::findOrFail($id);


        AttributeValue::destroy($id);
        flash(translate('Attribute has been deleted successfully'))->success();
        return redirect()->route('attribute_values.index');
    }
}
