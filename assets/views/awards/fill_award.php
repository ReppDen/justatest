<?php
function first_stage() {
    echo '
<fieldset>
    <label>Научная деятельность</label>
    Научные школы:
    <br/><input type="checkbox" name="o7_1">1 и более</input>

    <label>Индекс научной эффективности подразделения</label>
    число аспирантов/докторантов, защитившихся в отчетный период
    <br/><input type="number" name="o7_2" value="0" required/>
    <br/><br/>
    руководство грантами РФФИ, РГНФ, федеральных  целевых Программ, Программы стратегического развития вуза
    <br/><input type="number" name="o7_3" value="0" required/>
    <br/><br/>
    организация конференций любого уровня
    <br/><input type="number" name="o7_4" value="0" required/>
    <br/><br/>
    выступления сотрудников с докладами на международных и всероссийских конференциях
    <br/><input type="number" name="o7_5" value="0" required/>
    <br/><br/>
    количество монографий с  ISBN, или разделов в коллективных монографиях,  учебников с грифом МОН РФ, Рособразования, УМО
    <br/><input type="number" name="o7_6" value="0" required/>
    <br/><br/>
    количество статей в рецензируемых (ВАК) изданиях, -  в зарубежных индексируемых изданиях
    <br/><input type="number" name="o7_7" value="0" required/>
    <br/><br/>
    в зарубежных индексируемых изданиях
    <br/><input type="number" name="o7_8" value="0" required/>
    <br/><br/>
    количество статей в других изданиях
    <br/><input type="number" name="o7_9" value="0" required/>
</fieldset>
';
}


function second_stage() {
    echo '<label>SECOND</label>
    <input type="text" value="SECOND!!!">';
}
?>

<form method="POST" action="/award/save_stage">
    <fieldset>
        <input type="hidden" name="stage_id" value="<?php echo $stage->id; ?>"/>
        <input type="hidden" name="year" value="<?php echo $year; ?>"/>
        <input type="hidden" name="nf" value="<?php echo $nf; ?>"/>
        <input type="hidden" name="nprf" value="<?php echo $nprf; ?>"/>
        <input type="hidden" name="faculty" value="<?php echo $faculty; ?>"/>
        <input type="hidden" name="overwrite" value="<?php echo $overwrite; ?>"/>

        <legend>Добавить расчет стимулирующих выплат </legend>
        <span class="subtitle">за период "<?php echo $stage->name ?>" в <?php echo $year?>г.</span>
        <?php
            switch ($stage->id) {
                case 1:
                    first_stage();
                    break;
                case 2:
                    second_stage();
                    break;
                case 3:
                    break;
                default:
                    $error = "Не верно переданы параметры этапа";
            }
        ?>
        <br/>
        <button type="submit" class="btn  btn-success">Добавить</button>
    </fieldset>
</form>