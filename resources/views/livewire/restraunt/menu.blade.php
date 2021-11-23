<div>
    {{-- Be like water. --}}
     <section class="bg-white pb-25 pt-15 " style = "padding-bottom : 15rem;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title text-center">
                            <h1>{{ $resDetails->name }}</h1>
                            <h5>Slogan &amp; Example: delicious cuisine</h5>
                        </div>
                    </div>
                    @foreach ($disheCategories as $disheCategory)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="menu-block mb60">
                            <div class="menu-head"> <span class="menu-icon">
                                {{-- <img src="assets/img/burger.png" alt="Starters" class="icon-4x icon-primary" /> --}}
                            </span>
                                <h2 class="menu-title">{{ $disheCategory->name }}</h2>
                            </div>
                            <div class="menu-list">
                                <ul class="listnone">
                                    @foreach ($disheCategory->dishes as $dish)
                                    {{-- @if ($dish->menuCategory->status == 1) --}}
                                    <li>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-3">
                                                {{-- {{ asset('storage/images/'.$article->image) }} --}}
                                                <img src="{{ asset('storage/public/'.$resDetails->code.'/'.$dish->folder.'/'.$dish->filename) }}"
                                                 alt=" " class="img-fluid rounded-circle " style="width:70px; height:70px;">
                                            </div>
                                            <div class="details ">
                                                {{ $dish->name }}....................................
                                                <span class="meta-price ">$ {{ $dish->prices[0]->price }}</span>
                                                @if ($dish->allergnes)
                                                <p class="sm">Contains: (
                                                    @foreach ($this->getAllergnes($dish->id) as $item)
                                                    {{ $item->allergene->name }},
                                                    @endforeach)
                                                 </p>
                                                @endif

                                            </div>
                                        </div>
                                    </li>
                                    {{-- @endif --}}
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="menu-block mb60 ">
                            <div class="menu-head "> <span class="menu-icon ">
                                <img src="assets/img/salad.png " alt="Starters " class="icon-4x icon-primary " />
                            </span>
                                <h2 class="menu-title ">Salads</h2>
                            </div>
                            <div class="menu-list ">
                                <ul class="listnone ">
                                    <li>Caesar Salad....................................<span class="meta-price ">$6</span></li>
                                    <li>Ton Salad.......................................<span class="meta-price ">$10</span></li>
                                    <li>Somon Salad..................................<span class="meta-price ">$12</span></li>
                                    <li>Akdeniz Salad................................<span class="meta-price ">$16</span></li>
                                    <li>Fresh Tuna Salad...........................<span class="meta-price ">$20</span></li>
                                    <li>Farro Salad....................................<span class="meta-price ">$22</span></li>
                                    <li>Sour-Cream Salad.........................<span class="meta-price ">$10</span></li>
                                    <li>Akdeniz Salad................................<span class="meta-price ">$16</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="menu-block mb60 ">
                            <div class="menu-head "> <span class="menu-icon ">
                                <img src="assets/img/pancakes.png " alt="Starters " class="icon-4x icon-primary " />
                            </span>
                                <h2 class="menu-title ">Dessert</h2>
                            </div>
                            <div class="menu-list ">
                                <ul class="listnone ">
                                    <li>Pudding........................................<span class="meta-price ">$15</span></li>
                                    <li>Flavored Kulfi...............................<span class="meta-price ">$10</span></li>
                                    <li>Dry Sweet......................................<span class="meta-price ">$12</span></li>
                                    <li>Apple Pie........................................<span class="meta-price ">$8</span></li>
                                    <li>Custard........................................<span class="meta-price ">$10</span></li>
                                    <li>Sobert...........................................<span class="meta-price ">$18</span></li>
                                    <li>Panna Cotta.................................<span class="meta-price ">$20</span></li>
                                    <li>Black Forest..................................<span class="meta-price ">$20</span></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
</div>
