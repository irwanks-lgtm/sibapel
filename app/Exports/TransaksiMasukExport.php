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


class TransaksiMasukExport implements FromCollection, WithStyles, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::where('jenis_transaksi', 'MASUK')
        ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
        ->select('transaksi.*', 'barang.nama_barang')->get();
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

    public function map($dataMasuk): array
    {
        
        return [
            $dataMasuk->kode_transaksi,
            $dataMasuk->kode_barang,
            $dataMasuk->nama_barang,
            $dataMasuk->qty,
            $dataMasuk->harga,
            Date::dateTimeToExcel(date_create($dataMasuk->tgl_transaksi))
            
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
            'Tgl Transaksi'
        ];
    }
}
