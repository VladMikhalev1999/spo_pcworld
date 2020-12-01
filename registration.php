<div id="regfrm" method="post">
<h3>Форма регистрации</h3>
<p>
    <label for="fn">Имя пользователя&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="fn" name="firstName" type="text" required />
</p>
<p>
    <label for="em">Адрес электронной почты</label>
    <input id="em" name="mail" type="email" required />
</p>
<p>
    <label for="lg">Логин&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="lg" name="login" type="text" required />
</p>
<p>
    <label for="pd">Пароль&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="pd" name="passwd"type="password" required />
</p>
<p>
    <label for="repd">Подтверждение пароля&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input id="repd" name="rePasswd" type="password" required />
</p>
<p style="text-align: center; border-top: 3px solid blue;">
    <button onclick="showRegForm()">Очистить</button>
    <button type="submit" onclick="auth()">Отправить</button>
</p>
</div>

<script>
var possibles = []
function generatePossibleEmails(possibles, name, data) {
    if (possibles.length == 0 && data == 0) return true;
    if (possibles.length > 3 && data == 0) return true;
    let ename = name.split('@')[0];
    if (name.split('@')[1] == undefined) {
        return;
    }
    let alfa = "abcdefghijklmnopqrstuvwxyz0123456789-_";
    let randomIndex = Math.floor(Math.random() * alfa.length);
    ename += alfa[randomIndex];
    randomIndex = Math.floor(Math.random() * alfa.length);
    ename += alfa[randomIndex] + "@" + name.split('@')[1];
    let bRes = isNameReserved(possibles, ename);
    if (bRes) return true;
    if (possibles.length <= 3) {
        possibles.push(ename)
        return false;
    }
    return true;
}
document.getElementById("em").addEventListener("change", event => {
    possibles = []
    isNameReserved(possibles, event.target.value)
});
function isNameReserved(possibles, name) {
$.ajax({ 
            type: "POST",
            url: "users.php",
            data: { mail: name } ,
            success: function(data) {
                    let b = generatePossibleEmails(possibles, name, data)
                    if (possibles.length != 0) {
                        $("#me").remove();
                        $("#regfrm").parent().append("<div id='me' style='color: red'><p>Пользователь с такой почтой занят! Выберите другую из списка:</p></div>")
                        for (let i = 0; i < possibles.length; i++) {
                            $("#me").append("<p>" + possibles[i] + "</p>");
                        }
                    } else {
                        $("#me").remove();
                    }
                    return b;
            }
        });
}    
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