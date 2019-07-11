<!DOCTYPE html>
<html>
    <head >
         
        <!-- Basic Page Needs
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        
        <title>TradSign - GEIRA</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– 
        <link href='http://fonts.googleapis.com/css?family=Handlee:400,300,600' rel='stylesheet' type='text/css'>
         -->

        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

        <!-- CSS
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/skeleton.css">
        <link rel="stylesheet" href="/css/style.css">




        <!-- ========================================================================== -->

        <!-- INICIA NOVOS CSS BOOTSTRAP -->
        <link rel="stylesheet" href="/css/popup/bootstrap.css"/>
        <link rel="stylesheet" href="/css/popup/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/popup/bootstrap-theme.css"/>
        <link rel="stylesheet" href="/css/popup/bootstrap-theme.min.css"/>
        <!-- FIM dos novos bootstrap -->

        <!-- ========================================================================== -->




        <!--<link rel="stylesheet" href="/css/slider.css">
        <link rel="stylesheet" href="css/verBordas.css"> -->

        <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="icon" type="image/png" href="/img/logos/dicsign.png">
        
        
        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/listen.js"></script>
        <script src="/js/angular.min.js"></script>
        <script src="/js/anime.js"></script>




        <!-- ================================================================================================ -->

        <!-- INICIO NOVOS JS YOUTUBE + BOOTSTRAP -->
        <script src="/js/popup/bootstrap.js"></script>
        <script src="/js/popup/bootstrap.min.js"></script>
        <script src="/js/popup/npm.js"></script>
        <script src="/js/popup/popup/bootstrap.youtubepopup.js"></script>
        <script src="/js/popup/bootstrap.youtubepopup.min.js"></script>

        <script type="text/javascript">
            $(function () {
                $(".youtube").YouTubeModal({autoplay:1, width:640, height:480, response:1}).click();
            });
        </script>
        <!-- FIM de novos js -->

        <!-- ================================================================================================ -->



        <!-- <script type="text/javascript" src="/js/jquery.xuSlider.js"></script> -->
        <link rel="stylesheet" href="/css/slides.css">
        <!--  Efeito de slide de fotos 
        <link rel="stylesheet" href="/css/slider_1.css">
        <script src="/js/slider.js"></script> -->
        
        <script>
        function myFunction() {
            var txt;
            var r = confirm("Press a button!");
            if (r === true) {
                txt = "You pressed OK!";
            } else {
                txt = "You pressed Cancel!";
            }
            document.getElementById("demo").innerHTML = txt;
        }
        
        var legendar = function(){
            var imagem = document.querySelector("#traducao img");
            if(imagem){
                var legenda = imagem.getAttribute("alt");
                if(legenda !== "1/ 1"){
                    document.querySelector("#traducao figcaption").innerHTML = legenda;
                    
                }
            }
        };
        var animationExists = function (){
            var ob = document.querySelector("#traducao .ativo");
            var ele = ob.querySelector(".animacao");
            if(ele){
                //alert('existe');
                document.getElementById("verlibras").style.display = "block";
            }else{
                document.getElementById("verlibras").style.display = "none";
            }
        };
        
        
        </script>
        
        <script>
            var app = angular.module('myApp', []);
            app.controller('textoCtrl', function($scope, $http) {
                $scope.quantImg = 0;
                $scope.anterior = "";
                $scope.intervalo = window.setInterval(function(){                    
                    $scope.q = $("textarea#frase").val().trim(); //pega o que tá lá
                    console.log("loop: q= " + $scope.q + " anterior = " + $scope.anterior); 
					
                    if($scope.q !== "" && $scope.anterior !== $scope.q){ // tem coisa escrita? então manda requisição
                        console.log("if: q= " + $scope.q + " anterior = " + $scope.anterior); 
                        
                        $http.get("/Textos/query/" + $scope.q).success(function (response) {
                            if(response !== ""){ //tem resposta? se tiver imprime
                                document.getElementById("slider").innerHTML = response;
                                legendar();
                                animationExists();
                                $("div#traducao").css("background-image", "none");
                                
                                $scope.resposta = response;
                                
                            }else {
                                //alert('nada na resposta por isso será marcado como sem resposta');
				document.querySelector("#traducao figcaption").innerHTML = "";				
                                $("div#dicionario").html("Ops! Esta Palavra Não está Cadastrada. Entre em contato com a equipe de desenvolvimento do DicSign.");
                                
                                document.getElementById("slider").innerHTML = response;
                                $("div#traducao").css("background-image", "none");
                            }
                            $scope.anterior = $scope.q;
                        });
                        
                        $http.get("/Textos/queryJSON/" + $scope.q).success(function (response) {
                            $("div#dicionario").html("");
                            //document.querySelector("#traducao figcaption").innerHTML = "";				
                            //alert(response.result.length);
                            if(response !== ""){
                                $scope.quantSign = response.result.length;
                                $scope.id = response.result[0].textos.id;
                                $scope.conceito = response.result[0].textos.conceito;
                                $scope.expressao = response.result[0].textos.expressao;
                                $scope.classe = response.result[0].textos.classe;
                                $scope.regioes = response.result[0].libras.regioes;
                                
                                //$scope.signwrite = "aaa"+response.result[0].libras.signwrite;
                                $scope.url = "/Textos/ouvir?q="+ $scope.expressao + ": " + $scope.conceito;
                                
                                if($scope.quantSign > 1){
                                    //alert($scope.regioes);
                                    //document.querySelector("div#traducao figure span.trs.prev").style.display = "block";
                                    document.querySelector("div#traducao  span.next").style.display = "block";
                                    
                                    //document.querySelector("div#traducao figure span.trs.prev").style.opacity = 1;
                                    document.querySelector("div#traducao  span.next").style.opacity = 1;
                                    
                                }else if($scope.quantSign <= 1){
                                    document.querySelector("div#traducao span.prev").style.display = "none";
                                    document.querySelector("div#traducao span.next").style.display = "none";
                                }

                                $("div#dicionario").html("<i> " + $scope.classe + " - </i>" +  $scope.conceito);

                            }else{
                                document.querySelector("div#traducao span.prev").style.display = "none";
                                    document.querySelector("div#traducao span.next").style.display = "none";
                                $("div#dicionario").html("Ops! Esta Palavra Não está Cadastrada. Entre em contato com a equipe de desenvolvimento do DicSign.");
                            }
                        });

                    }else if($scope.q === ""){
                        document.getElementById("verlibras").style.display = "none";                        
                        document.querySelector("#traducao figcaption").innerHTML = "";                        
                        document.getElementById("slider").innerHTML = "";
                        $("div#dicionario").html("");
                        //alert('não tem nada escrito ou é a mesma coisa que tava antes e foi marcado como sem-resposta');
                        //document.getElementById("slider").innerHTML = "";
                        $("div#traducao").css("background-image", "none");
                    }else{
                        //$scope.resposta = "";
                        //alert('não tem nada escrito ou é a mesma coisa que tava antes e foi marcado como sem-resposta');
                        //document.getElementById("slider").innerHTML = "";
                        $("div#traducao").css("background-image", "none");
                    }
                    
                },2500);
                
                //clearInterval($scope.intervalo);
                
				
                $scope.pegar = function (event){
                    var key = event.which || event.keyCode;  
                    if(key >= 65 && key <= 90 ){
                        $("div#traducao").css("background-image", "url(/img/icons/reload.GIF)");
                    }
                    if(key === 45 ){
                        window.location.assign("/Textos/edicao");
                    }				
	    			
                    if (key === 13 || key === 13) {
                        $http.get("/Textos/query/" + $scope.q).success(function (response) {
                            document.getElementById("slider").innerHTML = response;
                            $("div#traducao").css("background-image", "none");
                        });
                    }

                  /* $http.get("/Textos/query/" + $scope.q).success(function (response) {
                        document.getElementById("slider").innerHTML = response;
                        $("div#traducao").css("background-image", "none");
                    });*/
                    
                    /*
                    $http.get("/Textos/queryJSON/" + $scope.q).success(function (response) {
                       
                        $("div#dicionario").html("");
                        
                        if(response.result.length > 0){
                            $scope.quantSign = response.result.length;
                            $scope.conceito = response.result[0].textos.conceito;
                            $scope.expressao = response.result[0].textos.expressao;
                            $scope.url = "/Textos/ouvir?q="+ $scope.expressao 
                                    + ": " + $scope.conceito;
                            
                            $("div#dicionario").html("<b>Conceito: </b>" +  $scope.conceito);
                            //$("div#audio").html("<audio autoplay=true><source src='" 
                                   // + decodeURI(decodeURI($scope.url)) + "' type='audio/mpeg'></audio>");                        
                       
                        }else{
                        }
                    });*/
                };
            });
        </script>
       
        
		
        <script>
            var enviarForm  = function (dados){
                $.ajax({
                    type: "post",
                    url: "/Textos/query",
                    data: dados,
                    success: function( data ){                
                        $("div#slider").html(data);
                        var frase = $( "form#pesquisa textarea#frase" ).val();
                        //$("div#audio").html("<audio autoplay=true><source src='/Textos/ouvir?q="+ frase +"' type='audio/mpeg'></audio>");                        
                    },
                    beforeSend: function(){
                        $("div#slider").css("background-image", "url('/img/icons/reload.GIF')");
                    },
                    complete: function(){
                        $("div#slider").css("background-image", "none");
                    }
                });
				
                $.ajax({
                    type: "post",
                    url: "/Textos/queryJSON",
                    data: dados,
                    success: function( response ){  
                        $("div#dicionario").html("Ops! Esta Palavra Não está Cadastrada. Entre em contato com a equipe de desenvolvimento do DicSign.");
                        //alert(response.result[0].textos.conceito);
                        if(response !== ""){
                            var quantSign = response.result.length;
                            var conceito = response.result[0].textos.conceito;
                            var expressao = response.result[0].textos.expressao;
                            var classe = response.result[0].textos.classe;

                            $("div#dicionario").html("<i> " + classe + " - </i>" +  conceito + ". (" + quantSign + " sign.)");

                        }else{
                            $("div#dicionario").html("Ops! Esta Palavra Não está Cadastrada. Entre em contato com a equipe de desenvolvimento do DicSign.");
                        }
                    },
                    beforeSend: function(){
                        $("div#slider").css("background-image", "url('/img/icons/reload.GIF')");
                    },
                    complete: function(){
                        $("div#slider").css("background-image", "none");
                    }
                });
            };	
        </script>
        
        <script>
        $(document).ready(function(){    
            // =============== rastreador IHC =============================
            /*
            
            $("*").addClass("listen");
            $("body").on("click",".listen",function(e){
                //e.preventDefault();
                var d = new Date();
                
                var parent = $(this);
                //parent.addClass("aaaaaaaaa");
                
                var tempo =  d.getHours() + ": " + d.getMinutes() + ": " + d.getSeconds();
                    if(parent.attr("id"))
                var id = parent.attr("id");
                    if(parent.val())
                var valor = parent.val();
                    if(parent.attr("href"))
                var link = parent.attr("href");
                    if(parent.attr("src"))
                var end = parent.attr("src");
                /*
                console.log(d.getMinutes() + ": " + d.getSeconds());
                if(parent.attr("id"))
                console.log(" #"+ parent.attr("id"));
                if(parent.val())
                console.log("\nvalue=" + parent.val());
                if(parent.attr("href"))
                console.log("\nlink=" + parent.attr("href"));
                if(parent.attr("src"))
                console.log("\nimg src=" + parent.attr("src"));
            
                var dados = [
                    {"tempo":tempo, "id":id, "valor":valor, "link":link, "end":end}
                ];
            
            
                $.post("/Home/rastrear",
                    {dados},
                    function(data, status){
                        console.log("Data: " + data + "\nStatus: " + status);
                    });
                
                });
            
            
            */
            // =============== FIM rastreador IHC =============================
            
            
            
            
            
            
            $( "form#pesquisa" ).submit(function( event ) {
                
                event.preventDefault();
                var dados = $( this ).serialize();
                enviarForm(dados);
                
            });
            
            $( "a#ouvir" ).click(function( event ) {
                var frase = $( "form#pesquisa textarea#frase" ).val();
                //$.post("/Textos/ouvir",{
                  //  data: {"expressao":frase}
                //},
                //function(data, status){
                var url = "/Textos/ouvir?q="+ frase;
                    $("div#audio").html("<audio autoplay=true><source src='"+ url +"' type='audio/mpeg'></audio>");
                    //alert("Data: " + data + "\nStatus: " + status);
                //});
            });
        
            
            $("section").on("click","#verlibras.diminuir",function(){
                $(".animacao").addClass("hidden");	
                $(this).val("Mostrar Libras");

                $(this).removeClass("diminuir");
                $(this).addClass("aumentar");
                $("div#traducao figure").removeClass("expandido");
                $("div#traducao figure").addClass("encolhido");
            });
            $("section").on("click","#verlibras.aumentar",function(){
                $(".animacao").removeClass("hidden");	
                $(this).val("Ocultar Libras");

                $(this).removeClass("aumentar");
                $(this).addClass("diminuir");
                $("div#traducao figure").removeClass("encolhido");
                $("div#traducao figure").addClass("expandido");
            });
            /*/
            $( "form#pesquisa textarea" ).keydown(function() {
                var query = $(this).val();
                /*
                $.post(
                "/Textos/query",
                {
                    expressao: $(this).val()
                }, function( data, status ){
                    $("div#traducao").html("");
                
                   $("div#traducao").html(data);
                   

                });*/
        /*
                if(query.length > 0){
                    $.ajax({ 
                        type: "post",
                        url: "/Textos/query/" + query,
                        success: function(data) {
                            $("div#traducao").html("");

                           $("div#traducao").html(data);
                        },
                        beforeSend: function(){

                        },
                        complete: function(){

                        }          
                    });
                }
            });
            */
            
        });
        </script>
        
    </head>
    <body>
        <header>
            <div id="logobar" class="">
                <div id="logotipo">
                    <img src="/img/logos/LOGO-UFPA.png" width="180" height="60">
                    <a href="http://goo.gl/forms/YjCHkP1K2ml1moof1" target="_blank">
                        <button id="btn">FORMULÁRIO</button>
                    </a>
                    <a>
                        <button id="btn"  class="youtube" rel="Z39fob-ZwmY">VER O VÍDEO</button>
                    </a>
                </div>
            </div>
            <div id="appname">
                <h6>Tradutor de SignWriting - TradSign</h6>
                <div class="" id='bandeiras'>
                    <a href="?lg=pt_br" ><img src="/img/logos/Bandeira_Brasil.png" width="25" height="15"></a>
                    <a href="?lg=es" ><img src="/img/logos/Bandeira_Espanha.png" width="25" height="15"></a>
                    <a href="?lg=en" ><img src="/img/logos/bandeira-do-reino-unido.png" width="25" height="15"></a>
                </div> 
            </div>
        </header>
        
        <?php echo $this->fetch('content'); ?>
      
        
        <footer class="">
          
            <div id="info" class="">
                <div class="menubaixo"><a href="/Sobre/index" >Sobre</a></div>                
                <div class="menubaixo"><a href="javascript:;" >Contatos</a></div>
                <div class="espaco"> Copyrigth &COPY; 2015 TradSign. Todos os direitos reservados.</div>
                <div class="" id='logoinfer'>                    
                    <a href="http://www.geira.com.br/ICPEE/" ><img src="/img/logos/logo_geira.png" width="70" height="50"></a>
                    <a href="http://www.proeg.ufpa.br" ><img src="/img/logos/LOGO-PROEG.png" width="100" height="50"></a>
                </div>
            </div>
        </footer>
    </body>
</html>
