<div id="content">
    <div id="content_wrapper">
    <article class="adminPanel">
        <header>
            <h1>Admin Panel</h1>
        </header>
        <section class="sendInvite">
            <header>
                <h1>Send Invite</h1>
            </header>
            <form class="inviteForm" action="?p=adminPanel&amp;action=sendInvite" method="post">
                <fieldset>
                    <input tabindex="1" type="email" name="email" required placeholder="Mail-Adress" id="txtEmail" <?php if(!empty($_SESSION['errors']['email'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['email']) && !empty($_POST['email'])){ echo $_POST['email']; } ?>"/>
                </fieldset>
                <fieldset>
                    <input tabindex="2" type="submit" name="submit" id="btnSendInvite" value="Send Invite"/>
                </fieldset>
            </form>
        </section>
    </article>
    </div>
</div>