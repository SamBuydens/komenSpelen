<div id="content">
    <div id="content_wrapper">
    <article class="registrationScreen">
        <header>
            <h1>Register Band</h1>
        </header>
        <form class="registerForm" action="index.php?p=register" method="post">
            <fieldset>
                <input tabindex="1" type="text" name="bandname" required placeholder="banname" id="txtBandname" <?php if(!empty($_SESSION['errors']['bandname'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['bandname']) && !empty($_POST['bandname'])){ echo $_POST['bandname']; } ?>"/>
            </fieldset>
            <fieldset>
                <input tabindex="2" type="email" name="email" required placeholder="mail-address" id="txtEmail" <?php if(!empty($_SESSION['errors']['email'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['email']) && !empty($_POST['email'])){ echo $_POST['email']; } ?>"/>
            </fieldset>
            <fieldset>
                <input tabindex="3" type="password" name="password" required placeholder="password" id="txtPassword" <?php if(!empty($_SESSION['errors']['password'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['password']) && !empty($_POST['password'])){ echo $_POST['password']; } ?>"/>
            </fieldset>
            <fieldset>
                <input tabindex="4" type="password" name="conf_password" required placeholder="repeat password" id="txtConfPassword" <?php if(!empty($_SESSION['errors']['conf_password'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['conf_password']) && !empty($_POST['conf_password'])){ echo $_POST['conf_password']; } ?>"/>
            </fieldset>
            <fieldset>
                <input tabindex="5" type="submit" name="submit" id="btnRegister" value="Registreer Band"/>
            </fieldset>
        </form>
    </article>
    </div>
</div>