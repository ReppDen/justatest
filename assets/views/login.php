<?php if ($error) {
    echo '<div class="alert-error">Введены не верные логин и пароль, по пробуйте еще раз</div>';
}
?>
<form method="POST">
    <fieldset>
        <legend>Авторизация</legend>
        <label>Email пользователя</label>
        <input type="text" name="username" placeholder="email" required>
        <label>Пароль</label>
        <input type="password" name="password" required >
        <br/>
        <button type="submit" class="btn">Вход</button>
        <br/>
        <a href="/login/register">Регистрация</a>
        <br/>
    </fieldset>
</form>
