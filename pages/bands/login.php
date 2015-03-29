<div id="container">
    <article id="login">
        <section>
            <header>
                <h1><span>Komen Spelen</span></h1>
            </header>
            <form class="loginForm" action="index.php?p=login" method="post">
                <fieldset>
                    <span>
                        <label for="txtLogin"><span>bandnaam</span></label>
                        <input tabindex="1" type="text" name="login" required placeholder="bandname or e-mail" id="txtLogin" <?php if(!empty($_SESSION['errors']['login'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['login']) && !empty($_POST['login'])){ echo $_POST['login']; } ?>"/>
                    </span>
                    <span>
                        <label for="txtPassword"><span>paswoord</span></label>
                        <input tabindex="2" type="password" name="password" required placeholder="password" id="txtPassword" <?php if(!empty($_SESSION['errors']['password'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['password']) && !empty($_POST['password'])){ echo $_POST['password']; } ?>"/>
                    </span>
                    <span >
                        <input tabindex="3" type="submit" name="submit" id="btnLogin" value="aanmelden"/>
                    </span>
                </fieldset>
            </form>
        </article>
    </div>
</div>