<?php
use Carbon\Carbon;
?>
<div>
    {{-- The best athlete wants his opponent at his best. --}}
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
                            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                data-bs-target="#tambah">
                                <i class="fa-solid fa-plus"></i> Tambah Barang
                            </a>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Filter</span>
                            <!--begin::Menu-->
                            <button type="button"
                                class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3 "
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-3 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor"
                                                opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor"
                                                opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor"
                                                opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>

                            <!--begin::Menu 3-->
                            <div wire:ignore.self
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Cari Jenis Barang
                                    </div>
                                    <input wire:model="search" type="text" class="form-control form-control-solid"
                                        placeholder="Cari .." name="target_title" />
                                </div>
                                <!--end::Menu item-->
                                <br>
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Pilih Paginate
                                    </div>
                                    <select wire:model="perPage" class="form-select"
                                        data-placeholder="Select an option">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <!--end::Menu item-->
                            </div>
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
                                        <th>No</th>
                                        <th class="p-0 pb-3 min-w-125px text-start">Nama Barang</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">Jenis Barang</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">Harga</th>
                                        <th class="p-0 pb-3 min-w-100px text-center">Stok</th>
                                        <th class="p-0 pb-3 w-80px text-end">Berat/Pcs</th>
                                        <th class="p-0 pb-3 min-w-80px text-end">Updated</th>
                                        <th class="p-0 pb-3 w-80px text-end"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @forelse ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($data->image != null)
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="{{ asset('img/barang/'.$data->image) }}" class=""
                                                        alt="" />
                                                </div>
                                                @else
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="{{ asset('img/barang/default.jpg') }}" class=""
                                                        alt="" />
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $data->nama_barang }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">
                                                {{ $data->jenis->nama_jenis ?? '' }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">
                                                Rp. {{ number_format($data->harga, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">
                                                {{ $data->stok }}
                                            </span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">
                                                {{ $data->jumlah }}{{ $data->satuan }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">
                                                {{ Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('dddd , Do MMMM YYYY') }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-0">
                                            {{-- button edit --}}
                                            <button wire:click="edit({{ $data->id }})"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#edit">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="bi bi-pencil-square"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            {{-- button delete --}}
                                            <button wire:click="destroy({{ $data->id }})"
                                                class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="bi bi-trash"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10">Data tidak ditemukan</td>
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

    <!--Modal Tambah-->
    <div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form wire:submit.prevent="store()" id="kt_modal_new_target_form" class="form" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Tambah Barang</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <div class="image-input image-input-outline" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                @if ($image)
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ $image->temporaryUrl() }})"></div>

                                {{-- hapus image --}}
                                <div class="d-flex justify-content-center mt-2">
                                    <button wire:click.prevent="removeImage()"
                                        class="btn btn-sm btn-light-danger btn-icon me-2">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                @endif
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input wire:model.defer="image" type="file" name="avatar"
                                        accept=".png, .jpg, .jpeg" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                            </div>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Format Gambar : .jpg .jpeg .png</div>
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('nama_barang') text-danger @enderror">
                                <span class="required">Nama</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukan Nama Jenis Barang"></i>
                            </label>
                            <!--end::Label-->
                            <input wire:model.defer="nama_barang" type="text" class="form-control form-control-solid"
                                name="target_title" />
                            @error('nama_barang')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('id_jenis') text-danger @enderror">
                                <span class="required">Pilih Jenis Barang</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Pilih Jenis Barang"></i>
                            </label>
                            <!--end::Label-->
                            <div class="overflow-hidden flex-grow-1">
                                <select wire:model.defer="id_jenis"
                                    class="form-select form-select-solid border-start border-end">
                                    <option></option>
                                    @forelse ($jBarang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_jenis }}</option>
                                    @empty
                                    <option value="">Tidak Ada Jenis Barang</option>
                                    @endforelse
                                </select>
                            </div>
                            @error('id_jenis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('keterangan') text-danger @enderror">
                                <span class="required">Keterangan</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukan Keterangan"></i>
                            </label>
                            <!--end::Label-->
                            <textarea wire:model.defer="keterangan" type="text" class="form-control form-control-solid"
                                name="target_title" />
                            </textarea>
                            @error('keterangan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Harga</label>
                                <input wire:model.defer="harga" id="rupiah" type="text"
                                    class="form-control form-control-solid" name="target_title" />
                                @error('harga')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Stok</label>
                                <input wire:model.defer="stok" type="number" class="form-control form-control-solid"
                                    name="target_title" />
                                @error('stok')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Jumlah Berat</label>
                                <input wire:model.defer="jumlah" type="number" class="form-control form-control-solid"
                                    name="target_title" />
                                @error('jumlah')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Satuan</label>
                                <!--begin::Input-->
                                <div class="overflow-hidden flex-grow-1">
                                    <select wire:model.defer="satuan"
                                        class="form-select form-select-solid border-start border-end">
                                        <option></option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="kg">Kg</option>
                                        <option value="gr">Gram</option>
                                        <option value="ml">ML</option>
                                    </select>
                                </div>
                                @error('satuan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" data-bs-dismiss="modal"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span wire:loading class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--End Modal Tambah -->

    <!--Modal Edit-->
    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form wire:submit.prevent="update()" id="kt_modal_new_target_form" class="form" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Edit Barang</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                         <!--end::Heading-->
                         <div class="d-flex flex-column mb-8 fv-row">
                            <div class="image-input image-input-outline" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                @if ($image)
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ $image->temporaryUrl() }})"></div>

                                {{-- hapus image --}}
                                <div class="d-flex justify-content-center mt-2">
                                    <button wire:click.prevent="removeImage()"
                                        class="btn btn-sm btn-light-danger btn-icon me-2">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                @endif
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input wire:model.defer="image" type="file" name="avatar"
                                        accept=".png, .jpg, .jpeg" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                            </div>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Format Gambar : .jpg .jpeg .png</div>
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('nama_barang') text-danger @enderror">
                                <span class="required">Nama</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukan Nama Jenis Barang"></i>
                            </label>
                            <!--end::Label-->
                            <input wire:model.defer="nama_barang" type="text" class="form-control form-control-solid"
                                name="target_title" />
                            @error('nama_barang')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('id_jenis') text-danger @enderror">
                                <span class="required">Pilih Jenis Barang</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Pilih Jenis Barang"></i>
                            </label>
                            <!--end::Label-->
                            <div class="overflow-hidden flex-grow-1">
                                <select wire:model.defer="id_jenis"
                                    class="form-select form-select-solid border-start border-end">
                                    <option></option>
                                    @forelse ($jBarang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_jenis }}</option>
                                    @empty
                                    <option value="">Tidak Ada Jenis Barang</option>
                                    @endforelse
                                </select>
                            </div>
                            @error('id_jenis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('keterangan') text-danger @enderror">
                                <span class="required">Keterangan</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukan Keterangan"></i>
                            </label>
                            <!--end::Label-->
                            <textarea wire:model.defer="keterangan" type="text" class="form-control form-control-solid"
                                name="target_title" />
                            </textarea>
                            @error('keterangan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Harga</label>
                                <input wire:model.defer="harga" id="rupiah" type="text"
                                    class="form-control form-control-solid" name="target_title" />
                                @error('harga')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Stok</label>
                                <input wire:model.defer="stok" type="number" class="form-control form-control-solid"
                                    name="target_title" />
                                @error('stok')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Jumlah Berat</label>
                                <input wire:model.defer="jumlah" type="number" class="form-control form-control-solid"
                                    name="target_title" />
                                @error('jumlah')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Satuan</label>
                                <!--begin::Input-->
                                <div class="overflow-hidden flex-grow-1">
                                    <select wire:model.defer="satuan"
                                        class="form-select form-select-solid border-start border-end">
                                        <option></option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="kg">Kg</option>
                                        <option value="gr">Gram</option>
                                        <option value="ml">ML</option>
                                    </select>
                                </div>
                                @error('satuan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" data-bs-dismiss="modal"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span wire:loading class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--End Modal Tambah -->
    <script>
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function (e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

    </script>
</div>
