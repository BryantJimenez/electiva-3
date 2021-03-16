<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ImageProduct;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products=Product::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.products.index', compact('products', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories=Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request) {
        $count=Product::where('name', request('name'))->withTrashed()->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Product::where('slug', $slug)->withTrashed()->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $category=Category::where('slug', request('category_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'description' => request('description'), 'price' => request('price'), 'qty' => request('qty'), 'discount' => request('discount'), 'category_id' => $category->id);
                break;
            }
        }

        $product=Product::create($data);

        // Mover imagen a carpeta products y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $image=store_files($file, $slug, '/admins/img/products/');
            ImageProduct::create(['image' => $image, 'product_id' => $product->id])->save();
        }

        if ($product) {
            return redirect()->route('productos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El producto ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('productos.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $product=Product::where('slug', $slug)->firstOrFail();
        $categories=Category::all();
        return view('admin.products.edit', compact("categories", "product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $slug) {
        $product=Product::where('slug', $slug)->firstOrFail();
        $category=Category::where('slug', request('category_id'))->firstOrFail();
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'), 'qty' => request('qty'), 'discount' => request('discount'), 'category_id' => $category->id);

        $product->fill($data)->save();

        // Mover imagen a carpeta products y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $image=store_files($file, $slug, '/admins/img/products/');
            ImageProduct::create(['image' => $image, 'product_id' => $product->id])->save();
        }

        if ($product) {
            return redirect()->route('productos.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido editado exitosamente.']);
        } else {
            return redirect()->route('productos.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product=Product::where('slug', $slug)->firstOrFail();
        $product->delete();

        if ($product) {
            return redirect()->route('productos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El producto ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $product=Product::where('slug', $slug)->firstOrFail();
        $product->fill(['state' => "0"])->save();

        if ($product) {
            return redirect()->route('productos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {
        $product=Product::where('slug', $slug)->firstOrFail();
        $product->fill(['state' => "1"])->save();

        if ($product) {
            return redirect()->route('productos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido activado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function addProduct($slug)
    {
        $product=Product::where('slug', $slug)->first();
        if (!is_null($product)) {
            $product=$product->only("name", "slug", "description", "price", "qty", "discount", "state");
            return response()->json(['status' => true, 'product' => $product]);
        }

        return response()->json(['status' => false]);
    }
}
