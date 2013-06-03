<?php if ($error != null) {
    echo '<div class="alert-error">'.$error.'</div>';
}
?>
<form method="POST">
    <fieldset>
        <legend>Регистрация</legend>
        <label>Email пользователя</label>
        <input type="text" name="username" placeholder="email" required />
        <label>ФИО пользователя</label>
        <input type="text" name="fio" placeholder="ФИО" required/>
        <label>Пароль</label>
        <input type="password" name="password" required/>
        <br/>
        <button type="submit" class="btn">Регистрация</button>
        <br/>
    </fieldset>
</form>
