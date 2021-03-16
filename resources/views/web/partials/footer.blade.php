<footer>
    <div class="wave footer"></div>
    <div class="container margin_60_40 fix_mobile">

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_1">Enlaces Rápidos</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('web.categories') }}">Categorías</a></li>
                        <li><a href="{{ route('web.shop') }}">Tienda</a></li>
                        <li><a href="{{ route('web.cart') }}">Carrito</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_2">Categorías</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        @foreach($categories->where('state', '1')->take(4) as $category)
                        <li>
                            <a href="{{ route('web.categories', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3">Contactos</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        @if(!is_null($setting->address) && !empty($setting->address))
                        <li><i class="icon_house_alt"></i>{{ $setting->address }}</li>
                        @endif
                        @if(!is_null($setting->phone) && !empty($setting->phone))
                        <li><i class="icon_mobile"></i>
                            <a href="tel:+57{{ $setting->phone }}">{{ $setting->phone }}</a>
                        </li>
                        @endif
                        @if(!is_null($setting->email) && !empty($setting->email))
                        <li>
                            <i class="icon_mail_alt"></i>
                            <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                        </li>
                        @endif
                        @if(!is_null($setting->schedule) && !empty($setting->schedule))
                        <li><i class="icon_clock_alt"></i>{!! $setting->schedule !!}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_4">Mantenerse en Contacto</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Tu e-mail">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form> 
                    </div>
                    @if(is_null(($setting->twitter) || empty($setting->twitter)) && (is_null($setting->facebook) || empty($setting->facebook)) && (is_null($setting->instagram) || empty($setting->instagram)))
                    <div class="follow_us">
                        <h5>Síguenos</h5>
                        <ul>
                            @if(!is_null($setting->twitter) && !empty($setting->twitter))
                            <li>
                                <a href="{{ $setting->twitter }}" target="_blank">
                                    <img src="{{ asset('/web/img/twitter_icon.svg') }}" title="Twitter" alt="Twitter" class="lazy">
                                </a>
                            </li>
                            @endif
                            @if(!is_null($setting->facebook) && !empty($setting->facebook))
                            <li>
                                <a href="{{ $setting->facebook }}" target="_blank">
                                    <img src="{{ asset('/web/img/facebook_icon.svg') }}" title="Facebook" alt="Facebook" class="lazy">
                                </a>
                            </li>
                            @endif
                            @if(!is_null($setting->instagram) && !empty($setting->instagram))
                            <li>
                                <a href="{{ $setting->instagram }}" target="_blank">
                                    <img src="{{ asset('/web/img/instagram_icon.svg') }}" title="Instagram" alt="Instagram" class="lazy">
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    <li>
                        <img src="{{ asset('/web/img/cards_all.svg') }}" title="Tarjetas de Credito" alt="Tarjetas de Credito" width="230" height="35" class="lazy">
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="{{ route('web.terms') }}">Términos y Condiciones</a></li>
                    <li><a href="{{ route('web.politics') }}">Políticas de Privacidad</a></li>
                    <li><span>© DeliApp. Realizado por Bryant Jimenez - 27240127</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>