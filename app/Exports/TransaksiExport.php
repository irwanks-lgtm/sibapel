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


class TransaksiExport implements FromCollection, WithStyles, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
        ->select('transaksi.*', 'barang.nama_barang')->orderBy('tgl_transaksi', 'asc')->get();
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
    }
    
    public function columnFormats(): array
    {
        return [
            'E' => 'Rp #,##0_-',
            'G' => NumberFormat::FORMAT_DATE_DATETIME,
           ];
    }

    public function map($dataTrx): array
    {
        
        return [
            $dataTrx->kode_transaksi,
            $dataTrx->kode_barang,
            $dataTrx->nama_barang,
            $dataTrx->qty,
            $dataTrx->harga,
            $dataTrx->jenis_transaksi,
            Date::dateTimeToExcel(date_create($dataTrx->tgl_transaksi)),
            $dataTrx->keterangan,
            
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Harga',
            'Jenis Transaksi',
            'Tgl Transaksi',
            'Keterangan'
        ];
    }
}
