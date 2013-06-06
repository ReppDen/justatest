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
<!--        <input type="number" name="year" value="--><?php //echo date("Y") ?><!--" required >-->
        <select id="year" class="year">
            <?php
            $year = date("Y");
            for ($i = 1970; $i< $year + 20; $i++) {
                if ($i == $year) {
                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                } else {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
            }
            ?>
        </select>
        <br/>

        <button type="submit" class="btn">Далее</button>
    </fieldset>
</form>
