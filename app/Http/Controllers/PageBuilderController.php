<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function index()
    {
        return view('tenant.builder.index');
    }
    public function preview(Page $page)
    {
        return view('tenant.builder.preview-page');
    }
    public function addModuleToPage(Request $request)
{
    $request->validate([
        'company_id' => 'required|exists:companies,id',
        'page_id' => 'required|exists:pages,id',
        'module_id' => 'required|exists:modules,id',
    ]);

    $lastModule = PageModule::where('company_id', $request->company_id)
        ->where('page_id', $request->page_id)
        ->orderByDesc('order')
        ->first();

    $order = $lastModule ? $lastModule->order + 10 : 10;

    PageModule::create([
        'company_id' => $request->company_id,
        'page_id' => $request->page_id,
        'module_id' => $request->module_id,
        'order' => $order,
        'content' => [],
        'is_visible' => true,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Modül başarıyla eklendi.',
    ]);
}
}
