<?php

namespace App\DataTables;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VolunteerDataTable extends DataTable
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
            ->addColumn('delete', 'admin.volunteer.btn.delete')
            ->addColumn('show', 'admin.volunteer.btn.show')
            ->addColumn('edit', 'admin.volunteer.btn.edit')
            ->addColumn('phone', 'admin.volunteer.btn.phone')
                ->rawColumns([
                    'edit',
                    'delete',
                    'show',
                    'phone',
                ])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Volunteer $model
     * @return Builder
     */
    public function query(Volunteer $model)
    {
        // $model->newQuery()->where('advisor_id', advisor()->id())->with('interest');
        return $model->newQuery()->with(['initiatives','programs']);//->groupBy();//->programs;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('volunteerdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
//            ->dom('Bfrtip')
            ->dom("<'row'<'col-sm-12 col-md-12'B>>" .
                "<'row-padding'>".
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1)
            ->lengthMenu([[10,25,50,-1],[10,25,50,"???? ??????????????"]])
            ->language(datatableLang())
            ->buttons(
                Button::make('create')
                    ->className('btn btn-success btn-sm mr-1')
                    ->text('<i class="fas fa-plus fa-sm"></i> '."?????????? ?????????? ????????"),
                Button::make('print')
                    ->className('btn btn-primary btn-sm mr-1')
                    ->text('<i class="fas fa-print fa-sm"></i> '."??????????"),
                Button::make('excel')->className('btn btn-info btn-sm mr-1')
                    ->text('<i class="fas fa-file-excel"></i> '."?????????????? ?????????? ????????")

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
            Column::make('id')->name('id')->title("?????? ????????????")->width(0)->className('d-none'),
            Column::make('name')->name('name')->title("??????????"),
//            Column::make('age')->name('age')->title("??????????"),
//            Column::make('mobile')->name('mobile')->title("?????? ????????????"),
//            Column::make('gender')->name('gender')->title("??????????"),
//            Column::make('national_id')->name('national_id')->title("?????? ????????????"),
            Column::make('points')->name('points')->title("????????????"),
            Column::computed('phone')
                ->title("??????????")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('delete')
                ->title("??????????????")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('show')
                ->title("?????????? ??????????????????")
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center col-1'),
            Column::computed('edit')
                ->title("??????????")
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
