<div id="content">
    <div id="content_wrapper">
    <article class="loginScreen">
        <header>
            <h1>Login</h1>
        </header>
        <form class="loginForm" action="index.php?p=login" method="post">
            <fieldset>
                <input tabindex="1" type="text" name="login" required placeholder="bandname or e-mail" id="txtLogin" <?php if(!empty($_SESSION['errors']['login'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['login']) && !empty($_POST['login'])){ echo $_POST['login']; } ?>"/>
            </fieldset>
            <fieldset>
                <input tabindex="2" type="password" name="password" required placeholder="password" id="txtPassword" <?php if(!empty($_SESSION['errors']['password'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['password']) && !empty($_POST['password'])){ echo $_POST['password']; } ?>"/>
            </fieldset>
            <fieldset>
                <input tabindex="3" type="submit" name="submit" id="btnLogin" value="Login"/>
            </fieldset>
        </form>
    </article>
    </div>
</div>