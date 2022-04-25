<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Agency;
use App\Models\Center;
use Yajra\DataTables\Services\DataTable;

use Yajra\DataTables\Html\Column;
class CenterDatatable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->editColumn('name', '{{$name}}')
            ->editColumn('address', '{{$address}}')
            ->editColumn('contacts', '{{$contacts}}')
            ->addColumn('user', '{{$user["name"]}}')
            ->addColumn('doctors', function($center){
                return  $center->doctors->pluck("name");
            });
            // ->rawColumns(['checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Center::query()->with(["user","doctors"])->select("centers.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('centers-table')
            ->columns($this->getColumns())
            ->dom('Bfrtip')
            ->parameters([
                'buttons'      => [
                    'pageLength',
                    [
                        "extend" => 'collection',
                        "text" => __("Export"),
                        "buttons" => ['csv', 'excel', 'print']
                    ],
                ],
                'lengthMenu' =>
                [
                    [10, 25, 50, -1],
                    ['10 ' . __('rows'), '25 ' . __('rows'), '50 ' . __('rows'), __('Show all')]
                ],

            ])
            ->minifiedAjax()
            ->orderBy(1)
            ->search([]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('name')->title(__('Name')),
            Column::make('address')->title(__('Address')),
            Column::make('contacts')->title(__('Contacts')),
            Column::make('user')->title(__('User')),
            Column::make('doctors')->title(__('Doctors')),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Centers_' . date('YmdHis');
    }
}
