<h3>Добавить расчет стимулирующих выплат</h3>
<form id="form" method="POST" action="/award/fill_stage">
<!--    <fieldset>-->

        <div class="col_container">
                    <div class="column">
                        <label>Факультет</label>
                        <select id="faculty" name="faculty">
                            <?php
                            foreach($faculties as $f) {
                                echo '<option value="'.$f->id.'">'.$f->name.'</option>';
                            }
                            ?>
                        </select>
                        <label>Этап</label>
                        <?php
                        foreach ($stages as $s) {
                            echo '<input type="radio" name="stage" value="'.$s->id.'" required />'.$s->name.'<br/>';
                        }
                        ?>
                        <br/>
                        <label>Год</label>
                        <!--        <input type="number" name="year" value="--><?php //echo date("Y") ?><!--" required >-->
                        <select id="year" name="year" class="year">
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
                    </div>
                    <div class="column" style="width:690px;">
                        <label>Количество студентов факультета (приведенный контингент) или студентов,
                            обслуживаемых кафедрой</label>
                        <input type="number" name="nf"  required/>
                        <br/>

                        <label>Количество штатных преподавателей на факультете (кафедре)</label>
                        <input type="number" name="nprf" required/>
                        <br/>
                    </div>
        </div>
    </fieldset>
    <input type="hidden" id="overwrite" name="overwrite" value="0" required/>
    <button type="button" class="btn" id="next_btn">Далее</button>
</form>
<script>
    $(document).ready(function() {
        $("#next_btn").click(function() {
            $.ajax({
                type: "GET",
                url: "/ajax/check_award",
                data: {
                    id: $('#faculty').val(),
                    year:$('#year').val()
                },
                success: function (res) {
                    if (res) {
                        console.log("вопрос");
                        var year = $("#year").val();
                        var stage = $("#stage").val();
                        if (confirm("Расчет для выбранного года и этапа уже существет. Перезаписать имеющийся?")) {
                            $("#overwrite").val(1);
                            $("#form").submit();
                        }
                    } else {
                        $("#form").submit();
                    }
                },
                error: function(res) {
                    $.jGrowl("Произошла ошибка во время запроса к серверу");
                }
            });
        });
    });
</script>