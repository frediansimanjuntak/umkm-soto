<?php

namespace App\Http\Controllers;

use App\Models\HeaderImage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHeaderImageRequest;
use App\Http\Requests\UpdateHeaderImageRequest;
use DB;

class HeaderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $headerImages = HeaderImage::where(function($q) use($request) {
            if ($request['search']) {
                $q->where('title', 'ilike', '%'.$request['search'].'%');
                $q->orWhere('image_url', 'ilike', '%'.$request['search'].'%');
                $q->orWhere('url_link', 'ilike', '%'.$request['search'].'%');
            }
        })->orderBy('sequence', 'asc')->paginate(1);

        return view ('admin.header-images.index', compact('headerImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.header-images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeaderImageRequest $request)
    {
        try {
            DB::beginTransaction();
            // INSERT INTO header_images VALUES()
            $headerImage = HeaderImage::create($request->all());
            DB::commit();
            return redirect()->route('header-images.index')->withSuccess('Create Header Image Success');
        } catch (\Exception $exp) {
            DB::rollback();
            dd($exp->getMessage());
            return redirect()->back()->withErrors($exp->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HeaderImage $headerImage)
    {
        return view ('admin.header-images.show', compact('headerImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeaderImage $headerImage)
    {
        return view ('admin.header-images.edit', compact('headerImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeaderImageRequest $request, HeaderImage $headerImage)
    {
        try {
            DB::beginTransaction();
            // UPDATE header_images SET()
            $headerImage->update($request->all());
            DB::commit();
            return redirect()->route('header-images.index')->withSuccess('Update Header Image Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->back()->withErrors($exp->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeaderImage $headerImage)
    {
        try {
            DB::beginTransaction();
            // DELETE * FROM header_images
            $headerImage->delete();
            DB::commit();
            return redirect()->route('header-images.index')->withSuccess('Delete Header Image Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->route('header-images.index')->withErrors($exp->getMessage())->withInput();
        }
    }
}
