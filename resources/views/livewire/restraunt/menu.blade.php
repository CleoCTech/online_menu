<div>
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

                        </span>
                            <h2 class="menu-title">{{ $disheCategory->name }}</h2>
                        </div>
                        <div class="menu-list">
                            <ul class="listnone">
                                @foreach ($disheCategory->dishes as $dish)
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
                                                @endforeach)  @if ($dish->frozen)
                                                and frozen substances</p>
                                                @endif
                                            </p>
                                            @endif


                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>

</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("DOMContentLoaded");
        var screen_resolution = (window.screen.width * window.devicePixelRatio + "x" + window.screen.height * window.devicePixelRatio);
        // alert("Your screen resolution is: " + screen_resolution);
        setTimeout(function () {
            // window.livewire.emit('say-hello', { name : 'John' });
            window.livewire.emit('updateScreenRes', { screen_resolution : screen_resolution });
        }, 5000);

    });
</script>
@endpush
