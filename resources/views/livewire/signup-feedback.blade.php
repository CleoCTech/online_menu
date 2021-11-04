<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div wire:loading wire:target='resendLink'>
        @livewire('general.loader')
    </div>
    <section class="bg-white pt-10" id="about">
        <div class="container px-5">
            <div class="row gx-5 d-flex justify-content-center align-items-center">
                <div class="col-lg-6 mb-5">
                    <div class="card rounded-3 text-dark">

                        <div class="card-body">
                            <div class="my-3 px-5 text-center">
                                You've successfully registered. We've sent a verification link to your email...
                            </div>
                            <div class="d-grid">
                                <button wire:click='resendLink' class="btn btn-primary fw-500" type="submit">
                                   Resend Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
