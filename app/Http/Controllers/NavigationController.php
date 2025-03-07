<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Rules\UrlOrNewUrl;
use Illuminate\Contracts\Validation\ValidationRule;


class NavigationController extends Controller
{
   
    public function index()
    {
        $navigations = Navigation::all();
        return view('index-nav', compact('navigations'));
    }

   
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string',
        'url' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                $existingUrl = $request->input('existing_url');

                if (empty($value) && empty($existingUrl)) {
                    $fail('Either URL or an existing URL is required.');
                }
            },
        ],
    ]);

    Navigation::create([
        'title' => $request->input('title'),
        'url' => !empty($request->input('url')) ? $request->input('url') : $request->input('existing_url'),
    ]);

    return redirect('navigation')->with('success', 'Navigation item created successfully.');
}



public function update(Request $request, Navigation $navigation)
{
    $request->validate([
        'title' => 'required|string',
        'url' => 'required',
    ]);

    Navigation::where('id', $navigation->id)->update([
        'title' => $request->input('title'),
        'url' => $request->input('url'),
    ]);

    return redirect()->route('navigation.index')->with('success', 'Navigation item updated successfully.');
}

    public function destroy(Navigation $navigation)
    {
        $navigation->delete();

        return redirect()->route('navigation.index')->with('success', 'Navigation item deleted successfully.');
    }
}
