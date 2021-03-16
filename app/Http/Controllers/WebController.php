<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\Banner;
use App\Category;
use App\Product;
use App\Coupon;
use App\Payment;
use App\Order;
use App\Item;
use App\Shipping;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CartAddProductRequest;
use App\Http\Requests\CartQtyProductRequest;
use App\Http\Requests\CartAddCouponRequest;
use App\Http\Requests\CheckoutStoreRequest;
use App\Http\Requests\ProfileWebUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $banners=Banner::where('state', '1')->get();
        $categories=Category::all();
        $products=Product::where('state', '1')->get()->take(6);
        return view('web.home', compact('setting', 'banners', 'categories', 'products'));
    }

    public function categories() {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        return view('web.categories', compact('setting', 'categories'));
    }

    public function shop(Request $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        
        if ($request->has('page')) {
            $offset=10*(request('page')-1);
        } else {
            $offset=0;
        }

        if (is_null(request('category'))) {
            $products=Product::where([['qty', '>', 0], ['state', "1"]])->orderBy('id', 'DESC')->offset($offset)->limit(10)->get();
            $total=Product::where([['qty', '>', 0], ['state', "1"]])->get();
        } else {
            $category=Category::where('slug', request('category'))->firstOrFail();
            $products=$category->products->where('qty', '>', 0)->where('state', "1")->slice($offset)->take(10);
            $total=$category->products->where('qty', '>', 0)->where('state', "1");
        }

        if (!is_null(request('min')) && request('min')!=0) {
            $products=$products->where('price', '>=', request('min'));
        }

        if (!is_null(request('max')) && request('max')!=0) {
            $products=$products->where('price', '<=', request('max'));
        }
        $search=request()->all();

        $varPage='page';
        $page=Paginator::resolveCurrentPage($varPage);
        $pagination=new LengthAwarePaginator($products, $total=count($total), $perPage = 10, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $varPage]);

        return view('web.shop', compact('setting', 'products', 'categories', 'pagination', 'search'));
    }

    public function product($slug) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        $product=Product::where('slug', $slug)->firstOrFail();
        $products=Product::where([['id', '!=', $product->id], ['qty', '>', 0], ['state', '1']])->limit(4)->get();
        return view('web.product', compact('setting', 'categories', 'product', 'products'));
    }

    public function cart(Request $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        $total=0;
        $products=[];
        if ($request->session()->has('cart')) {
            $cart=session('cart');
            $request->session()->forget('cart');

            if (session()->has('coupon')) {
                $coupon=Coupon::where('slug', session('coupon')['coupon']->slug)->first();
                if (is_null($coupon) || $coupon->use>=$coupon->limit) {
                    $request->session()->forget('coupon');
                }
            }
            $num=0;
            foreach ($cart as $item) {
                $product=Product::where('slug', $item['product']->slug)->first();
                if (!is_null($product) && $product->qty>0) {
                    $products[$num]['product']=$product;
                    $products[$num]['code']=$item['code'];
                    
                    $products[$num]['qty']=($product->qty>=$item['qty']) ? $item['qty'] : $product->qty;
                    if ($product->discount>0) {
                        $subtotal=($product->price-(($product->price*$product->discount)/100))*$products[$num]['qty'];
                        $price=($product->price-(($product->price*$product->discount)/100));
                    } else {
                        $subtotal=$product->price*$products[$num]['qty'];
                        $price=$product->price;
                    }
                    $products[$num]['discount']=$product->discount;
                    $products[$num]['subtotal']=number_format($subtotal, 2, ',', '.');
                    $total+=$subtotal;

                    if ($num==0) {
                        $request->session()->put('cart', array(0 => ['product' => $product, 'qty' => $item['qty'], 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'discount' => $product->discount, 'code' => $item['code']]));
                    } else {
                        $request->session()->push('cart', array('product' => $product, 'qty' => $item['qty'], 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'discount' => $product->discount, 'code' => $item['code']));
                    }
                    $num++;
                }
            }
        }
        $subtotal=$total;
        $discount=(session()->has('coupon')) ? ($total*session('coupon')['coupon']->discount)/100 : 0.00;
        $total=$subtotal-$discount;    

        return view('web.cart', compact('setting', 'categories', "products", "subtotal", "discount", "total"));
    }

    public function checkout(Request $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        $total=0;
        $products=[];

        $cart=($request->session()->has('cart')) ? session('cart') : [];
        $request->session()->forget('cart');
        if (session()->has('coupon')) {
            $coupon=Coupon::where('slug', session('coupon')['coupon']->slug)->first();
            if (is_null($coupon) || $coupon->use>=$coupon->limit) {
                $request->session()->forget('coupon');
            }
        }
        $num=0;
        foreach ($cart as $item) {
            $product=Product::where('slug', $item['product']->slug)->first();
            if (!is_null($product) && $product->qty>0) {
                $products[$num]['product']=$product;
                $products[$num]['code']=$product->slug;

                $products[$num]['qty']=($product->qty>=$item['qty']) ? $item['qty'] : $product->qty;
                if ($product->discount>0) {
                    $subtotal=($product->price-((($product->price*$product->discount)/100)*$products[$num]['qty']));
                    $price=($product->price-(($product->price*$product->discount)/100));
                } else {
                    $subtotal=$product->price*$products[$num]['qty'];
                    $price=$product->price;
                }
                $products[$num]['discount']=$product->discount;
                $products[$num]['subtotal']=number_format($subtotal, 2, ',', '.');
                $products[$num]['price']=$price;
                $total+=$subtotal;

                if ($num==0) {
                    $request->session()->put('cart', array(0 => ['product' => $product, 'qty' => $item['qty'], 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'discount' => $product->discount, 'code' => $item['code']]));
                } else {
                    $request->session()->push('cart', array('product' => $product, 'qty' => $item['qty'], 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'discount' => $product->discount, 'code' => $item['code']));
                }
                $num++;
            }
        }
        $subtotal=$total;
        $discount=(session()->has('coupon')) ? ($total*session('coupon')['coupon']->discount)/100 : 0.00;
        $total=$subtotal-$discount;
        return view('web.checkout', compact('setting', 'categories', 'products', 'subtotal', 'discount', 'total'));
    }

    public function checkoutStore(CheckoutStoreRequest $request) {
        $cart=($request->session()->has('cart')) ? session('cart') : [];
        $coupon_id=(session()->has('coupon')) ? session('coupon')['coupon']->id : NULL;

        if (count($cart)==0) {
            return redirect()->back()->with(['type' => 'error', 'title' => 'Carrito Vacio', 'msg' => 'No ha agregado ningún producto al carrito.'])->withInputs();
        }

        if (!Auth::check()) {
            $exist=User::where('email', request('email'))->first();
            $existDelete=User::where('email', request('email'))->withTrashed()->first();
            if (is_null($exist) && !is_null($existDelete)) {
                return redirect()->back()->with(['type' => 'error', 'title' => 'Usuario Bloqueado', 'msg' => 'Este usuario esta bloqueado.'])->withInputs();
            }
            if (is_null($exist)) {
                $count=User::where('name', request('name'))->where('lastname', request('lastname'))->withTrashed()->count();
                $slug=Str::slug(request('name')." ".request('lastname'), '-');
                if ($count>0) {
                    $slug=$slug."-".$count;
                }

                // Validación para que no se repita el slug
                $num=0;
                while (true) {
                    $count2=User::where('slug', $slug)->withTrashed()->count();
                    if ($count2>0) {
                        $slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
                        $num++;
                    } else {
                        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'slug' => $slug, 'phone' => request('phone'), 'email' => request('email'), 'password' => Hash::make(request('password')));
                        break;
                    }
                }

                $user=User::create($data);
                $user->assignRole('Cliente');
            } else {
                $user=$exist;
            }

            Auth::login($user);
        }

        $subtotal=0;
        foreach ($cart as $item) {
            $subtotal+=$item['price']*$item['qty'];
        }
        $discount=(session()->has('coupon')) ? ($subtotal*session('coupon')['coupon']->discount)/100 : 0.00 ;
        $total=$subtotal-$discount;

        // Validación para que no se repita el slug
        $slug="pago";
        $num=0;
        while (true) {
            $count2=Payment::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="pago-".$num;
                $num++;
            } else {
                $data=array('slug' => $slug, 'subject' => "Pedido realizado", 'subtotal' => $subtotal, 'delivery' => 0.00, 'discount' => $discount, 'total' => $total, 'fee' => 0.00, 'balance' => $total, 'method' => request('payment'), 'user_id' => Auth::id(), 'coupon_id' => $coupon_id);
                break;
            }
        }

        $payment=Payment::create($data);

        if ($payment) {
            // Validación para que no se repita el slug
            $slug="pedido";
            $num=0;
            while (true) {
                $count2=Order::where('slug', $slug)->count();
                if ($count2>0) {
                    $slug="pedido-".$num;
                    $num++;
                } else {
                    $data=array('slug' => $slug, 'subtotal' => $subtotal, 'delivery' => 0.00, 'discount' => $discount, 'total' => $total, 'fee' => 0.00, 'balance' => $total, 'phone' => request('phone'), 'type_delivery' => request('shipping'), 'user_id' => Auth::id(), 'coupon_id' => $coupon_id, 'payment_id' => $payment->id);
                    break;
                }
            }

            $order=Order::create($data);

            if ($order) {
                if (request('shipping')=='3') {
                    $data=array('address' => request('address'), 'order_id' => $order->id);
                    Shipping::create($data);
                }

                if (session()->has('coupon')) {
                    $coupon=Coupon::where('id', $coupon_id)->withTrashed()->first();
                    if (!is_null($coupon)) {
                        $uses=$coupon->use+1;
                        $coupon->fill(['use' => $uses])->save();
                    }
                }

                foreach ($cart as $item) {
                    $product=Product::where('slug', $item['product']->slug)->withTrashed()->first();
                    $data=array('price' => $item['price'], 'discount' => $item['discount'], 'qty' => $item['qty'], 'subtotal' => number_format($item['price']*$item['qty'], 2, ".", ""), 'product_id' => $product->id, 'order_id' => $order->id);
                    $orderItem=Item::create($data);
                    if ($orderItem && !is_null($product) ) {
                        $qty=($product->qty>=$item['qty']) ? ($product->qty-$item['qty']) : 0;
                        $product->fill(['qty' => $qty])->save();
                    }
                }

                $request->session()->forget('cart');
                $request->session()->forget('coupon');

                return redirect()->route('home')->with(['type' => 'success', 'title' => 'Pedido exitoso', 'msg' => 'El pedido ha sido enviado exitosamente.']);
            }
        }

        return redirect()->back()->with(['type' => 'error', 'title' => 'Pedido fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
    }

    public function politics() {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        return view('web.politics', compact('setting', 'categories'));
    }

    public function terms() {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        return view('web.terms', compact('setting', 'categories'));
    }

    public function cartAdd(CartAddProductRequest $request) {
        $product=Product::where('slug', request('product'))->first();
        if (!is_null($product) && $product->qty>0) {
            $code=$product->slug;

            if ($request->session()->has('cart')) {
                $cart=session('cart');

                if (array_search($code, array_column($cart, 'code'))!==false) {

                    $key=array_search($code, array_column($cart, 'code'));
                    $cart[$key]['product']=$product;
                    $cart[$key]['qty']=($product->qty>=($cart[$key]['qty']+request('qty'))) ? $cart[$key]['qty']+request('qty') : $product->qty;
                    if ($product->discount>0) {
                        $subtotal=($product->price-(($product->price*$product->discount)/100))*$cart[$key]['qty'];
                        $cart[$key]['price']=($product->price-(($product->price*$product->discount)/100));
                    } else {
                        $subtotal=$product->price*$cart[$key]['qty'];
                        $cart[$key]['price']=$product->price;
                    }
                    $cart[$key]['discount']=$product->discount;
                    $cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
                    $request->session()->put('cart', $cart);

                    return response()->json(['status' => true, 'product' => $cart[$key], 'exist' => true]);

                } else {
                    $qty=($product->qty>=request('qty')) ? request('qty') : $product->qty;
                    if ($product->discount>0) {
                        $subtotal=($product->price-(($product->price*$product->discount)/100))*$qty;
                        $price=($product->price-(($product->price*$product->discount)/100));
                    } else {
                        $subtotal=$product->price*$qty;
                        $price=$product->price;
                    }
                    $data=array('product' => $product, 'qty' => $qty, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'discount' => $product->discount, 'code' => $code);
                    $request->session()->push('cart', $data);

                    return response()->json(['status' => true, 'product' => $data, 'exist' => false]);
                }
            } else {
                $qty=($product->qty>=request('qty')) ? request('qty') : $product->qty;
                if ($product->discount>0) {
                    $subtotal=($product->price-(($product->price*$product->discount)/100))*$qty;
                    $price=($product->price-(($product->price*$product->discount)/100));
                } else {
                    $subtotal=$product->price*$qty;
                    $price=$product->price;
                }
                $data=array('product' => $product, 'qty' => $qty, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'discount' => $product->discount, 'code' => $code);
                $request->session()->push('cart', $data);

                return response()->json(['status' => true, 'product' => $data, 'exist' => false]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function cartRemove(Request $request) {
        if ($request->session()->has('cart')) {
            $cart=session('cart');

            if (array_search(request('code'), array_column($cart, 'code'))!==false) {
                $request->session()->forget('cart');
                foreach ($cart as $item) {
                    if (request('code')!=$item['code']) {
                        if (!$request->session()->has('cart')) {
                            $request->session()->put('cart', array(0 => $item));
                        } else {
                            $request->session()->push('cart', $item);
                        }
                    }
                }

                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function cartQty(CartQtyProductRequest $request) {
        $product=Product::where('slug', request('slug'))->first();
        if (!is_null($product) && $product->qty>0) {
            $cart=session('cart');
            if (array_search(request('code'), array_column($cart, 'code'))!==false) {
                $key=array_search(request('code'), array_column($cart, 'code'));
                $cart[$key]['product']=$product;
                $cart[$key]['qty']=($product->qty>=request('qty')) ? request('qty') : $product->qty;
                if ($product->discount>0) {
                    $subtotal=($product->price-(($product->price*$product->discount)/100))*$cart[$key]['qty'];
                    $cart[$key]['price']=($product->price-(($product->price*$product->discount)/100));
                } else {
                    $subtotal=$product->price*$cart[$key]['qty'];
                    $cart[$key]['price']=$product->price;
                }
                $cart[$key]['discount']=$product->discount;
                $cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
                $request->session()->put('cart', $cart);

                return response()->json(['status' => true, 'subtotal' => $subtotal]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function couponAdd(CartAddCouponRequest $request) {
        $coupon=Coupon::where('code', request('coupon'))->first();
        if (!is_null($coupon)) {
            if ($coupon->orders->where('user_id', Auth::id())->count()==0) {
                if ($coupon->limit>$coupon->use) {
                    if (!session()->has('coupon')) {
                        $request->session()->put('coupon', ['coupon' => $coupon]);
                        return response()->json(["state" => true, "discount" => $coupon->discount]);
                    }

                    return response()->json(["state" => false, "title" => "Límite Alcanzado", "message" => "Ya has usado un cupón para esta compra."]);
                }

                return response()->json(["state" => false, "title" => "Cupón Expirado", "message" => "Este cupón ha expirado."]);
            }

            return response()->json(["state" => false, "title" => "Cupón No Disponible", "message" => "Ya has utilizado este cupón."]);
        }

        return response()->json(["state" => false, "title" => "Cupón Incorrecto", "message" => "Este cupón no es correcto."]);
    }

    public function couponRemove(Request $request) {
        $request->session()->forget('coupon');
        return response()->json(["state" => true]);
    }

    public function profile() {
        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        $orders=Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('web.profile', compact('setting', 'categories', 'orders'));
    }

    public function profileUpdate(ProfileWebUpdateRequest $request) {
        $user=User::where('slug', Auth::user()->slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'));

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $user->fill($data)->save();

        if ($user) {
            if ($request->hasFile('photo')) {
                Auth::user()->photo=$data['photo'];
            }
            Auth::user()->name=request('name');
            Auth::user()->lastname=request('lastname');
            Auth::user()->phone=request('phone');
            if (!is_null(request('password'))) {
                Auth::user()->password=Hash::make(request('password'));
            }
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El perfil ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function order($slug) {
        $order=Order::where('slug', $slug)->firstOrFail();
        if ($order->user_id!=Auth::id()) {
            return redirect()->route('web.profile');
        }

        $setting=Setting::where('id', 1)->firstOrFail();
        $categories=Category::all();
        return view('web.order', compact('setting', 'categories', 'order'));
    }
}