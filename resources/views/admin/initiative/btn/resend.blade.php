
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-dark btn-sm delete-city-{!! $id !!}">
    <i class="fa fa-paper-plane"></i>
</button>

<div class="spinner-border text-dark spinner-city-{!! $id !!}" role="status">
    <span class="sr-only">Loading...</span>
</div>

<script>
    $(".spinner-city-{!! $id !!}").addClass('d-none');
    $(document).on('click','.delete-city-{!! $id !!}',function(){
        $(".spinner-city-{!! $id !!}").removeClass('d-none');
        $('.delete-city-{!! $id !!}').addClass('d-none');
        $.ajax({
            url:'{!! url('resend') !!}',
            type:'post',
            data_type:'json',
            data: {
                _token:'{!! csrf_token() !!}',
                id:'{!! $id !!}'
            },
            success:function (data) {
                alert("تم ارسال الاشعارات بنجاح")
                $(".spinner-city-{!! $id !!}").addClass('d-none');
                $('.delete-city-{!! $id !!}').removeClass('d-none');
            },
            error:function (){
                alert("لم يتم الارسال نرجوا المحاولة مرة أخرى")
                $(".spinner-city-{!! $id !!}").addClass('d-none');
                $('.delete-city-{!! $id !!}').removeClass('d-none');
            }
        })
        return false;
    })
</script>
