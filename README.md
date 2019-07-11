# laravel-excel-
laravel Excel V3.1 导入导出方法说明
1，介绍
LaravelExcel 旨在成为 Laravel 风格的 PhpSpreadsheet：围绕 PhpSpreadsheet 的简单但优雅的包装，其目标是简化导出和导入。
2，说明
不适用于 laravel Excel 3.0 以下版本。
3，安装
composer require maatwebsite/excel

//添加 ServiceProvider config/app.php
'providers' => [
     /*
      * Package Service Providers...
      */
     Maatwebsite\Excel\ExcelServiceProvider::class,
]

//添加 Facade in config/app.php
'aliases' => [
    ...
    'Excel' => Maatwebsite\Excel\Facades\Excel::class,
]

//发布配置
php artisan vendor:publish


          

