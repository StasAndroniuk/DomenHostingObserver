<html>
<head>
    <link href="stylesheet/style.css" rel="stylesheet">
    <link href="stylesheet/jquery-ui.css" rel="stylesheet">
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src='js/datepicker-ru.js'></script>
    <script src="js/jquery.inputmask.js"></script>
   <script>
       $(document).ready(getContent('modules/domen/module.php'));
       </script>
    </head>
    
 <body>
     <div id="wrapper">
                <div class="menu"> 
                    <a id="domen_but" onClick="getContent('modules/domen/module.php','domen');" class="module active">Домены</a>
                    <a id="owner_but" value="Владельцы" onClick="getContent('modules/owner/module.php','owner');" class="module">Владельцы</a>  
                    <a id="recorder_but" value="Регистраторы" onClick="getContent('modules/recorder/module.php','recorder');" class="module">Регистраторы</a>  
                    <a id="hosting_but" value="Хостинги" onClick="getContent('modules/hosting/module.php','hosting');" class="module">Хостинги</a>
                    <a id="settings_but" value="Настройки" onClick="getContent('modules/settings/module.php','settings');" class="module">Настройки</a> 
                    <a href="/DHO/modules/login/module.php" class="module">Выйти</a>
                </div>
                <div id="content">
                </div>
    
       </div>
  </body>
 </html>
