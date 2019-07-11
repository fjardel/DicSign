<!DOCTYPE html>
<html>
    <head>
         
        <!-- Basic Page Needs
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        
        <title>dicSign - GEIRA</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– 
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css"> -->
        <link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>


        <!-- CSS
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/skeleton.css">
        <link rel="stylesheet" href="/css/style.css">
        <!--<link rel="stylesheet" href="css/verBordas.css"> -->

        <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="icon" type="image/png" href="/img/logos/dicsign.png">
        
        
        
        
        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/angular.min.js"></script>
        
        <script src="/js/scriptadmin.js"></script>
        
        <!-- janelas popups jqueryUI com thema personalizado -->
    <script src="/jquery-ui-dicsigntheme/external/jquery/jquery.js" ></script>    
    <link href="/jquery-ui-dicsigntheme/jquery-ui.css" rel="stylesheet"/>
    <script src="/jquery-ui-dicsigntheme/jquery-ui.js"></script>
    <script src="/jquery-ui-dicsigntheme/jquery-ui.min.js" ></script>    
    
    <link href="/jquery-ui-dicsigntheme/jquery-ui.min.css" rel="stylesheet"/>
    <link href="/jquery-ui-dicsigntheme/jquery-ui.structure.css" rel="stylesheet"/>
    <link href="/jquery-ui-dicsigntheme/jquery-ui.structure.min.css" rel="stylesheet"/>
    <link href="/jquery-ui-dicsigntheme/jquery-ui.theme.css" rel="stylesheet"/>
    <link href="/jquery-ui-dicsigntheme/jquery-ui.theme.min.css" rel="stylesheet"/>
    <link href="/jquery-ui-dicsigntheme/jquery-ui.min.css" rel="stylesheet"/>  
        
    <script>
        var requisitar = function (address, target){
            $.ajax({
                type: "POST",
                url: address,//data: dados,
                success: function( data ){
                   $( target ).html(data);
                },
                beforeSend: function(){},
                complete: function(){}
            });
        };
        
        var getUrlVars = function () {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) 
            {
                vars[key] = value;
            });
            return vars;
        };

    </script>
        
        
        
        <script>
            var app = angular.module('myApp', []);
            app.controller('textoCtrl', function($scope, $http) {
                $scope.pegar = function (){
                    $("div#traducao").css("background-image", "url('/img/icons/reload.GIF')");

                    $http.get("/Textos/query/" + $scope.q).success(function (response) {
                        document.getElementById("traducao").innerHTML = response;
                        $("div#traducao").css("background-image", "none");
                    });
                };
            });
        </script>
        
        
    </head>
    <body>
        <header>
            <div id="logobar" class=""> <div id="logotipo"><img src="/img/logos/LOGO-UFPA.png" width="164" height="60"></div></div>
            <div id="appname">
                <nav>
                    <a href="/" >Principal</a>
                    <a href="/Textos" >Adicionar</a>
                    <a href="/Textos/edicao" >editar</a>
                    <a href="/Administrators/logout" >sair</a>
                </nav><h5 class="adm">dicSign - Administrador</h5> 
            </div>
            
        </header>
        
        <?php echo $this->fetch('content'); ?>
      
        
        <div id="dialog-form" title="Add imagem correspondente">            
            <form action="/Textos/editlibra" method="POST" name="adm" id="addadm" enctype="multipart/form-data">
                <div>
                    <h3>Add imagens aqui!!</h3>
                    <output id="preview"></output><br>
                    <input id="libraid" type="hidden" name="data[Libra][id]" value="">

                    <span id="orient"></span>
                    <input type="file" name="data[Libra][animacao]" id="imgsimbol" accept="" />
                    
                    <br>
                </div>
                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="" value="Mandar" class="button-primary">
            </form>
          </div>
        <div id="dialog-message" title="Mensagem dicSign">
            <p id="mensagem"></p>
        </div>
            <script>
                function handleFileSelect1(evt) {
                   // alert(evt.target.files);
                  var files = evt.target.files; // FileList object

                  // Loop through the FileList and render image files as thumbnails.
                  for (var i = 0, f; f = files[i]; i++) {

                    // Only process image files.
                    if (!f.type.match('image.*')) {
                      continue;
                    }

                    var reader = new FileReader();

                    // Closure to capture the file information.
                    reader.onload = (function(theFile) {
                      return function(e) {
                        // Render thumbnail.
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                          '" title="', escape(theFile.name), '" width=164 height=164/>'].join('');
                        document.getElementById('preview').innerHTML = span.innerHTML;
                        //alert();
                      };
                    })(f);

                    // Read in the image file as a data URL.
                    reader.readAsDataURL(f);
                  }
                }

               
                document.getElementById('imgsimbol').addEventListener('change', handleFileSelect1, false);
                //document.getElementById('imganime').addEventListener('change', handleFileSelect2, false);
              </script>
        <footer class="adm">
            <div id="info" class="">
                <div class="menubaixo"><a href="javascript:;" >Sobre</a></div>                
                <div class="menubaixo"><a href="javascript:;" >Contatos</a></div>
                <div class="espaco"> Copyrigth &COPY; 2015 DicSign. Todos os direitos reservados.</div>
                <div class="" id='logoinfer'>
                    <a href="http://www.geira.com.br/ICPEE/" ><img src="/img/logos/logo_geira.png" width="75" height="45"></a>
                     <a href="http://www.proeg.ufpa.br" ><img src="/img/logos/LOGO-PROEG.png" width="100" height="48"></a>
                </div>
            </div>
        </footer>
    </body>
</html>
