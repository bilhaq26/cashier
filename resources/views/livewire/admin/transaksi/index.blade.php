<?php
use Carbon\Carbon;
?>
<div>
    {{-- Do your work, then step back. --}}
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table Widget 4-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Tambah Transaksi
                            </a>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Actions-->
                        <div class="card-toolbar">
                            <!--begin::Filters-->
                            <div class="d-flex flex-stack flex-wrap gap-4">
                                <!--begin::Destination-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Label-->
                                    <div class="text-gray-400 fs-7 me-2">Paginate</div>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select wire:model="perPage"
                                        class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto"
                                        data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px"
                                        data-placeholder="Select an option">
                                        <option></option>
                                        <option value="0" selected="selected">Show All</option>
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Destination-->
                                <!--begin::Search-->
                                <div class="position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input wire:model="search" type="text" data-kt-table-widget-4="search"
                                        class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                </div>
                                <!--end::Search-->
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Filter Tanggal</span>
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
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Tanggal Awal
                                        </div>
                                        <input wire:model="from" type="date" class="form-control form-control-solid"
                                            placeholder="Cari .." name="target_title" />
                                    </div>
                                    <!--end::Menu item-->
                                    <br>
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Tanggal Akhir
                                        </div>
                                        <input wire:model="to" type="date" class="form-control form-control-solid"
                                            placeholder="Cari .." name="target_title" />
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                            </div>
                            <!--begin::Filters-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Paket</th>
                                    <th>Total Belanja</th>
                                    <th>Diskon</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th class="text-end"></th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                @forelse ($datas as $data)
                                <tr>
                                    <td>
                                        <button class="accordion-button fs-4 fw-semibold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#kt_accordion_{{ $data->id }}"
                                            aria-expanded="true" aria-controls="kt_accordion_{{ $data->id }}">
                                            <span
                                                class="accordion-title fs-4 fw-bolder text-gray-700">{{ $data->no_transaksi }}</span>
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
                                                                            @foreach ($data->detailTransaksi as $item)
                                                                            <tr>
                                                                                <td>
                                                                                    <img src="{{ asset('img/barang/'.$item->barang->image) }}"
                                                                                        class="w-50px ms-n1" alt="" />
                                                                                </td>
                                                                                <td class="ps-0">
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">
                                                                                        {{ $item->barang->nama_barang }}
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x{{ $item->qty }}</span>
                                                                                </td>
                                                                                <td class="text-end pe-0">
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold d-block fs-6">
                                                                                        Rp.{{ number_format($item->harga),2,',','.' }}</span>
                                                                                </td>
                                                                                <td class="text-end pe-0">
                                                                                    <span
                                                                                        class="text-gray-800 fw-bold d-block fs-6">
                                                                                        Rp.{{ number_format($item->harga*$item->qty),2,',','.' }}</span>
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
                                    </td>
                                    <td>
                                        <span class="text-gray-600 text-hover-primary">{{ $data->nama_pembeli }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-600 text-hover-primary">{{ $data->paket->nama_paket }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="text-gray-800 fw-bolder">Rp.{{ number_format($data->total_harga),2,',','.' }}</span>
                                    </td>
                                    <td>
                                        Rp.{{ number_format($data->diskon),2,',','.' ?? '0' }}
                                    </td>
                                    <td>
                                        @if ($data->status == 'Dipinjam')
                                        <button wire:click="changeStatus({{ $data->id }})"
                                            class="btn btn-sm btn-light-danger">Dipinjam</button>
                                        @elseif($data->status == 'Dikembalikan')
                                        <span class="btn btn-sm btn-light-success">Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ Carbon::parse($data->tgl_transaksi)->locale('id_ID')->isoFormat('dddd , Do MMMM YYYY') }}
                                    </td>
                                    <td class="text-end">
                                        {{-- button delete --}}
                                        <button wire:click="destroy({{ $data->id }})"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9 10V19C9 19.5523 9.44772 20 10 20H14C14.5523 20 15 19.5523 15 19V10H9Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.3"
                                                        d="M3 8H21V7C21 5.34315 19.6569 4 18 4H6C4.34315 4 3 5.34315 3 7V8Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8 8V7C8 5.89543 8.89543 5 10 5H14C15.1046 5 16 5.89543 16 7V8H8Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.3"
                                                        d="M16 10V19C16 19.5523 15.5523 20 15 20H9C8.44772 20 8 19.5523 8 19V10H16Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Table Widget 4-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
</div>
