<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function saveElementContent(Request $request)
{
    // Validate the request
    $request->validate([
        'element_id' => 'required|exists:elements,id',
        'content' => 'required',
    ]);

    // Find the element by ID
    $element = Element::findOrFail($request->input('element_id'));

    // Update the content
    $element->content = $request->input('content');
    $element->save();

    // Return a response
    return response()->json(['message' => 'Content saved successfully']);
}
}