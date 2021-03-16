<?php 

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////
Auth::routes();
Route::get('/usuarios/email', 'AdminController@emailVerifyAdmin');

/////////////////////////////////////////////// WEB ////////////////////////////////////////////////
Route::get('/', 'WebController@index')->name('home');

Route::get('/tienda', 'WebController@shop')->name('web.shop');
Route::get('/productos/{slug}', 'WebController@product')->name('web.product');
Route::get('/carrito', 'WebController@cart')->name('web.cart');

Route::get('/categorias', 'WebController@categories')->name('web.categories');
Route::get('/finalizar-compra', 'WebController@checkout')->name('web.checkout');
Route::post('/finalizar-compra', 'WebController@checkoutStore')->name('web.checkout.store');
Route::get('/politicas-de-privacidad', 'WebController@politics')->name('web.politics');
Route::get('/terminos-y-condiciones', 'WebController@terms')->name('web.terms');
// Carrito
Route::post('/carrito', 'WebController@cartAdd')->name('cart.add');
Route::post('/carrito/quitar', 'WebController@cartRemove')->name('cart.remove');
Route::post('/carrito/cantidad', 'WebController@cartQty')->name('cart.qty');
// Cupones
Route::post('/cupon/agregar', 'WebController@couponAdd')->name('coupon.add');
Route::post('/cupon/quitar', 'WebController@couponRemove')->name('coupon.remove');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/perfil', 'WebController@profile')->name('web.profile');
	Route::put('/perfil', 'WebController@profileUpdate')->name('web.profile.update');
	Route::get('/perfil/compras/{slug}', 'WebController@order')->name('web.order');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/perfil', 'AdminController@profile')->name('profile');
	Route::get('/admin/perfil/editar', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/perfil/', 'AdminController@profileUpdate')->name('profile.update');

	// Usuarios
	Route::get('/admin/usuarios', 'UserController@index')->name('usuarios.index')->middleware('permission:users.index');
	Route::get('/admin/usuarios/registrar', 'UserController@create')->name('usuarios.create')->middleware('permission:users.create');
	Route::post('/admin/usuarios', 'UserController@store')->name('usuarios.store')->middleware('permission:users.create');
	Route::get('/admin/usuarios/{slug}', 'UserController@show')->name('usuarios.show')->middleware('permission:users.show');
	Route::get('/admin/usuarios/{slug}/editar', 'UserController@edit')->name('usuarios.edit')->middleware('permission:users.edit');
	Route::put('/admin/usuarios/{slug}', 'UserController@update')->name('usuarios.update')->middleware('permission:users.edit');
	Route::delete('/admin/usuarios/{slug}', 'UserController@destroy')->name('usuarios.delete')->middleware('permission:users.delete');
	Route::put('/admin/usuarios/{slug}/activar', 'UserController@activate')->name('usuarios.activate')->middleware('permission:users.active');
	Route::put('/admin/usuarios/{slug}/desactivar', 'UserController@deactivate')->name('usuarios.deactivate')->middleware('permission:users.deactive');

	// Banners
	Route::get('/admin/banners', 'BannerController@index')->name('banners.index')->middleware('permission:banners.index');
	Route::get('/admin/banners/registrar', 'BannerController@create')->name('banners.create')->middleware('permission:banners.create');
	Route::post('/admin/banners', 'BannerController@store')->name('banners.store')->middleware('permission:banners.create');
	Route::get('/admin/banners/{slug}/editar', 'BannerController@edit')->name('banners.edit')->middleware('permission:banners.edit');
	Route::put('/admin/banners/{slug}', 'BannerController@update')->name('banners.update')->middleware('permission:banners.edit');
	Route::delete('/admin/banners/{slug}', 'BannerController@destroy')->name('banners.delete')->middleware('permission:banners.delete');
	Route::put('/admin/banners/{slug}/activar', 'BannerController@activate')->name('banners.activate')->middleware('permission:banners.active');
	Route::put('/admin/banners/{slug}/desactivar', 'BannerController@deactivate')->name('banners.deactivate')->middleware('permission:banners.deactive');

	// Categorias
	Route::get('/admin/categorias', 'CategoryController@index')->name('categorias.index')->middleware('permission:categories.index');
	Route::get('/admin/categorias/registrar', 'CategoryController@create')->name('categorias.create')->middleware('permission:categories.create');
	Route::post('/admin/categorias', 'CategoryController@store')->name('categorias.store')->middleware('permission:categories.create');
	Route::get('/admin/categorias/{slug}/editar', 'CategoryController@edit')->name('categorias.edit')->middleware('permission:categories.edit');
	Route::put('/admin/categorias/{slug}', 'CategoryController@update')->name('categorias.update')->middleware('permission:categories.edit');
	Route::delete('/admin/categorias/{slug}', 'CategoryController@destroy')->name('categorias.delete')->middleware('permission:categories.delete');
	Route::put('/admin/categorias/{slug}/activar', 'CategoryController@activate')->name('categorias.activate')->middleware('permission:categories.active');
	Route::put('/admin/categorias/{slug}/desactivar', 'CategoryController@deactivate')->name('categorias.deactivate')->middleware('permission:categories.deactive');

	// Productos
	Route::get('/admin/productos', 'ProductController@index')->name('productos.index')->middleware('permission:products.index');
	Route::get('/admin/productos/registrar', 'ProductController@create')->name('productos.create')->middleware('permission:products.create');
	Route::post('/admin/productos', 'ProductController@store')->name('productos.store')->middleware('permission:products.create');
	Route::get('/admin/productos/{slug}/editar', 'ProductController@edit')->name('productos.edit')->middleware('permission:products.edit');
	Route::put('/admin/productos/{slug}', 'ProductController@update')->name('productos.update')->middleware('permission:products.edit');
	Route::delete('/admin/productos/{slug}', 'ProductController@destroy')->name('productos.delete')->middleware('permission:products.delete');
	Route::put('/admin/productos/{slug}/activar', 'ProductController@activate')->name('productos.activate')->middleware('permission:products.active');
	Route::put('/admin/productos/{slug}/desactivar', 'ProductController@deactivate')->name('productos.deactivate')->middleware('permission:products.deactive');

	// Pedidos
	Route::get('/admin/pedidos', 'OrderController@index')->name('pedidos.index')->middleware('permission:orders.index');
	Route::get('/admin/pedidos/{slug}', 'OrderController@show')->name('pedidos.show')->middleware('permission:orders.show');
	Route::put('/admin/pedidos/{slug}/activar', 'OrderController@activate')->name('pedidos.activate')->middleware('permission:orders.active');
	Route::put('/admin/pedidos/{slug}/desactivar', 'OrderController@deactivate')->name('pedidos.deactivate')->middleware('permission:orders.deactive');

	// Pagos
	Route::get('/admin/pagos', 'PaymentController@index')->name('pagos.index')->middleware('permission:payments.index');
	Route::get('/admin/pagos/{slug}', 'PaymentController@show')->name('pagos.show')->middleware('permission:payments.show');
	Route::put('/admin/pagos/{slug}/activar', 'PaymentController@activate')->name('pagos.activate')->middleware('permission:payments.active');
	Route::put('/admin/pagos/{slug}/desactivar', 'PaymentController@deactivate')->name('pagos.deactivate')->middleware('permission:payments.deactive');

	// Cupones
	Route::get('/admin/cupones', 'CouponController@index')->name('cupones.index')->middleware('permission:coupons.index');
	Route::get('/admin/cupones/registrar', 'CouponController@create')->name('cupones.create')->middleware('permission:coupons.create');
	Route::post('/admin/cupones', 'CouponController@store')->name('cupones.store')->middleware('permission:coupons.create');
	Route::get('/admin/cupones/{slug}/editar', 'CouponController@edit')->name('cupones.edit')->middleware('permission:coupons.edit');
	Route::put('/admin/cupones/{slug}', 'CouponController@update')->name('cupones.update')->middleware('permission:coupons.edit');
	Route::delete('/admin/cupones/{slug}', 'CouponController@destroy')->name('cupones.delete')->middleware('permission:coupons.delete');

	// Términos y condiciones
	Route::get('/admin/terminos/editar', 'SettingController@editTerms')->name('terminos.edit')->middleware('permission:settings.edit');
	Route::put('/admin/terminos', 'SettingController@updateTerms')->name('terminos.update')->middleware('permission:settings.edit');

	// Politicas de privacidad
	Route::get('/admin/politicas/editar', 'SettingController@editPolitics')->name('politicas.edit')->middleware('permission:settings.edit');
	Route::put('/admin/politicas', 'SettingController@updatePolitics')->name('politicas.update')->middleware('permission:settings.edit');

	// Contactos
	Route::get('/admin/contactos/editar', 'SettingController@editContacts')->name('contactos.edit')->middleware('permission:settings.edit');
	Route::put('/admin/contactos', 'SettingController@updateContacts')->name('contactos.update')->middleware('permission:settings.edit');
});