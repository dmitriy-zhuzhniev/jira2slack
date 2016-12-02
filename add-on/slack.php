<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
     <link rel="stylesheet" href="//aui-cdn.atlassian.com/aui-adg/5.9.12/css/aui.min.css" media="all">
 </head>
 <body>
     <section id="content" class="ac-content" style="height: 300px;">
         <div class="aui-page-header">
             <div class="aui-page-header-main">
                 <?php
                    $messages = json_decode(file_get_contents('../msg/2jira.json'), true);
                    foreach ($messages as $key => $message) {
                        echo '<p><b>'.$message['user_name'].':</b> '.$message['text'].'</p>';
                    }
                ?>
             </div>
         </div>
     </section>

     <script id="connect-loader" data-options="sizeToParent:true;">
         (function() {
             var getUrlParam = function (param) {
                 var codedParam = (new RegExp(param + '=([^&]*)')).exec(window.location.search)[1];
                 return decodeURIComponent(codedParam);
             };

             var baseUrl = getUrlParam('xdm_e') + getUrlParam('cp');
             var options = document.getElementById('connect-loader').getAttribute('data-options');

             var script = document.createElement("script");
             script.src = baseUrl + '/atlassian-connect/all.js';

             if(options) {
                 script.setAttribute('data-options', options);
             }

             document.getElementsByTagName("head")[0].appendChild(script);
         })();
     </script>

 </body>
</html>