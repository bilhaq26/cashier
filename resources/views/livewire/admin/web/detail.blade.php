<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div id="kt_app_content_container" class="app-container container-fluid">
        <form wire:submit.prevent="update()">
            <!--begin::Navbar-->
            <div class="card card-flush mb-9" id="kt_user_profile_panel">
                <!--begin::Hero nav-->
                <div class="card-header rounded-top bgi-size-cover h-200px"
                    style="background-position: 100% 50%; background-image:url('{{ asset('assets/media/misc/profile-head-bg.jpg') }}')">
                </div>

                <!--end::Hero nav-->
                <!--begin::Body-->
                <div class="card-body mt-n19">
                    <!--begin::Details-->
                    <div class="m-0">
                        <!--begin: Pic-->
                        <div wire:ignore class="d-flex flex-stack align-items-end pb-4 mt-n19">
                            <div class="symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('')">
                                    <!--begin::Preview existing avatar-->
                                    @if ($faviconPrev)
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url({{ asset('img/identitas/'.$faviconPrev) }})"></div>
                                    @elseif($favicon)
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url({{ $favicon->temporaryUrl() }})"></div>
                                    @endif
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow @error('favicon')
                                        is-invalid @enderror" data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input wire:model="favicon" type="file" name="avatar"
                                            accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Format Gambar : .jpeg .jpg .png</div>
                                @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="d-flex flex-stack flex-wrap align-items-end">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-800 text-hover-primary fs-1 fw-bolder me-1">{{ $data->name }}</a>
                                    <a href="#" class="" data-bs-toggle="tooltip" data-bs-placement="right"
                                        title="Account is verified">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Text-->
                                <span class="fw-bold text-gray-600 fs-6 mb-2 d-block">{{ $data->address }}</span>
                                <!--end::Text-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap fw-semibold fs-7 pe-2">
                                    <a target="_blank" href="{{ $data->facebook }}"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary">
                                        <i class="fa-brands fa-facebook"></i>&nbsp; Facebook
                                    </a>
                                    <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
                                    <a target="_blank" href="{{ $data->twitter }}"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary">
                                        <i class="fa-brands fa-twitter"></i> &nbsp; Twitter
                                    </a>
                                    <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
                                    <a target="_blank" href="{{ $data->instagram }}"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary">
                                        <i class="fa-brands fa-instagram"></i> &nbsp; Instagram
                                    </a>
                                    <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
                                    <a target="_blank" href="{{ $data->tiktok }}"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary">
                                        <i class="fa-brands fa-tiktok"></i> &nbsp; TikTok
                                    </a>
                                    <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
                                    <a target="_blank" href="{{ $data->youtube }}"
                                        class="d-flex align-items-center text-gray-400 text-hover-primary">
                                        <i class="fa-brands fa-youtube"></i> &nbsp; Youtube
                                    </a>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex">
                                <a href="tel:{{ $data->phone }}" class="btn btn-sm btn-secondary me-3"
                                    id="kt_drawer_chat_toggle">
                                    <i class="fa-solid fa-phone"></i>&nbsp; Call
                                </a>
                                <a href="mailto:{{ $data->email }}" class="btn btn-sm btn-info me-3"
                                    id="kt_drawer_chat_toggle">
                                    <i class="fa-duotone fa-envelope"></i>&nbsp; Send Email
                                </a>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::Row-->
            <div wire:ignore class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Engage widget 1-->
                    <div class="card h-xl-100" dir="ltr">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column flex-center">
                            <!--begin::Heading-->
                            <div class="mb-2">
                                <!--begin::Title-->
                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">Upload Logo</span></h1>
                                <!--end::Title-->
                                <!--begin::Illustration-->
                                <div class="py-10 text-center">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}')">
                                        <!--begin::Preview existing avatar-->
                                        @if ($logoPrev)
                                        <div class="image-input-wrapper w-250px h-250px"
                                            style="background-image: url({{ asset('img/identitas/'.$logoPrev) }})">
                                        </div>
                                        @elseif($logo)
                                        <div class="image-input-wrapper w-250px h-250px"
                                            style="background-image: url({{ $logo->temporaryUrl() }})">
                                        </div>
                                        @endif
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow @error('logo')
                                                is-invalid @enderror" data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input wire:model="logo" type="file" name="avatar"
                                                accept=".png, .jpg, .jpeg" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->

                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Illustration-->
                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Lists Widget 19-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Heading-->
                        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                            style="background-image:url('{{ asset('assets/media/svg/shapes/top-green.png') }}')"
                            data-bs-theme="light">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column text-white pt-15">
                                <span class="fw-bold fs-2x mb-3">Sosial Media Website</span>
                                <div class="fs-4 text-white">
                                    <span class="position-relative d-inline-block">
                                        <!--begin::Separator-->
                                        <span
                                            class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                        <!--end::Separator-->
                                    </span>
                                </div>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="card-body mt-n20">
                            <!--begin::Stats-->
                            <div class="mt-n20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-3 g-lg-6">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-px me-5 mb-8">
                                                <i class="fa-brands fa-facebook"></i>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <input wire:model.defer="facebook" type="text" name="fname" class="form-control form-control-lg form-control mb-3 mb-lg-0 @error('instagram')
                                                is-invalid @enderror" placeholder="Facebook" />
                                                @error('facebook')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Masukan Link
                                                    Facebook</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-px me-5 mb-8">
                                                <i class="fa-brands fa-twitter"></i>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <input wire:model.defer="twitter" type="text" name="fname" class="form-control form-control-lg form-control mb-3 mb-lg-0 @error('instagram')
                                                is-invalid @enderror" placeholder="Twitter" />
                                                @error('instagram')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Masukan Link Twitter</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-px me-5 mb-8">
                                                <i class="fa-brands fa-instagram"></i>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <input wire:model.defer="instagram" type="text" name="fname" class="form-control form-control-lg form-control mb-3 mb-lg-0 @error('instagram')
                                                is-invalid @enderror" placeholder="Instagram" />
                                                @error('instagram')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Masukan Link
                                                    Instagram</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-px me-5 mb-8">
                                                <i class="fa-brands fa-tiktok"></i>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <input wire:model.defer="tiktok" type="text" name="fname" class="form-control form-control-lg form-control mb-3 mb-lg-0 @error('tiktok')
                                                    is-invalid @enderror" placeholder="TikTok" />
                                                @error('tiktok')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Masukan Link TikTok</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                     <!--begin::Col-->
                                     <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-px me-5 mb-8">
                                                <i class="fa-brands fa-youtube"></i>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Stats-->
                                            <div class="m-0">
                                                <!--begin::Number-->
                                                <input wire:model.defer="youtube" type="text" name="fname" class="form-control form-control-lg form-control mb-3 mb-lg-0 @error('youtube')
                                                    is-invalid @enderror" placeholder="Youtube" />
                                                @error('youtube')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <!--end::Number-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-6">Masukan Link Youtube</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Lists Widget 19-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12">
                    <!--begin::List widget 20-->
                    <div class="card h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Identitas Website</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-danger text-inverse-danger">N</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <span class="text-gray-800 text-hover-primary fs-6 fw-bold">Nama Website</span>
                                        <br>
                                        <input wire:model.defer="name" type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('name')
                                            is-invalid @enderror" placeholder="Masukan Nama Website" />
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end:Author-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <br>
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-danger">E</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <span class="text-gray-800 text-hover-primary fs-6 fw-bold">Alamat Email
                                            Kantor</span>
                                        <br>
                                        <input wire:model.defer="email" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('email')
                                            is-invalid @enderror" placeholder="Masukan Alamat Email" />
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end:Author-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <br>
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-info text-inverse-danger">T</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <span class="text-gray-800 text-hover-primary fs-6 fw-bold">Telephone
                                            Kantor</span>
                                        <br>
                                        <input wire:model.defer="phone" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('phone')
                                            is-invalid @enderror" placeholder="Masukan Telephone" />
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end:Author-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <br>
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-success text-inverse-danger">A</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <span class="text-gray-800 text-hover-primary fs-6 fw-bold">Alamat Kantor</span>
                                        <br>
                                        <input wire:model.defer="address" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('address')
                                            is-invalid @enderror" placeholder="Masukan Alamat Website" />
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end:Author-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <br>
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-dark text-inverse-danger">T</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <span class="text-gray-800 text-hover-primary fs-6 fw-bold">Tentang
                                            Website</span>
                                        <br>
                                        <textarea wire:model.defer="about" type="text" style="height: 100px;" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('about')
                                            is-invalid @enderror" placeholder="Masukan Alamat Website">
                                        </textarea>
                                        @error('about')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!--end:Author-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 20-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            {{-- Button Submit --}}
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Kembali</a>
                &nbsp;
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>
