<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Phương thức hỗ trợ load hình ảnh và thay thế hình mặc định nếu không tìm thấy file
    protected function fixImage(Product $p) {
        //tự download 1 hình bất kỳ về và để vào thư mục public/img
        if($p -> image && Storage::disk('public')->exists($p->image)){
            $p->image = Storage::url($p->image);
        }
        else{
            $p->image = "/img/no_image.jpg";
        }

    }

    public function index()
    {
        $lst = Product::all();
        foreach($lst as $p) {
            $this->fixImage($p);
        }
        return view('product-index',['lst' => $lst]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lst = Category::all();
        return view('product-create',['lst' => $lst]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $p = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'category_id'=>$request->category,
            'desc'=>$request->desc,
            // hình ảnh cập nhật sau khi có id sản phẩm
            'image'=>''
        ]);
        // đường dẫn lưu hình có id sản phẩm để dể quản lý
        $path = $request->image->store('upload/product/'.$p->id,'public');
        $p->image=$path;
        $p->save();
        // có thể tạo view cho route này nếu muốn hoặc redirect về trang ds sản phẩm
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $this->fixImage($product);
        if($request->expectsJson) {
            return $product;
        }
        return view('product-show',['p'=> $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->fixImage($product);
        $lst=Category::all();
        return view('product-edit',['p'=> $product,'lst'=>$lst]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Kiểm tra có cập nhật hình không
        $path = $product->image;
        if($request->hasFile('image') && $request->image->isValid())
        {
            $path = $request->image->store('upload/product/'.$product->id,'public');
        }

        $product->fill([
            'name'=>$request->name,
            'price'=>$request->price,
            'category_id'=>$request->category,
            'desc'=>$request->desc,
            'image'=>$path
        ]);
        $product->save();
        // có thể tạo view cho route này nếu muốn hoặc redirect về trang chi tiết sản phẩm
        return redirect()->route('products.show',['product'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        // có thể tạo view cho route này nếu muốn, hoặc redirect về trang ds sản phẩm
        return redirect()->route('products.index');
    }
}
