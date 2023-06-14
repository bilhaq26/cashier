<?php
use Carbon\Carbon;
?>
<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-xl-10">
            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <!--begin::Card widget 16-->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #080655">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalTransaksi }}</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-50 pt-1 fw-semibold fs-6">Total Transaksi</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card widget 16-->
                <!--begin::Card widget 7-->
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $jumlahBarang }}</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Jumlah Barang</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card widget 7-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                <!--begin::Card widget 17-->
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <!--begin::Currency-->
                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Rp.</span>
                                <!--end::Currency-->
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ number_format($totalPendapatan),2,',','.' }}</span>
                                <!--end::Amount-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Subtitle-->
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Pendapatan</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card widget 17-->
                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $totalStok }}</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Semua Stok Barang</span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card widget 7-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                <!--begin::Timeline widget 3-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Activity Log</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-5">
                        <!--begin::Item-->
                        @forelse ($activity as $item)
                        <div class="d-flex flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center me-3">
                                <!--begin::Logo-->
                                <img src="{{ asset('img/user/'.$item->causer->photo) }}" class="me-4 w-30px" alt="" />
                                <!--end::Logo-->
                                <!--begin::Section-->
                                <div class="flex-grow-1">
                                    <!--begin::Text-->
                                    <span
                                        class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">{{ $item->causer->username }}</span>
                                    <!--end::Text-->
                                    <!--begin::Description-->
                                    <span class="text-gray-400 fw-semibold d-block fs-6">{{ $item->description }}</span>
                                    <!--end::Description=-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                        @empty
                        @endforelse
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Timeline widget-3-->
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-6">
                <!--begin::List Widget 33-->
                <div class="card card-flush h-md-100">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Chart Pengunjung</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-7 pb-5">
                        <canvas id="chart" height="130"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 33-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xxl-6">
                <!--begin::List Widget 33-->
                <div class="card card-flush h-md-100">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Chart Transaksi</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-7 pb-5">
                        <canvas id="chartTransaksi" height="130"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 33-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Table Widget 20-->
                <div class="card h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Stok Barang Kurang Dari 10</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade active show">
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
                                            @forelse ($stokBarangs as $item)
                                            <tr>
                                                <td>
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-70px symbol-2by3">
                                                        <div class="symbol-label"
                                                            style="background-image: url({{ asset('img/barang/'.$item->image) }})">
                                                        </div>
                                                    </div>
                                                    <!--end::Symbol-->
                                                </td>
                                                <td class="pe-5">
                                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $item->nama_barang }}
                                                    </span>
                                                    <span class="text-gray-400 fw-semibold d-block">
                                                        {{ $item->jenis->nama_jenis }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="text-gray-400 fw-semibold d-block">Harga</span>
                                                    <span
                                                        class="text-gray-800 fw-bold d-block fs-5">Rp.{{ number_format($item->harga),2,',','.' }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="text-gray-400 fw-semibold d-block">Stok</span>
                                                    <span class="text-gray-800 fw-bold d-block fs-6">{{ $item->stok }}
                                                        Pcs</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('barang') }}" class="text-hover-primary">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-400">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                    rx="5" fill="currentColor" />
                                                                <path
                                                                    d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <span class="text-gray-400 fw-semibold d-block fs-7">
                                                        Stok Barang Dibawah 10 Belum Ada
                                                    </span>
                                                </td>
                                            </tr>

                                            @endforelse
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
                <!--end::Table Widget 20-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: @json($chartData),
            });
        });

    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('chartTransaksi').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: @json($chartTransaksi),
            });
        });
    </script>
    @endpush
</div>
