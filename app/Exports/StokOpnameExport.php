<?php

namespace App\Exports;

use App\Models\Stok;
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
use Illuminate\Support\Str;

class StokOpnameExport implements FromCollection, WithStyles, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize, WithCustomStartCell
{
    protected $kodeStok;
    protected $status;
    protected $pic;

    function __construct($kodeStok) {
           $this->kodeStok = $kodeStok;
           $stokData = Stok::join('user', 'stok_opname.id_pengguna', '=', 'user.id_pengguna')
                        ->where('stok_opname.kode_stok', $this->kodeStok)
                        ->select('stok_opname.*', 'user.nama_pengguna')->limit(1)->get();
           $this->status = $stokData[0]->status;
           $this->pic = $stokData[0]->nama_pengguna;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stok::join('barang', 'stok_opname.kode_barang', '=', 'barang.kode_barang')
                        ->join('user', 'stok_opname.id_pengguna', '=', 'user.id_pengguna')
                        ->where('stok_opname.kode_stok', $this->kodeStok)
                        ->select('stok_opname.*','barang.nama_barang', 'user.nama_pengguna')->get();
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle(6)->getFont()->setBold(true);
        $sheet->getStyle('A1:A4')->getFont()->setBold(true);
        $sheet->setCellValue('A2', 'Kode Stok Opname');
        $sheet->setCellValue('B2', $this->kodeStok);
        $sheet->setCellValue('A3', 'PIC');
        $sheet->setCellValue('B3', Str::title($this->pic));
        $sheet->setCellValue('A4', 'Status');
        $sheet->setCellValue('B4', $this->status);
    }

    public function columnFormats(): array
    {
        if($this->status=='PROSES'){
            return [
                'G' => NumberFormat::FORMAT_DATE_DATETIME,
               ];
        }else{
            return [
                'H' => NumberFormat::FORMAT_DATE_DATETIME,
               ];
        }

    }

    public function map($dataStok): array
    {
        if($this->status=='PROSES'){
            return [
                $dataStok->kode_stok,
                $dataStok->kode_barang,
                $dataStok->nama_barang,
                $dataStok->kode_rak,
                $dataStok->jml_aktual,
                Date::dateTimeToExcel(date_create($dataStok->waktu_stok))
            ];
        }else{
            return [
                $dataStok->kode_stok,
                $dataStok->kode_barang,
                $dataStok->nama_barang,
                $dataStok->kode_rak,
                $dataStok->jml_sistem,
                $dataStok->jml_aktual,
                $dataStok->selisih,
                Date::dateTimeToExcel(date_create($dataStok->waktu_stok))

            ];
        }
    }

    public function startCell(): string
    {
        return 'A6';
    }

    public function headings(): array
    {
        if($this->status=='PROSES'){
            return [
                'Kode Stok',
                'Kode Barang',
                'Nama Barang',
                'Kode Rak',
                'Jumlah Aktual',
                'Waktu Stok'
            ];
        }else{
            return [
                'Kode Stok',
                'Kode Barang',
                'Nama Barang',
                'Kode Rak',
                'Jumlah',
                'Jumlah Aktual',
                'Selisih',
                'Waktu Stok'
            ];
        }

    }
}
