<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <?php
    if (count($volunteers) > 0){
    ?>
    <strong>عدد المتطوعين: </strong><span id="volunteer_cnt">0</span>
    <br>
    {{$hours}}
    <button class='btn btn-warning btn-sm' wire:click="add">
        جاري العمل
    </button>
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
                        <button class='btn btn-warning btn-sm'
                            wire:click="close">
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
