<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-xl-10">
            <!--begin::Col-->
            <div class="col-lg-12 col-xl-12 col-xxl-7 mb-5 mb-xl-0">
                <!--begin::Chart widget 3-->
                <div class="card h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                data-bs-target="#tambah">
                                <i class="fa-solid fa-plus"></i>Tambah Barang
                            </a>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade active show" id="kt_table_widget_20_tab_3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle gs-0 gy-3">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr>
                                                <th class="p-0 w-50px"></th>
                                                <th class="p-0 min-w-225px w-225px"></th>
                                                <th class="p-0 min-w-140px"></th>
                                                <th class="p-0 min-w-120px"></th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody>
                                            @foreach ($this->items as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="symbol symbol-50px me-2">
                                                        <span class="symbol-label">
                                                            <img src="{{ asset('img/barang/'.$item['image']) }}"
                                                                class="h-50 align-self-center" alt="" />
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fw-bolder fs-6">{{ $item['nama_barang'] }}</a>
                                                </td>
                                                <td class="text-end">
                                                    <span
                                                        class="text-gray-800 fw-bolder d-block fs-6">Rp.{{ number_format($item['harga'],2,',','.') }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <span
                                                        class="text-gray-800 fw-bolder d-block fs-6">{{ $item['qty'] }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <span
                                                        class="text-gray-800 fw-bolder d-block fs-6">Rp.{{ number_format($item['harga'] * $item['qty'],2,',','.') }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="#" wire:click.prevent="removeItemChart({{ $key }})"
                                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach
                                            <tr>
                                                <td class="text-end" colspan="4">
                                                    <span class="text-gray-400 fw-bold d-block">Total Qty</span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="text-gray-800 fw-bold d-block fs-6">
                                                        {{ $this->totalQty }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-end" colspan="4">
                                                    <span class="text-gray-400 fw-bold d-block">Total Harga</span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="text-gray-800 fw-bold d-block fs-6">
                                                        Rp.{{ number_format($this->total(),2,',','.') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 3-->
            </div>
            <!--end::Col-->
            <div class="col-lg-12 col-xl-12 col-xxl-5 mb-5 mb-xl-0">
                <!--begin::Chart widget 3-->
                <div class="card h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Transaction</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <form wire:submit.prevent="store()">
                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">No
                                        Transaksi</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="company" value="{{ $this->getNextNoTransaksi() }}"
                                            class="form-control form-control-lg form-control-solid @error('no_transaksi') is-invalid @enderror"
                                            placeholder="" disabled />
                                    </div>
                                    @error('no_transaksi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="company" wire:model.lazy="nama_pembeli"
                                            class="form-control form-control-lg form-control-solid @error('nama_pembeli') is-invalid @enderror"
                                            placeholder="" />
                                    </div>
                                    @error('nama_pembeli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal
                                        Transaksi</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="date" name="company" wire:model.lazy="tgl_transaksi"
                                            class="form-control form-control-lg form-control-solid @error('tgl_transaksi') is-invalid @enderror"
                                            placeholder="" />
                                    </div>
                                    @error('tgl_transaksi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                        Diskon
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">

                                        <select class="form-select @error('diskonId') is-invalid @enderror" name="diskon"
                                            id="diskon" data-placeholder="Select an option"
                                            wire:model.lazy="diskonId">
                                            <option></option>
                                            @foreach ($diskons as $dis)
                                            <option value="{{ $dis->id }}">{{ $dis->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('diskonId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                        Pilihan Paket
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select class="form-select @error('id_paket') is-invalid @enderror" name="diskon"
                                            id="diskon" data-placeholder="Select an option"
                                            wire:model.lazy="id_paket">
                                            <option> Pilih Paket </option>
                                             @foreach ($pakets as $paket)
                                             <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    @error('id_paket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Uang
                                        Pembeli</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" name="company"
                                            class="form-control form-control-lg form-control-solid @error('bayar') is-invalid @enderror"
                                            placeholder="" wire:model="bayar" />
                                    </div>
                                    @error('bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Tap pane-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Kembalian</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="company"
                                            value="Rp.{{ number_format($kembalian,2,',','.') }}"
                                            class="form-control form-control-lg form-control-solid @error('kembalian') is-invalid @enderror"
                                            placeholder="" disabled />
                                    </div>
                                    @error('kembalian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                {{-- button submit --}}
                                <div class="d-flex flex-center">
                                    <button type="submit" class="btn btn-lg btn-primary me-3">Submit</button>
                                    <a href="{{ route('transaksi') }}" type="reset" class="btn btn-lg btn-active-light-primary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 3-->
            </div>
        </div>
        <!--end::Row-->
    </div>

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
                    <form wire:submit.prevent="addToChart()" id="kt_modal_new_target_form" class="form" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Tambah Barang</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('barang_id') text-danger @enderror">
                                <span class="required">Tambah Barang</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukan Nama Jenis Barang"></i>
                            </label>
                            <!--end::Label-->
                            <select wire:model="barang_id" class="form-select" data-placeholder="Pilih Barang">
                                <option></option>
                                @foreach ($barangs as $barang)
                                @if ($barang->stok > 0)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}-{{ $barang->jumlah }}{{ $barang->satuan }} ||
                                    Rp.{{ number_format($barang->harga,2,',','.') }}</option>
                                @elseif ($barang->stok == 0)
                                <option value="{{ $barang->id }}" disabled>{{ $barang->nama_barang }} (Stok Habis)
                                </option>
                                @endif
                                @endforeach
                            </select>
                            @error('barang_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label
                                class="d-flex align-items-center fs-6 fw-semibold mb-2 @error('qty') text-danger @enderror">
                                <span class="required">Jumlah Barang</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukan Nama Jenis Barang"></i>
                            </label>
                            <!--end::Label-->
                            <input wire:model="qty" type="number" class="form-control form-control-solid"
                                placeholder="Masukan Jumlah Barang" />
                            @error('qty')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" data-bs-dismiss="modal"
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


</div>
