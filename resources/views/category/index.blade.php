@extends('layout.app')
@section('content')
    <main>
        <div class="page-head"><div class="wrap">
                <nav class="crumbs"><a href="{{route('index')}}">Ana Sayfa</a> ›@if($category->parent_id !== null)
                   <a href="{{route('category.index',$category->parent->slug)}}">{{$category->parent->name}}</a>› @endif <a href="{{route('category.index',$category->slug)}}">{{$category->name}}</a></nav>
                <h1 id="pageTitle">{{$category->name}}</h1>
                <p id="pageDesc">Marka, fiyat aralığı ve stok durumuna göre filtreleyerek size uygun ürünü bulun.</p>
                <div class="subcategory-strip" id="subcategoryStrip">
                    @if($category->children()->exists())
                        <a class="active" href="{{route('category.index',$category->slug)}}">Tümü</a>
                        @foreach($children as $c)
                            <a class="" href="{{route('category.index',$c->slug)}}">{{$c->name}}</a>
                        @endforeach
                @endif

                </div>
            </div></div>
        <div class="wrap list-layout">
            <aside class="filters">
                <div class="filter-group"><h4>Marka</h4>
                    <label class="check"><input type="checkbox" value="NovaBook" data-brand=""> NovaBook</label>
                </div>
                <div class="filter-group"><h4>Maksimum fiyat</h4>
                    <input class="range" type="range" min="500" max="89999" value="89999" step="500" id="priceRange">
                    <div class="muted" style="font-size:13px" id="priceOut">₺89.999</div>
                </div>
                <div class="filter-group">
                    <label class="check"><input type="checkbox" id="inStock"> Sadece stoktakiler</label>
                </div>
                <div class="filter-group"><button class="btn btn-outline btn-block" id="clearFilters">Filtreleri temizle</button></div>
            </aside>
            <section>
                <div class="toolbar">
                    <span class="count" id="listCount">{{$category->getproduct->count() }} ürün listeleniyor</span>
                    <select id="sortSel">
                        <option value="onerilen">Önerilen</option>
                        <option value="artan">Fiyat: Artan</option>
                        <option value="azalan">Fiyat: Azalan</option>
                        <option value="puan">Puana göre</option>
                    </select>
                </div>
                <div class="grid-products" >
                    @foreach($category->getproduct as $p)
                        @include('new.product')
                    @endforeach
                </div>

    </main>


@endsection
