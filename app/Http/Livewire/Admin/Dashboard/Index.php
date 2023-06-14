<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Web\Visitor;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{
    public $chartData, $chartTransaksi;

    public function render()
    {
        // Chart Pengunjung
        $visitor = Visitor::latest()->take(10)->get();
        foreach($visitor as $item){
           $data['labels'][] = $item['created_at']->format('d M Y');
           $data['data'][] = $item['count'];
        }
        $this->chartData = [
            'labels' => $data['labels'] ?? [],
            'datasets' => [
                [
                    'label' => 'Data Pengunjung',
                    'data' => $data['data'] ?? [],
                    'backgroundColor' => '#57C5B6',
                ],
            ],
        ];

        // Log Activity
        $activity = Activity::latest()->take(6)->get();

        // Jumlah Barang stok dibawah 10
        $stokBarangs = Barang::where('stok', '<', 10)->take(5)->get();

        // chart transaksi
        $transaksi = Transaksi::groupBy('tgl_transaksi')->selectRaw('tgl_transaksi, count(*) as total')->get();
        foreach($transaksi as $items){
            // label format
            $dataTransaksi['labels'][] = Carbon::parse($items['tgl_transaksi'])->isoFormat('dddd , D MMM Y');
            $dataTransaksi['data'][] = $items['total'];
        }
        $this->chartTransaksi = [
            'labels' => $dataTransaksi['labels'] ?? [],
            'datasets' => [
                [
                    'label' => 'Data Transaksi',
                    'fill' => false,
                    'data' => $dataTransaksi['data'] ?? [],
                    'backgroundColor' => '#57C5B6',
                ]
            ],
        ];

        // Total Transaksi dan Pendapatan
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total_harga');

        $jumlahBarang = Barang::count();
        $totalStok = Barang::sum('stok');
        return view('livewire.admin.dashboard.index',[
            'visitor' => $visitor,
            'activity' => $activity,
            'stokBarangs' => $stokBarangs,
            'transaksi' => $transaksi,
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'jumlahBarang' => $jumlahBarang,
            'totalStok' => $totalStok,
        ])->layout('admin.layout')->layoutData(['title' => 'Dashboard']);
    }
}
