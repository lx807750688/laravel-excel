# laravel-excel-
laravel Excel V3.1 导入导出方法说明
## 介绍
LaravelExcel 旨在成为 Laravel 风格的 PhpSpreadsheet：围绕 PhpSpreadsheet 的简单但优雅的包装，其目标是简化导出和导入。
## 说明
不适用于 laravel Excel 3.0 以下版本。
## 安装
composer require maatwebsite/excel

1. 添加 ServiceProvider config/app.php

'providers' => [
     /*
      * Package Service Providers...
      */
     Maatwebsite\Excel\ExcelServiceProvider::class,
];

2. 添加 Facade in config/app.php

'aliases' => [
    ...
    'Excel' => Maatwebsite\Excel\Facades\Excel::class,
];

3. 发布配置

php artisan vendor:publish

## 导出类用法
1. 创建导出类
```
namespace Excel;
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
```
2. 创建导出方法
```
use Excel\UsersExport; //引用导出类
use Maatwebsite\Excel\Facades\Excel;
public function Export(){

    $list = [
        'id'=>1,
        'name'=>'导出测试'
    ]; //execl 内容

    $headings = [
        '序号',
        '名称'
    ]; //execl 头部
    return Excel::download(new UsersExport($list, $headings), 'test.xlsx');
}
```
##5. 导入类用法
1. 创建导入类
```
namespace Excel;

use App\User; //user model 可以自行替换
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class UsersImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)  //循序 excel内容
        {
            User::create([
                'name' => $row[0],   //内容模拟插入 user model中
            ]);
        }
    }
}
``````
2. 创建导入方法
```
use Excel\UsersImport; //引用导入类
use Maatwebsite\Excel\Facades\Excel;

    public function Import(){
        return Excel::import(new UsersImport, request()->file('your_file')); //此方法自动调导入类 collection 方法, file后面接全路径
        return $array = Excel::toArray(new UsersImport, 'users.xlsx');  //此方法将excel内容转换为数组输出。
   } 
```   
[更多方法请查看官网地址]

## 具体使用方法请查看官网地址 https://laravel-excel.com/

          

