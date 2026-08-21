
{{-- kullanmak istediğin yere  @include('new.product'))--}}
        <article class="product-card">
            <a class="thumb" href="{{route('product.index', ['category' => $p->getcategory->slug,'product' => $p->slug])}}">
                <img src="${p.images[0]}" alt="{{$p->name}}" loading="lazy">
                <span class="flags">
                                @if($p->price!=$p->discount_price)  <span class="badge badge-danger">%{{(($p->price-$p->discount_price)/$p->price)*100}} indirim</span>@endif
                    @if($p->is_new==1)  <span class="badge badge-accent">Yeni</span>@endif
                    {{--stock durumu sorgulama eksik--}}
                    @if(0) <span class="badge badge-muted">Tükendi</span>@endif

                             </span>
            </a>
            <button class="fav-btn ${fav ? "on" : ""}" data-fav="${p.id}" aria-label="Favorilere ekle">${fav ? "♥" : "♡"}</button>
            <div class="body">
                @if($p->brand_id!=null)<span class="brand">{{$p->getBrand->name}}</span> @endif
                <a class="name" href="urun.html?p=${p.slug}">{{$p->name}}</a>
                <div class="price-row">
                    @if($p->price==$p->discount_price or $p->discount_price==null)
                        <span class="price">{{$p->price}}</span>
                    @else
                        <span class="price">{{$p->discount_price}}</span>
                        <span class="price-old">{{$p->price}}</span>
                    @endif

                </div>
                @if(0) ${p.stock === 0
                <span class="stock-out">Stokta yok</span>` @endif
                <button class="btn btn-block" data-add="${p.id}">Sepete ekle</button>
            </div>
        </article>


