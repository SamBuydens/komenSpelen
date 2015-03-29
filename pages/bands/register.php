<div id="container">
    <article id="register">
        <section>
            <header>
                <h1>Registreren</h1>
            </header>
            <form class="registerForm" action="index.php?p=register" method="post" enctype="multipart/form-data">
                <fieldset>
                    <a>terug</a>
                    <legend>registreren</legend>
                    <span class=".imgPreview">
                        <div class="btnImgUpload" style="cursor:pointer;" onclick="getFile()">&nbsp;</div>
                        <div class="imagePreview">&nbsp;</div>
                        <div style='height: 0px; width:0px; overflow:hidden;'><input class="upfile" type="file" name="image" id='image' /></div>
                    </span>
                    <span>
                        <label for="txtLogin"><span>bandnaam</span></label>
                        <input tabindex="1" type="text" name="bandname" required placeholder="bandname" id="txtLogin" <?php if(!empty($_SESSION['errors']['bandname'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['bandname']) && !empty($_POST['bandname'])){ echo $_POST['bandname']; } ?>"/>
                    </span>
                    <span>
                        <label for="txtPassword"><span>paswoord</span></label>
                        <input tabindex="3" type="password" name="password" required placeholder="password" id="txtPassword" <?php if(!empty($_SESSION['errors']['password'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['password']) && !empty($_POST['password'])){ echo $_POST['password']; } ?>"/>
                    </span>
                    <span>
                        <label for="txtPasswordRepeat"><span>paswoord</span></label>
                        <input tabindex="4" type="password" name="repeat_pass" required placeholder="repeat password" id="txtPasswordRepeat" <?php if(!empty($_SESSION['errors']['repeat_pass'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['repeat_pass']) && !empty($_POST['repeat_pass'])){ echo $_POST['repeat_pass']; } ?>"/>
                    </span>
                    <span>
                        <input tabindex="5" type="submit" name="submit" id="btnRegister" value="Registreer Band"/>
                    </span>
                </fieldset>
            </form>
        </section>
    </article>
</div>
<script src="js/vendor/jquery.min.js"></script>
<script>
    var errors = [];
    //var imagePreview = $('.imagePreview');
    var imagePreview = $('.imgPreview');
    var btnImgUpload = $('.btnImgUpload');

    function init()
    {
        if (
            window.File && 
            window.FileReader && 
            window.FileList && 
            window.Blob
        ) {
            //console.log("Full file support");
            $('.upfile').on('change', previewFiles);
        }
    }

    function getFile(){
        $(".upfile").click();
    }

    function previewFiles(evt){
        var files = evt.target.files;
        var file = files[0];
        // if the file is not an image, do nothing
        if(file.type.match('image.*')){ 
            reader = new FileReader();
            reader.onload = (function (tFile) {
                return function (evt) {
                    imagePreview.css("background-image", "url('"+ evt.target.result +"')");
                    //btnImgUpload.css("background-image", "url('"+ evt.target.result +"')");
                };
            }(file));
            reader.readAsDataURL(file);
        }
    }

    init();
</script>