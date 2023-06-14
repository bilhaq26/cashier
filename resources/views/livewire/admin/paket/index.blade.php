<?php
use Carbon\Carbon;
?>
<div>
    {{-- Be like water. --}}
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Referred users-->
        <div class="card">
            <!--begin::Header-->
            <div class="card-header card-header-stretch">
                <!--begin::Title-->
                <div class="card-title">
                    <!--end::Menu 3-->
                    <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <i class="fa-solid fa-plus"></i> Tambah Paket
                    </a>
                </div>
                <!--end::Title-->
                <div class="card-title">
                    <!--begin::Menu-->
                    <button type="button"
                        class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3 "
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                        <span class="svg-icon svg-icon-3 svg-icon-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
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
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Cari Paket</div>
                            <input wire:model="search" type="text" class="form-control form-control-solid"
                                placeholder="Cari .." name="target_title" />
                        </div>
                        <!--end::Menu item-->
                        <br>
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Pilih Paginate</div>
                            <select wire:model="perPage" class="form-select" data-placeholder="Select an option">
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <!--end::Menu item-->
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Tab content-->
            <div id="kt_referred_users_tab_content" class="tab-content">
                <!--begin::Tab panel-->
                <div class="card-body p-0 tab-pane fade show active" role="tabpanel">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered align-middle gy-6">
                            <!--begin::Thead-->
                            <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-lighten">
                                <tr>
                                    <th class="w-10px ps-9">
                                        <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                            <input class="form-check-input " type="checkbox" wire:model="selectAll" />
                                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                style="background-color: transparent">
                                                <i class="bi bi-three-dots fs-3"></i>
                                            </button>
                                            <!--begin::Menu 3-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                data-kt-menu="true">
                                                <!--begin::Heading-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
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
                                            </div>
                                        </div>
                                    </th>
                                    <th class="min-w-125px ps-9">No</th>
                                    <th class="min-w-125px px-0">Nama</th>
                                    <th class="min-w-125px px-0">Keterangan</th>
                                    <th class="min-w-125px px-0">Harga</th>
                                    <th class="min-w-125px px-0">Tanggal</th>
                                    <th class="min-w-125px ps-0">Opsi</th>
                                </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fs-6 fw-semibold text-gray-600">
                                @forelse ($datas as $data)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-custom form-check-solid ms-15 me-4">
                                            <input class="form-check-input" type="checkbox" wire:model="selectedItems"
                                                value="{{ $data->id }}" />
                                        </div>
                                    </td>
                                    <td class="ps-9">{{ $loop->iteration }}</td>
                                    <td class="ps-0">
                                        <button class="accordion-button fs-4 fw-semibold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#kt_accordion_{{ $data->id }}"
                                            aria-expanded="true" aria-controls="kt_accordion_{{ $data->id }}">
                                            <span
                                                class="accordion-title fs-4 fw-bolder text-gray-700">{{ $data->nama_paket }}</span>
                                        </button>
                                        <div id="kt_accordion_{{ $data->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                            <div class="accordion-body">
                                                <div class="card h-md-100">
                                                    <!--begin::Body-->
                                                    <div class="card-body pt-2">
                                                        <!--begin::Tab Content-->
                                                        <div class="tab-content">
                                                            <!--begin::Tap pane-->
                                                            <div class="tab-pane fade show active"
                                                                id="kt_stats_widget_2_tab_1">
                                                                <!--begin::Table container-->
                                                                <div class="table-responsive">
                                                                    <!--begin::Table-->
                                                                    <table
                                                                        class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                                        <!--begin::Table head-->
                                                                        <thead>
                                                                            <tr
                                                                                class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                                                <th class="ps-0 w-50px">ITEM</th>
                                                                                <th class="min-w-125px"></th>
                                                                                <th class="text-end min-w-100px">QTY
                                                                                </th>
                                                                                <th class="pe-0 text-end min-w-100px">
                                                                                    PRICE</th>
                                                                                <th class="pe-0 text-end min-w-100px">
                                                                                    TOTAL PRICE</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <!--end::Table head-->
                                                                        <!--begin::Table body-->
                                                                        <tbody>
                                                                            @foreach ($data->detailPaket as $item)
                                                                            <tr>
                                                                                <td>
                                                                                    <img src="{{ asset('img/barang/'.$item->barang->image) }}"
                                                                                        class="w-50px ms-n1" alt="" />
                                                                                </td>
                                                                                <td class="ps-0">
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">
                                                                                        {{ $item->barang->nama_barang }} - {{ $item->barang->jumlah }}{{ $item->barang->satuan }}
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x{{ $item->qty }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">Rp.{{ number_format($item->barang->harga),2,',','.' }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">Rp.{{ number_format($item->qty * $item->barang->harga),2,',','.' }}</span>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <!--end::Table body-->
                                                                    </table>
                                                                    <!--end::Table-->
                                                                </div>
                                                                <!--end::Table container-->
                                                            </div>
                                                            <!--end::Tap pane-->
                                                        </div>
                                                        <!--end::Tab Content-->
                                                    </div>
                                                    <!--end: Card Body-->
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <span href=""
                                            class="text-gray-600 text-hover-primary">{{ $data->keterangan }}</span>
                                    </td>
                                    <td class="ps-0">
                                        <span href=""
                                            class="text-gray-600 text-hover-primary">Rp.{{ number_format($data->harga_paket),2,',','.' }}</span>
                                    </td>
                                    <td>{{ Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('dddd , Do MMMM YYYY') }}
                                    </td>
                                    <td>
                                        <button wire:click="destroy({{ $data->id }})" type="button"
                                            class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <button wire:click="edit({{ $data->id }})" type="button"
                                            class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <!--end::Tbody-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Tab panel-->
            </div>
            <!--end::Tab content-->
        </div>
        <!--end::Referred users-->
    </div>
    <!--end::Content container-->
    <div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header justify-content-end border-0 pb-0">
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
                <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                    <!--begin::Plans-->
                    <div class="d-flex flex-column">
                        <!--begin::Row-->
                        <form wire:submit.prevent="store()" id="kt_modal_new_target_form" class="form" action="#">
                            <div class="row mt-10">
                                <!--begin::Col-->
                                <div class="col-lg-6 mb-10 mb-lg-0">
                                    <!--begin::Tabs-->
                                    <div class="nav flex-column">
                                        <!--begin::Heading-->
                                        <div class="mb-13 text-center">
                                            <!--begin::Title-->
                                            <h1 class="mb-3">Tambah Jenis Barang</h1>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('nama_paket') text-danger @enderror">
                                                <span class="required">Nama Paket</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Masukan Nama Jenis Barang"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input wire:model.defer="nama_paket" type="text"
                                                class="form-control form-control-solid" />
                                            @error('nama_paket')
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
                                                    title="Masukan Nama Jenis Barang"></i>
                                            </label>
                                            <!--end::Label-->
                                            <textarea wire:model.defer="keterangan" type="text"
                                                class="form-control form-control-solid" />
                                            </textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('harga_paket') text-danger @enderror">
                                                <span class="required">Harga</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Masukan Nama Jenis Barang"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input wire:model.defer="harga_paket" type="text" id="rupiah"
                                                class="form-control form-control-solid" />
                                            @error('harga_paket')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <!--begin::Tab content-->
                                    <div class="tab-content rounded h-100 bg-light p-10">
                                        <!--begin::Tab Pane-->
                                        <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
                                            <!--begin::Heading-->
                                            <div class="pb-5">
                                                <h2 class="fw-bold text-dark">Pilih Barang Paket</h2>
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Body-->
                                            <div class="pt-1">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-7">
                                                    <div wire:ignore>
                                                        <select class="form-select form-select-solid" id="tanjong"
                                                            wire:model="id_barang" style="width:300px">
                                                            <option></option>
                                                            @foreach ($barangs as $barang)
                                                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }} - {{ $barang->jumlah }}{{ $barang->satuan }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <input type="number" wire:model.defer="qty"
                                                        style="background-color: #c3c0c0; color:black; width: 100px"
                                                        class="form-control form-control-solid" name="target_title" />
                                                    <!--end::Svg Icon-->
                                                    <a href="#" wire:click="addChart()" class="btn btn-danger">+</a>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-7">
                                                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                                <th class="ps-0 w-50px">No</th>
                                                                <th class="min-w-125px">Nama</th>
                                                                <th class="text-end min-w-100px">QTY</th>
                                                                <th class="text-end min-w-100px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @forelse ($this->items as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="ps-0">
                                                                    <span
                                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">
                                                                        {{ $item['nama_barang'] }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x{{ $item['qty'] }}</span>
                                                                </td>
                                                                <td>
                                                                    <a href="#"
                                                                        wire:click="removeChart({{ $key }})"
                                                                        class="btn btn-sm btn-light-danger">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">Data Kosong</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Tab Pane-->
                                    </div>
                                    <!--end::Tab content-->
                                </div>
                                <!--end::Col-->
                            </div>

                            <!--end::Row-->
                            <div class="d-flex flex-center flex-row-fluid pt-12">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Save</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--end::Plans-->
                    <!--begin::Actions-->
                    <!--end::Actions-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header justify-content-end border-0 pb-0">
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
                <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                    <!--begin::Plans-->
                    <div class="d-flex flex-column">
                        <!--begin::Row-->
                        <form wire:submit.prevent="update()" id="kt_modal_new_target_form" class="form" action="#">
                            <div class="row mt-10">
                                <!--begin::Col-->
                                <div class="col-lg-6 mb-10 mb-lg-0">
                                    <!--begin::Tabs-->
                                    <div class="nav flex-column">
                                        <!--begin::Heading-->
                                        <div class="mb-13 text-center">
                                            <!--begin::Title-->
                                            <h1 class="mb-3">Edit Jenis Barang</h1>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('nama_paket') text-danger @enderror">
                                                <span class="required">Nama Paket</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Masukan Nama Jenis Barang"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input wire:model.defer="nama_paket" type="text"
                                                class="form-control form-control-solid" />
                                            @error('nama_paket')
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
                                                    title="Masukan Nama Jenis Barang"></i>
                                            </label>
                                            <!--end::Label-->
                                            <textarea wire:model.defer="keterangan" type="text"
                                                class="form-control form-control-solid" />
                                            </textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('harga_paket') text-danger @enderror">
                                                <span class="required">Harga</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Masukan Nama Jenis Barang"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input wire:model.defer="harga_paket" type="text" id="rupiah"
                                                class="form-control form-control-solid" />
                                            @error('harga_paket')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <!--begin::Tab content-->
                                    <div class="tab-content rounded h-100 bg-light p-10">
                                        <!--begin::Tab Pane-->
                                        <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
                                            <!--begin::Heading-->
                                            <div class="pb-5">
                                                <h2 class="fw-bold text-dark">Pilih Barang Paket</h2>
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Body-->
                                            <div class="pt-1">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-7">
                                                    <div wire:ignore>
                                                        <select class="form-select form-select-solid" id="tanjong"
                                                            wire:model="id_barang" style="width:300px">
                                                            <option></option>
                                                            @foreach ($barangs as $barang)
                                                            <option value="{{ $barang->id }}">
                                                                {{ $barang->nama_barang }} - {{ $barang->jumlah }}{{ $barang->satuan }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <input type="number" wire:model.defer="qty"
                                                        style="background-color: #c3c0c0; color:black; width: 100px"
                                                        class="form-control form-control-solid" name="target_title" />
                                                    <!--end::Svg Icon-->
                                                    <a href="#" wire:click="addChart()" class="btn btn-danger">+</a>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-7">
                                                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                                <th class="ps-0 w-50px">No</th>
                                                                <th class="min-w-125px">Nama</th>
                                                                <th class="text-end min-w-100px">QTY</th>
                                                                <th class="text-end min-w-200px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            @forelse ($this->items as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="ps-0">
                                                                    <span
                                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">
                                                                        {{ $item['nama_barang'] }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x{{ $item['qty'] }}</span>
                                                                </td>
                                                                <td>
                                                                    <a href="#"
                                                                        wire:click="removeChart({{ $key }})"
                                                                        class="btn btn-sm btn-light-danger">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">Data Kosong</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Tab Pane-->
                                    </div>
                                    <!--end::Tab content-->
                                </div>
                                <!--end::Col-->
                            </div>

                            <!--end::Row-->
                            <div class="d-flex flex-center flex-row-fluid pt-12">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Save</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--end::Plans-->
                    <!--begin::Actions-->
                    <!--end::Actions-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


    @push('scripts')
    <script>
        var settings = {};
        new TomSelect('#tanjong', settings);

    </script>
    <script>
        $("#tanjong").on('change', function () {
            var filter = $(this).val();

            @this.set('id_barang', filter);
            console.log(filter);
        });

    </script>
    @endpush
</div>
