<?php

namespace App\DataTables;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ObatDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $delete = "";
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.obat.edit', $row->id);
                $btnPesan = '<button type="button" class="btn btn-success" onclick="openModal(' . $row->id . ', \'' . $row->name . '\')">Pesan</button>';
                $btnEdit = '<a href="' . $editUrl . '" class="btn btn-warning btn-edit">Edit</a>';
                $btnDelete = '<button type="button" class="btn btn-danger btn-delete" onclick="remove(' . $row->id . ')">Hapus</button>';
                $btn = '';
                if (Auth::user()->role === 'apoteker') {
                    $btn .= $btnPesan;
                }
                $btn .= $btnEdit . $btnDelete;
                return $btn;
            })
            ->setRowClass(function ($obat) {
                if ($obat->stock - $obat->safety_stock <= 0) {
                    return 'red';
                } else if ($obat->stock - $obat->safety_stock <= 50) {
                    return 'yellow';
                } else {
                    return 'green';
                }
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Obat $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('obat-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
        //->dom('Bfrtip')
            ->orderBy(1)
        // ->selectStyleSingle()
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $user = Auth::user();
        if ($user->role === 'karyawan') {
            return [
                Column::make('name')->title('Nama Obat'),
                Column::make('price')->title('Harga')->render("$.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )"),
                Column::make('no_batch')->title('Nomor Batch'),
                Column::make('stock')->title('Stock'),
                Column::make('expired_date')->title('Kadaluarsa'),
            ];
        }

        return [
            Column::make('DT_RowIndex')->title('No'),
            Column::make('name')->title('Nama Obat'),
            Column::make('price')->title('Harga')->render("$.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )"),
            Column::make('safety_stock')->title('Safety Stock'),
            Column::make('stock')->title('Stock'),
            Column::make('no_batch')->title('Nomor Batch'),
            Column::make('expired_date')->title('Kadaluarsa'),
            Column::computed('action', 'Aksi')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Obat_' . date('YmdHis');
    }
}
