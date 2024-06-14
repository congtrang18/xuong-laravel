<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVarian;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = "admin.products.";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Product::query()->with(['catelogue', 'tags'])->latest('id')->get();
        // dd($data->first()->tags);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();



        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
        if ($dataProduct['img_thumbnail']) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }
        $dataProduct_tags = $request->tags;
        // dd($dataProduct_tags);
        $dataProduct_variantstmp = $request->product_variants;
        // dd($dataProduct_variantstmp);
        $dataProduct_variants = [];
        foreach ($dataProduct_variantstmp as $key => $item) {
            $tmp = explode('-', $key);
            // dd($tmp);
            $dataProduct_variants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quatity' => $item['quatity'],
                'image' => $item['image'] ?? NULL,
            ];
            // dd($dataProduct_variants);
            # code...
        }
        $dataProduct_galleries = $request->product_galleries ?: [];
        // dd($dataProduct);
        try {
            DB::beginTransaction();

            $product = Product::query()->create($dataProduct);
            // dd($product);
            foreach ($dataProduct_variants as $key => $value) {
                // dd($value);
                $value['product_id'] = $product->id;
                if ($value['image']) {
                    $value['image'] = Storage::put('products', $value['image']);
                }
                ProductVarian::query()->create($value);
            }
            $product->tags()->sync($dataProduct_tags);
            foreach ($dataProduct_galleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $image)
                ]);
            }
            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        // dd($product);
        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();
                $product->variants()->delete();
                $product->delete();
                // $product->tags()->delete();
                return redirect()->route('admin.products.index');

            },3);
        } catch (\Exception $exception) {
            DB::rollBack();
            return back();
        }
    }
}
