



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#cities_delete_modal_{!! $id !!}">
    <i class="fa fa-eye"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="cities_delete_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-info">
                <h4 class="modal-title">الفرص التابعة للمجال</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body text-left">
                <ul>
                    @if (count($initiatives) > 0)
                    @foreach($initiatives as $program)
                        <li>{!! $program['name'] !!}</li>
                    @endforeach
                    @else
                        <span class="text-danger">لا توجد فرص مسجلة بهذا المجال</span>
                    @endif
                </ul>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">اغلاق</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => url('programs/'.$id),'id'=>'form_delete_city_'.$id,'method'=>'delete']) !!}
{!! Form::close() !!}

<script>
    $(document).on('click','.delete-city-{!! $id !!}',function(){
        $('#form_delete_city_{!! $id !!}').submit();
    });
</script>
