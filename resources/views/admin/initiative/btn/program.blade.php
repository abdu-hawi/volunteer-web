{{--<a href="{!! url('initiatives/'.$id.'/edit') !!}" class="btn btn-outline-primary btn-sm">--}}
{{--    <i class="fa fa-edit"></i>--}}
{{--</a>--}}

{!! (\App\Models\Program::query()->where('id',$program_id)->first())->name !!}
