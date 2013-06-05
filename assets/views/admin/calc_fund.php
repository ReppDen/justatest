<h3>Рассчет фонда стимулурующих выплат для университета</h3>
<form method="GET" action="/award/fill_stage">
    <fieldset>
        <label>Год</label>
        <input type="number" name="year" value="<?php echo date("Y") ?>" required >
        <br/>

        <label>Количество студентов факультета (приведенный контингент) или студентов,
            обслуживаемых кафедрой</label>
        <input type="number" name="nf" value="0" required/>
        <br/>

        <label>Количество студентов университета (приведенный контингент)</label>
        <input type="number" name="nu" value="0" required/>
        <br/>

        <label>Количество штатных преподавателей на факультете (кафедре)</label>
        <input type="number" name="nshf" value="0" required/>
        <br/>

        <label>Количество штатных преподавателей в университете</label>
        <input type="number" name="nshu" value="0" required/>
        <br/><br/>

        <button type="submit" class="btn">Рассчитать</button>
    </fieldset>
</form>
