<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMappedCells;


class BarangExport implements FromCollection, WithStyles, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize, WithCustomStartCell, WithMappedCells
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Barang::leftJoin('suplier', 'barang.id_suplier', '=', 'suplier.id_suplier')
        ->select('barang.*', 'suplier.nama_suplier')->get();
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(5)->getFont()->setBold(true);
    }

    public function columnFormats(): array
    {
        return [
            'G' => 'Rp #,##0_-',
            'H' => 'Rp #,##0_-',
            'L' => NumberFormat::FORMAT_DATE_DATETIME,
           ];
    }

    public function map($dataBarang): array
    {

        return [
            $dataBarang->kode_barang,
            $dataBarang->id_suplier . ' - ' . $dataBarang->nama_suplier,
            $dataBarang->barcode,
            $dataBarang->nama_barang,
            $dataBarang->satuan,
            $dataBarang->jml_brg,
            $dataBarang->harga_beli,
            $dataBarang->harga_jual,
            $dataBarang->jenis_barang,
            $dataBarang->kode_rak,
            $dataBarang->jml_min,
            Date::dateTimeToExcel(date_create($dataBarang->tgl_masuk))

        ];
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Suplier',
            'Barcode',
            'Nama Barang',
            'Satuan',
            'Jumlah',
            'Harga Beli',
            'Harga Jual',
            'Jenis Barang',
            'Kode Rak',
            'Jumlah Min',
            'Tgl Masuk'
        ];
    }
}
