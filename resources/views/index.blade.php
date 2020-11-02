@extends('layouts.app')

@section('content')
    <div class = "container">
        <!--Start of new goods-->
        @if(isset($latest))
            <div class = "new_goods">
                <div class = "new_goods__header">
                    Новые товары
                    <div class = "nav"><i class="fas fa-angle-left"></i> <i class="fas fa-angle-right"></i></div>
                </div>
                <div class = "new_goods__body">

                    @foreach($latest as $latestItem)
                        <a href = "{{route('product', $latestItem->id)}}" class = "new_goods__card">
                            <img src = "{{$latestItem->preview}}" alt = "">
                            <div class = "new_goods__card_text">
                                <span class = "name">{{$latestItem->name}}</span>
                                <span class = "price">{{$latestItem->spaced_price}}руб.</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
    @endif
    <!--End of new goods-->
        <!-- Start of promo goods -->
        <div class = "promo">
            <div class = "item_1">
                <div class = "promo_h1">
                    Заголовок
                    <span>Промо-товара</span>
                </div>
            </div>
            <div class = "item_2">
                <div class = "promo_h1">
                    Заголовок
                    <span>Промо-товара</span>
                </div>
            </div>
            <div class = "item_3">
                <div class = "promo_h1">
                    Заголовок
                    <span>Промо-товара</span>
                </div>
            </div>
        </div>
        <!-- End of promo goods -->
        <!-- Start of popular goods -->
        @isset($popular)
            <div class="product-slider">
                <div class="header">
                    Популярные товары
                    <div class="header__nav"><i class="fas fa-angle-left"></i> <i
                                class="fas fa-angle-right"></i></div>
                </div>
                <div class="body">
                    @foreach($popular as $item)
                        <a href="{{route('product', $item->id)}}" class="card">
                            <img class="card__image" src="{{$item->preview}}" alt="{{$item->name}}">

                            <div class="card__text">
                                <span class="card__text--name">{{$item->name}}</span>
                                <span class="card__text--price">{{$item->spaced_price}}руб.</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
    @endisset
    <!-- End of popular goods -->


        <!-- Start of about block -->
        <div class = "about">
            <div class = "about_text">
                <div class = "about__header">О магазине</div>
                <span class = "about__body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                    ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
                    Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                    arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede
                    mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                    eleifend tellus.
                </span>
            </div>

        </div>

        <!-- End of about block -->

    </div>


@endsection
