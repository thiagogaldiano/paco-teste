<?php

namespace App\DataTables;

use App\Models\Conversions;
use App\Models\Coins;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ConversionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->editColumn('user_id', function($obj) {
            return $obj->user->name;
        })
        ->editColumn('coin_id', function($obj) {
            $coin_name = Coins::find($obj->coin_id)->name;
            return $coin_name;
        })
        ->editColumn('coin_conversion_id', function($obj) {
            $coin_name = Coins::find($obj->coin_conversion_id)->name;
            return $coin_name;
        })
        ->editColumn('value_conversion', function($obj) {
            return number_format($obj->value_conversion, 2, ",", ".");
        })
        ->editColumn('price_conversion', function($obj) {
            return number_format($obj->price_conversion, 2, ",", ".");
        })
        ->editColumn('date_conversion', function($obj) {
            return ($obj->date_conversion != '' ? $obj->date_conversion->format('d/m/Y') : '-');
        })
        ->addColumn('action', 'conversions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Conversions $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Conversions $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'coin_id',
            'coin_conversion_id',
            'value_conversion',
            'price_conversion',
            'user_id',
            'date_conversion'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'conversions_datatable_' . time();
    }
}
