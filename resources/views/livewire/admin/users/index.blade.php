<?php
use Carbon\Carbon;
?>
<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Table widget 12-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <input wire:model="search" type="text" name="fname"
                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                placeholder="Cari nama ..." />
                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_select_users">
                                <i class="fa-solid fa-plus"></i> Tambah User</a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                        <th class="p-0 pb-3 min-w-120px text-start">
                                            <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                                <input class="form-check-input " type="checkbox"
                                                    wire:model="selectAll" />
                                                <button
                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                    style="background-color: transparent">
                                                    <i class="bi bi-three-dots fs-3"></i>
                                                </button>
                                                <!--begin::Menu 3-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                    data-kt-menu="true">
                                                    <!--begin::Heading-->
                                                    <div class="menu-item px-3">
                                                        <div
                                                            class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                            Action
                                                        </div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" wire:click="destroySelect()" class="menu-link px-3">
                                                            <i class="fa-solid fa-trash"></i>&nbsp; Delete
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" wire:click="status()" class="menu-link px-3">
                                                            <i class="fa-solid fa-rotate"></i>&nbsp; Change Status
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                            </div>
                                        </th>
                                        <th class="p-0 pb-3 min-w-175px text-start">Nama</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">Username</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">Email</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">Opsi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @forelse ($datas as $data)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                                <input class="form-check-input" type="checkbox"
                                                    wire:model="selectedItems" value="{{ $data->id }}" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="{{ asset('img/user/'.$data->photo) }}" class="" alt="" />
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                                    <a href="{{ route('users.detail',$data->id) }}"
                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $data->name }}</a>
                                                    @else
                                                    <span
                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $data->name }}</span>
                                                    @endif
                                                    @if ($data->role_id == 1)
                                                    <span
                                                        class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{ $data->Role->name }}</span>
                                                    @elseif ($data->role_id == 2)
                                                    <span
                                                        class="badge badge-light-primary fw-bolder fs-8 px-2 py-1 ms-2">{{ $data->Role->name }}</span>
                                                    @elseif ($data->role_id == 3)
                                                    <span
                                                        class="badge badge-light-danger fw-bolder fs-8 px-2 py-1 ms-2">{{ $data->Role->name }}</span>
                                                    @elseif ($data->role_id == 4)
                                                    <span
                                                        class="badge badge-light-warning fw-bolder fs-8 px-2 py-1 ms-2">{{ $data->Role->name }}</span>
                                                    @endif
                                                    <span
                                                        class="badge badge-light fw-bolder fs-8 px-2 py-1 ms-2">{{ Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('Do MMMM YYYY') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span
                                                class="text-gray-600 fw-bold fs-6 text-center">{{ $data->username }}</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">{{ $data->email }}</span>
                                        </td>
                                        <td class="pe-0">
                                            <div class="d-flex align-items-center justify-content-end">
                                                {{-- button delete --}}
                                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                                <button wire:click="changeStatus({{ $data->id }})"
                                                    class="btn btn-sm btn-{{ $data->status == 'Active' ? 'success' : 'info' }} er fs-6 px-8 py-4">
                                                    <i
                                                        class="fa-sharp fa-solid fa-circle-{{ $data->status == 'Active' ? 'check' : 'xmark' }}"></i>
                                                    {{ $data->status == 'Active' ? ' Active' : ' Non-Active' }}
                                                </button>
                                                &nbsp;
                                                <button wire:click="destroy({{ $data->id }})"
                                                    class="btn btn-danger er fs-6 px-8 py-4">
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                                </button>
                                                &nbsp;
                                                <button wire:click="impersonate({{ $data->id }})"
                                                    class="btn btn-primary er fs-6 px-8 py-4">
                                                    <i class="fa-solid fa-right-to-bracket"></i>Login Sebagai ..
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <span class="text-gray-600 fw-bold fs-6">Data Kosong</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end::Table widget 12-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>

    {{-- Modal Tambah User --}}
    <div wire:ignore.self class="modal fade" id="kt_modal_select_users" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-700px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 d-flex justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-10 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="d-flex justify-content-center align-items-center mb-3">Tambah Pengguna</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Tambah pengguna sesuai dengan kebutuhan.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->
                    <div class="mh-475px scroll-y me-n7 pe-7">
                        <form action="" wire:submit.prevent="store()">
                            <div class="mb-0 text-center">
                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    @if ($photo)
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url({{ $photo->temporaryUrl() }})"></div>
                                    @endif
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input wire:model="photo" type="file" name="avatar"
                                            accept=".png, .jpg, .jpeg" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                </div>
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Format Gambar : .jpg .jpeg .png</div>
                            </div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label">Nama Lengkap</label>
                                <input wire:model="name" type="text" class="form-control @error('name')
                                    is-invalid @enderror" id="kt_docs_maxlength_basic" maxlength="30" />
                                <span class="fs-6 text-muted">Masukan nama lengkap dengan benar</span>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label">Username</label>
                                <input wire:model="username" type="text" class="form-control @error('username')
                                    is-invalid @enderror" id="kt_docs_maxlength_basic" maxlength="10" />
                                <span class="fs-6 text-muted">Masukan Username yg akan digunakan saat login</span>
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label">Email</label>
                                <input wire:model="email" type="text" class="form-control @error('email')
                                    is-invalid @enderror" id="kt_docs_maxlength_basic" maxlength="30" />
                                <span class="fs-6 text-muted">Masukan Email dengan benar dengan menggunakan tanda
                                    "@"</span>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label">Pilih Role</label>
                                <select wire:model="role_id" class="form-control">
                                    <option>Pilih</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label">Password</label>
                                <input wire:model="password" type="password" class="form-control @error('password')
                                    is-invalid @enderror" id="kt_docs_maxlength_basic" maxlength="10" />
                                <span class="fs-6 text-muted">Masukan Password yang mudah di ingat</span>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-0">
                                <label class="form-label">Confirm Password</label>
                                <input wire:model="confirm_password" type="password" class="form-control @error('confirm_password')
                                    is-invalid @enderror" id="kt_docs_maxlength_basic" maxlength="10" />
                                <span class="fs-6 text-muted">Konfirmasi Password </span>
                                @error('confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-15">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Users-->
                </div>
                <!--end::Modal Body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
</div>
