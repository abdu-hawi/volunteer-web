



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

                <h4 class="modal-title">أسماء المتطوعون في الفرصة</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body text-left">
                <?php
                if (count($volunteers) > 0){
                ?>
                <strong>عدد المتطوعين: </strong><span id="volunteer_cnt">0</span>
                <br>
                <table class="w-100">
                    <thead class="bg-dark">
                    <tr>
                        <th>الاسم</th>
                        <th>قبل التطوع</th>
                        <th>الانجاز</th>
                        <th>عدد الساعات</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $cnt = 0;
                    foreach ($volunteers as $initiative){

                    echo "<tr class='text-center'>".
                        "<td class='text-left'>".$initiative['name']."</td>";
                    if ($initiative["pivot"]["isAccept"]){
                    $cnt++;
                    echo "<td><span class='btn btn-success btn-sm'>نعم</span></td>";
                    if ($initiative["pivot"]["isFinish"]){
                        echo "<td><span class='btn btn-info btn-sm'>تم الانجاز</span></td>";
                        echo "<td><span class='btn btn-info btn-sm'>".$initiative["pivot"]["hours"]."ساعة "."</span></td>";
                    }else{ ?>
                    <td colspan='2'>
                        <button class='btn btn-warning btn-sm'>
                            جاري العمل
                        </button>
                    </td>
                    <?php
                    }
                    }else{
                        echo "<td><span class='btn btn-danger btn-sm'>لا</span></td>";
                        echo "<td colspan='2'><span class='btn btn-danger btn-sm'>غير مسجل</span></td>";
                    }
                    echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <script>
                    document.getElementById('volunteer_cnt').innerText = "<?php echo $cnt; ?>"
                </script>
                <?php
                }else{
                    echo '<span class="text-danger">لم يقبل المتطوع الفرص الوظيفية</span>';
                }
                ?>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">اغلاق</button>
            </div>

        </div>
    </div>
</div>

