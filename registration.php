<div id="regfrm" method="post">
<h3>Форма регистрации</h3>
<p>
    <label for="fn">Имя пользователя&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="fn" name="firstName" type="text" required/>
</p>
<p>
    <label for="em">Адрес электронной почты</label>
    <input id="em" name="mail" type="email" required/>
</p>
<p>
    <label for="lg">Логин&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="lg" name="login" type="text" required/>
</p>
<p>
    <label for="pd">Пароль&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="pd" name="passwd"type="password" required/>
</p>
<p>
    <label for="repd">Подтверждение пароля&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="repd" name="rePasswd" type="password" required/>
</p>
<p style="text-align: center; border-top: 3px solid blue;">
    <button onclick="showRegForm()">Очистить</button>
    <button type="submit" onclick="auth()">Отправить</button>
</p>
</div>

<script>
function auth() {
let inputs = $('#regfrm').find('input');
$.ajax({ 
            type: "POST",
            url: "reg.php",
            data: { firstName: inputs[0].value, mail: inputs[1].value, login: inputs[2].value, passwd: inputs[3].value, rePasswd: inputs[4].value } ,
            success: function(data) {
                if (data.indexOf('[Error]') == -1) {
                    $("#main").html(data);
                } else {
                    showRegForm(data);
                }
            }
        });
}

</script>