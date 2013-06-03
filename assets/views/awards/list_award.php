<script>
    $(document).ready(function() {
        $("#set_date").click(function() {
            location.href="/award/list_award/" + $("#year").val();
        });
    });
</script>

<fieldset>
    <legend>Список всех расчетов за <?php echo $year; ?> год</legend>

    <table>
        <tr>
            <td>
                Посмотреть за год:
            </td>
            <td>
                <input type="number" id="year" value="<?php echo $year ?>"/>
            </td>
            <td>
                <Button id="set_date" class="btn fix_button">Посмотреть</Button>
            </td>
        </tr>
    </table>

</fieldset>

<table class="table">
    <tr>
        <td>
            №
        </td>
        <td>
            Тип расчета
        </td>
        <td>
            Дата
        </td>
        <td>
           Баллы
        </td>
        <td>
            Факультет
        </td>
        <?php
        if ($can_delete) {
            echo '<td>
                Удалить
            </td>';
        }
        ?>
    </tr>
    <?php
    $i = 0;
    foreach ($awards as $a) {
        $i++;
        echo '
        <tr>
            <td>
                '.$i.'
            </td>
            <td>
                '.$a->stage->name.'
            </td>
            <td>
                '.$a->date.'
            </td>
            <td>
               '.$a->sum.'
            </td>
            <td>
               '.$a->faculty->name.'
            </td>
        ';
        if ($can_delete) {
            echo '
                <td>
                    <a href="/award/delete_award/'.$a->id.'">Удалить</a>
                </td>
            ';
        }
        echo '</tr>';


    }
    ?>
</table>

