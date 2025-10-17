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
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StokOpnameExport implements FromCollection, WithStyles, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize, WithCustomStartCell, WithStrictNullComparison
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
                'I' => NumberFormat::FORMAT_DATE_DATETIME,
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
                $dataStok->keterangan,
                date_format(date_create($dataStok->created_at), 'd M Y H:i:s')
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
                $dataStok->keterangan,
                date_format(date_create($dataStok->created_at), 'd M Y H:i:s')
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
                'Keterangan',
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
                'Keterangan',
                'Waktu Stok'
            ];
        }

    }
}
