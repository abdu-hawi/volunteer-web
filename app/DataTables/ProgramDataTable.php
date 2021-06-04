<?php

namespace App\DataTables;

use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProgramDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
//                ->addColumn('checkbox', 'admin.cities.btn.checkbox')
                ->addColumn('edit', 'admin.program.btn.edit')
                ->addColumn('delete', 'admin.program.btn.delete')
                ->addColumn('show', 'admin.program.btn.show')
                ->rawColumns([
                    'edit',
                    'delete',
                    'show',
                ])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Program $model
     * @return Builder
     */
    public function query(Program $model)
    {
        return $model->newQuery()->with('initiatives');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
//        return $this->builder()
//                    ->setTableId('programdatatable-table')
//                    ->columns($this->getColumns())
//                    ->minifiedAjax()
//                    ->dom('Bfrtip')
//                    ->orderBy(1)
//                    ->buttons(
//                        Button::make('create'),
//                        Button::make('export'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    );
        return $this->builder()
            ->setTableId('programdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
//            ->dom('Bfrtip')
            ->dom("<'row'<'col-sm-12 col-md-12'B>>" .
                "<'row-padding'>".
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1)
            ->lengthMenu([[10,25,50,-1],[10,25,50,"كل السجلات"]])
            ->language(datatableLang())
            ->buttons(
                Button::make('create')
                    ->className('btn btn-success btn-sm mr-1')
                    ->text('<i class="fas fa-plus fa-sm"></i> '."اضافة مجال"),
                Button::make('print')
                    ->className('btn btn-primary btn-sm mr-1')
                    ->text('<i class="fas fa-print fa-sm"></i> '."طباعة"),
                Button::make('excel')->className('btn btn-info btn-sm mr-1')
                    ->text('<i class="fas fa-file-excel"></i> '."استخراج بصيغة اكسل"),
                Button::make('create')->action('www.google.com')
                    ->className('btn btn-danger del-btn btn-sm mr-1')
                    ->text('<i class="fas fa-trash fa-sm"></i> '."حذف")

            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            Column::make('id')->name('id')->title("م.")->width(0),
            Column::make('name')->name('name')->title("اسم المجال"),
            Column::computed('show')
                ->title(" الفرص")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('edit')
                ->title("تعديل")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('delete')
                ->title("حذف")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Program_' . date('YmdHis');
    }
}
