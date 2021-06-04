<?php

namespace App\DataTables;

use App\Models\Initiative;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InitiativeDataTable extends DataTable
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
            ->addColumn('qrcode', 'admin.initiative.btn.qrcode')
            ->addColumn('end', 'admin.initiative.btn.end')
            ->addColumn('program', 'admin.initiative.btn.program')
            ->addColumn('show', 'admin.initiative.btn.show')
            ->addColumn('edit', 'admin.initiative.btn.edit')
            ->addColumn('resend', 'admin.initiative.btn.resend')
            ->rawColumns([
                'qrcode',
                'end',
                'program',
                'show',
                'edit',
                'resend',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Initiative $model
     * @return Builder
     */
    public function query(Initiative $model)
    {
        return $model->newQuery()->with(['programs','volunteers'])->orderByDesc('id');//->select('program.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('initiativedatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
                    ->text('<i class="fas fa-plus fa-sm"></i> '."اضافة فرصة تطوعية"),
                Button::make('print')
                    ->className('btn btn-primary btn-sm mr-1')
                    ->text('<i class="fas fa-print fa-sm"></i> '."طباعة"),
                Button::make('excel')->className('btn btn-info btn-sm mr-1')
                    ->text('<i class="fas fa-file-excel"></i> '."استخراج بصيغة اكسل")

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
            Column::make('name')->name('name')->title("الاسم"),
            Column::make('date_start')->name('date_start')->title("تاريخ بداية الفرصة"),
            Column::make('date_end')->name('date_end')->title("تاريخ نهاية الفرصة"),
//            Column::make('status')->name('status')->title("حالة الفرصة"),
//            Column::make('created_at')->name('created_at')->title("تاريخ الاعلان"),
//            Column::make('created_at')->name('created_at')->title("تاريخ الانشاء"),
            Column::computed('qrcode')
                ->title("QR Code")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('program')
                ->title("المجال")
                ->exportable(true)
                ->printable(true)
                ->searchable(true)
                ->orderable(true),
            Column::computed('end')
                ->title("انهاء الفرصة")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('show')
                ->title("المتطوعون")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('edit')
                ->title("تعديل")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('resend')
                ->title("اعادة ارسال")
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
        return 'Initiative_' . date('YmdHis');
    }
}
