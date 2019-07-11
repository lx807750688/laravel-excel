<?php

namespace App\Http\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    private $data;
    private $headings;

    //数据注入
    public function __construct($data, $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    //实现FromCollection接口
    public function collection()
    {
        return collect($this->data);
    }

    //实现WithHeadings接口
    public function headings(): array
    {
        return $this->headings;
    }

}
