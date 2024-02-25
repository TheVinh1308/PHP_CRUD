<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    protected function fixImage(Product $p) {
        //tự download 1 hình bất kỳ về và để vào thư mục public/img
        if($p -> image && Storage::disk('public')->exists($p->image)){
            $p->image = Storage::url($p->image);
        }
        else{
            $p->image = "/img/no_image.jpg";
        }

    }
    // --api không có create và edit
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Tạo sản phẩm mới
        $product = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'desc' => $request->input('desc'),
            'image' => ''
        ]);

        // Lưu sản phẩm vào cơ sở dữ liệu
        $product->save();

        // Lưu hình ảnh
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('upload/product/'.$product->id, 'public');
            $product->image = $path;

        }

    // Trả về phản hồi JSON thành công
        return response()->json(['message' => 'Sản phẩm đã được tạo thành công', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with('category')->find($id);
        // tự code các phần còn lại
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
        // Tìm sản phẩm cần cập nhật
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        // Cập nhật thông tin sản phẩm từ dữ liệu gửi đến từ request
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->desc = $request->input('desc');

        // Kiểm tra và lưu hình ảnh nếu có
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('upload/product/'.$product->id, 'public');
            $product->image = $path;
        }

        // Lưu sản phẩm vào cơ sở dữ liệu
        $product->save();

        // Trả về phản hồi JSON thành công
        return response()->json(['message' => 'Sản phẩm đã được cập nhật thành công', 'product' => $product], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        $product->save();

        // Trả về phản hồi JSON thành công
        return response()->json(['message' => 'Sản phẩm đã được xóa thành công', 'product' => $product], 202);
    }
}
