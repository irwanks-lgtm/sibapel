<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class PenjualanExport implements FromCollection, WithStyles, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::where('transaksi.jenis_transaksi', 'POS')
        ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
        ->groupBy('transaksi.kode_barang')
        ->selectRaw('transaksi.*, barang.nama_barang, barang.satuan, sum(transaksi.qty) as total_brg, sum(transaksi.harga) as total_harga')
        ->orderBy('tgl_transaksi', 'asc')->get();
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }
    
    public function columnFormats(): array
    {
        return [
            'E' => 'Rp #,##0_-',
            'F' => NumberFormat::FORMAT_DATE_DATETIME,
           ];
    }

    public function map($dataPenjualan): array
    {
        
        return [
            
            $dataPenjualan->kode_barang,
            $dataPenjualan->nama_barang,
            $dataPenjualan->total_brg,
            $dataPenjualan->satuan,
            $dataPenjualan->total_harga,
            Date::dateTimeToExcel(date_create($dataPenjualan->tgl_transaksi)),
            $dataPenjualan->keterangan,
            
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Satuan',
            'Harga',
            'Tgl Transaksi',
            'Keterangan'
        ];
    }
}
