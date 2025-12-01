<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\StockCategory;
use App\Models\StockRecord;
use App\Models\StockSubCategory;
use App\Models\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $u = Admin::user();
        $pharmacy = Pharmacy::find($u->pharmacy_id);

        return $content
            ->title($pharmacy->name . ' - Dashboard')
            ->description('Hello...' . $u->name)
            // ->row(Dashboard::title())
            ->row(function (Row $row) {


                $row->column(4, function (Column $column) {
                    $cat = StockCategory::where(
                        'pharmacy_id',
                        Admin::user()->pharmacy_id
                    )->get();
                    foreach ($cat as $mainCat) {
                        $box = new Box($mainCat->name, '<h3 style="text-align:right; margin: 0; font-size: 40px; font-weight: 800" >'
                            .
                            '</h3>');

                        $box->style('info')
                            ->solid();
                        $column->append($box);
                    }
                });

                $row->column(4, function (Column $column) {
                    $qty = StockSubCategory::where(
                        'pharmacy_id',
                        Admin::user()->pharmacy_id
                    )->get();
                    foreach ($qty as $avail) {
                        $box = new Box($avail->name, '<h3 style="text-align:right; margin: 0; font-size: 40px; font-weight: 800" >'
                            .  number_format($avail->current_quantity)  .
                            '</h3>');

                        $box->style('info')
                            ->solid();
                        $column->append($box);
                    }
                });


                $row->column(4, function (Column $column) {
                    $count = User::where('pharmacy_id', Admin::user()->pharmacy_id)->count();
                    $box = new Box('Employees', '<h3 style="text-align:right; margin: 0; font-size: 40px; font-weight: 800" >' . $count . '</h3>');
                    $box->style('info')
                        ->solid();
                    $column->append($box);
                });

                $row->column(4, function (Column $column) {

                    $total_sales = StockRecord::where(
                        'pharmacy_id',
                        Admin::user()->pharmacy_id
                    )
                        ->sum('total_sales');
                    $u = Admin::user();
                    $company = Pharmacy::find($u->pharmacy_id);
                    $box = new Box('Todays sales', '<h3 style="text-align:right; margin: 0; font-size: 40px; font-weight: 800" >'
                        . $company->currency . " " . number_format($total_sales) .
                        '</h3>');
                    $box->style('info')
                        ->solid();
                    $column->append($box);
                });



                // $row->column(4, function (Column $column) {
                //     $column->append(Dashboard::extensions());
                // });

                // $row->column(4, function (Column $column) {
                //     $column->append(Dashboard::dependencies());
                // });
            });
    }
}
