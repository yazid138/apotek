<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransaksiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('total', function ($row) {
                return $row->qty * $row->obat->price;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->with(['obat', 'transaksi'])->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaksi-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
        //->dom('Bfrtip')
            ->orderBy(1)
        // ->selectStyleSingle()
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('transaksi.input_date')->title('Tanggal'),
            Column::make('id')->title('Id Order'),
            Column::make('transaksi.input_name')->title('Id User'),
            Column::make('obat.name')->title('Nama Obat'),
            Column::make('obat.no_batch')->title('No. Batch'),
            Column::make('obat.price')->title('Harga')->render("$.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )"),
            Column::make('qty')->title('qty'),
            Column::make('total')->title('Total')->render("$.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )"),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaksi_' . date('YmdHis');
    }
}
