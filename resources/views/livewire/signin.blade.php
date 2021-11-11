<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div wire:loading wire:target='sign'>
        @livewire('general.loader')
    </div>
    <section class="page-header-ui page-header-ui-dark
    bg-img-repeat bg-secondary" id="about" style="background-image: url({{asset('assets/img/pattern-shapes.png')}}) ">
        <div class="container px-5">
            <div class="row gx-5 d-flex justify-content-center align-items-center">
                <div class="col-lg-6 mb-5">
                    <div class="card rounded-3 text-dark">
                        <div class="card-header py-4 text-center fw-bold text-uppercase">
                            Login
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="small text-gray-600" for="userEmail">Email address</label>
                                    <input wire:model.defer='email' class="form-control" id="userEmail" type="email" />
                                </div>
                                <div class="mb-3">
                                    <label class="small text-gray-600" for="password">Password</label>
                                    <input wire:model.defer='password' class="form-control" id="password" type="text" />
                                </div>
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <div><input wire:model.defer='remember' type="checkbox" id="remember" /> Remember Me</div> <a href=""
                                        class="text-primary">Forgot password?</a>
                                </div>
                                <div class="d-grid">
                                    <button wire:click='signin' class="btn btn-primary fw-500" type="submit">
                                        Sign In
                                    </button>
                            </div>
                                <div class="my-3">
                                    Don't have an account? <a href="{{ route('signup') }}" class="text-primary">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
