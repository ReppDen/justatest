<script>
    $(document).ready(function() {
        $("#set_date").click(function() {
            var params = window.location.href.substring(window.location.href.lastIndexOf('?'));
            location.href="/award/list_award/" + $("#year").val() + "/" + params;
        });

        $("#sort").val($.url().param("sort"));
    });
</script>

<?php
echo '<pre>';
print_r($_GET);
echo '</pre>';
echo getDir("type");
echo getDir("date");
echo getDir("sum");
echo getDir("faculty");
?>
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

<?php
function getDir($sort) {
    if (!isset($_GET['dir']) || !isset($_GET['sort'])) {
        return 'desc';
    } else
        if ($_GET['sort'] == $sort && $_GET['dir'] == 'asc') {
            return 'desc';
        } else {
            return 'asc';
        }
}

function dirText($sort) {
    if (!isset($_GET['dir'])) {
        return;
    }
    if (isset($_GET['sort']) && $_GET['sort'] == $sort) {
        $d = getDir($sort);
        if ($d == 'asc') {
            return "(по убыванию)";
        } else if ($d == 'desc') {
            return "(по возрастанию)";
        }
    }
}
?>
<table class="table">
    <tr>
        <td>
            №
        </td>
        <td>
            <a href="/award/list_award/<?php echo $year;?>/?sort=type&dir=<?php echo getDir("type");?>" class="sorter">Тип расчета<?php echo dirText("type");?></a>
        </td>
        <td>
            <a href="/award/list_award/<?php echo $year;?>/?sort=date&dir=<?php echo getDir("date");?>" class="sorter">Дата<?php echo dirText("date");?></a>
        </td>
        <td>
           <a href="/award/list_award/<?php echo $year;?>/?sort=sum&dir=<?php echo getDir("sum");?>" class="sorter">Баллы<?php echo dirText("sum");?></a>
        </td>
        <td>
            <a href="/award/list_award/<?php echo $year;?>/?sort=faculty&dir=<?php echo getDir("faculty");?>" class="sorter">Факультет<?php echo dirText("faculty");?></a>
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

