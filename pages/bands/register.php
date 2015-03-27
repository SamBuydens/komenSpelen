<div id="content">
    <div id="content_wrapper">
    <article class="registrationScreen">
        <header>
            <h1>Register Band</h1>
        </header>
        <link rel="stylesheet" href="css/register.css">
        <form class="registerForm" action="index.php?p=register" method="post" enctype="multipart/form-data">
            <fieldset class="imageUpload">
                <div class="btnImgUpload" style="cursor:pointer;" onclick="getFile()"><span>+ Image</span></div>
                <div class="imagePreview">&nbsp;</div>
                <div style='height: 0px; width:0px; overflow:hidden;'><input class="upfile" type="file" name="image" id='image' /></div>
        
                <input tabindex="1" type="text" name="bandname" required placeholder="banname" id="txtBandname" <?php if(!empty($_SESSION['errors']['bandname'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['bandname']) && !empty($_POST['bandname'])){ echo $_POST['bandname']; } ?>"/>
         
                <input tabindex="2" type="email" name="email" required placeholder="mail-address" id="txtEmail" <?php if(!empty($_SESSION['errors']['email'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['email']) && !empty($_POST['email'])){ echo $_POST['email']; } ?>"/>
          
                <input tabindex="3" type="password" name="password" required placeholder="password" id="txtPassword" <?php if(!empty($_SESSION['errors']['password'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['password']) && !empty($_POST['password'])){ echo $_POST['password']; } ?>"/>
          
                <input tabindex="4" type="password" name="repeat_pass" required placeholder="repeat password" id="txtConfPassword" <?php if(!empty($_SESSION['errors']['repeat_pass'])){ echo "class=\"error\""; } ?> value="<?php if(empty($_SESSION['errors']['repeat_pass']) && !empty($_POST['repeat_pass'])){ echo $_POST['repeat_pass']; } ?>"/>
         
                <input tabindex="5" type="submit" name="submit" id="btnRegister" value="Registreer Band"/>
            </fieldset>
        </form>
    </article>
    </div>
</div>
<script>
    var errors = [];
    var imagePreview = $('.imagePreview');
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
                };
            }(file));
            reader.readAsDataURL(file);
        }
    }

    init();
</script>