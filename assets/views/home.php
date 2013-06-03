<h3>Пользователь <?php echo $user->fio;?></h3>
<div>
    <a href="/award">Добавить расчет баллов факультета</a><br/>
    <a href="/award/list_award">Посмотреть список расчетов</a><br/>
    <?php
    if ($user->role = 'admin') {
        echo '<a href="/admin">Консоль администратора</a><br/>';
    }
    ?>
    <a href="/login/logout">Выход из системы</a>
</div>