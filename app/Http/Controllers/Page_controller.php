<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Element;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Events\RoleDeleted;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;


class Page_controller extends Controller
{
    public function listPages()
{
    $pages = Page::all();

    return view('manager', ['pages' => $pages]);
}

public function customize($title)
{
    $page = Page::where('title', $title)->firstOrFail();

    // Check if there is modified raw code in the database
    $modifiedRawCode = $page->raw_code;

    // Use modified raw code if available, otherwise use the original file
    $mainFilePath = resource_path("views/{$title}.php");
    $subfolderFilePath = resource_path("views/pages/{$title}.php");

    $bladeContent = $modifiedRawCode ?: (File::exists($mainFilePath) ? File::get($mainFilePath) : File::get($subfolderFilePath));

    return view("pages.customize", compact('page', 'bladeContent'));
}

    //Site showing
    public function show($title)
{
    $page = Page::where('title', $title)->firstOrFail();

    // Check if there is modified raw code in the database
    $modifiedRawCode = $page->raw_code;

    // Use modified raw code if available, otherwise use the original file
    $mainFilePath = resource_path("views/{$title}.php");
    $subfolderFilePath = resource_path("views/pages/{$title}.php");

    $bladeContent = $modifiedRawCode ?: (File::exists($mainFilePath) ? File::get($mainFilePath) : File::get($subfolderFilePath));

    return view("pages.show", compact('page', 'bladeContent'));
}


//Site changing
public function saveRawCode(Request $request, $title)
{
    $page = Page::where('title', $title)->firstOrFail();

    // Save the modified raw code in the database
    $page->update(['raw_code' => $request->input('rawCode')]);

    // Check if the modified raw code is different from the original file
    if ($page->raw_code != File::get(resource_path("views/{$title}.php"))) {
        // Save the modified raw code as the new content of the original blade file
        File::put(resource_path("views/{$title}.php"), $page->raw_code);
    }

    return back()->with('success', 'Page changed successfully.');
}

//Delete page method
public function deletePage(Request $request, $title)
    {
        $page = Page::where('title', $title)->first();

        if (!$page) {
            abort(404);
        }

        $bladeFilePath = resource_path("views/{$title}.blade.php");
        if (File::exists($bladeFilePath)) {
            unlink($bladeFilePath);
            File::delete($bladeFilePath);
        }

        // Delete from the database
        $page->delete();

        return redirect('/manager')->with('success', 'Page deleted successfully.');
    }

    public function createPage(Request $request)
    {
    // Validate the request
    $request->validate([
        'pageTitle' => 'required|string|max:255',
        'pageContent' => 'required|string',
    ]);

    // Create a new blade file with the provided content
    $pageTitle = $request->input('pageTitle');
    $pageContent = $request->input('pageContent');

    // Save the content to a new blade file (e.g., views/pages/{$pageTitle}.blade.php)
    $bladeFilePath = resource_path("views/pages/{$pageTitle}.blade.php");
    file_put_contents($bladeFilePath, $pageContent);

    // Save the page to the database with the .blade.php extension
    $page = Page::create([
        'title' => $pageTitle . ".blade",
        'content' => $pageContent,
    ]);

    // Redirect back to the manager page or wherever you prefer
    return redirect('/manager')->with('success', 'Page created successfully.');
    }


    public function showCreatePageForm()
    {
    return view('pages.create-page');
    }

}
