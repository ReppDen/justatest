<form method="POST" action="/awarduser/fill_stage">
    <fieldset>
        <legend>Добавить расчет стимулирующих выплат для сотрудника</legend>
        <label>Этап</label>
        <?php
        foreach ($stages as $s) {
            echo '<input type="radio" name="stage" value="'.$s->id.'" required />'.$s->name.'<br/>';
        }
        ?>
        <label>Год</label>
        <input type="number" name="year" value="<?php echo date("Y") ?>" required >
        <br/>
        <label>Факультет</label>
        <select name="faculty">
            <?php
                foreach($users as $u) {
                    echo '<option value="'.$u->id.'">'.$u->fio.'</option>';
                }
            ?>
        </select>
        <br/>
        <button type="submit" class="btn">Далее</button>
    </fieldset>
</form>
