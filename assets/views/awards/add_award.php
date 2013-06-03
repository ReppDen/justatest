<form method="POST" action="/award/fill_stage">
    <fieldset>
        <legend>Добавить расчет стимулирующих выплат</legend>
        <label>Этап</label>
        <?php
        foreach ($stages as $s) {
            echo '<input type="radio" name="stage" value="'.$s->id.'" required />'.$s->name.'<br/>';
        }
        ?>
        <label>Год</label>
        <input type="number" name="year" value="<?php echo date("Y") ?>" required >
        <br/>
<!--        <label>Факультет</label>-->
<!--        <select name="faculty">-->
<!--            --><?php
//                foreach($faculties as $f) {
//                    echo '<option value="'.$f->id.'">'.$f->name.'</option>';
//                }
//            ?>
<!--        </select>-->
        <button type="submit" class="btn">Далее</button>
    </fieldset>
</form>
