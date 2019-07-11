<section class="container" ng-app="myApp" ng-controller="textoCtrl">            
    <div class="row">
        <div class="six columns" class="texto">
            <form action="" method="POST" id="pesquisa" name="pesquisa">
                <h4>Palavra</h4>
                <textarea name="data[expressao]" ng-keyup="pegar($event)" ng-model="q" class="u-full-width" placeholder="Digite a Palavra a ser Traduzida para o SignWriting" id="frase" autofocus="true" ></textarea>
                <input class="button-primary " type="submit" value="Traduzir">
            </form>
            <a href="javascript:;" id="falar" title="Utilize este microfone para falar uma palavra a ser traduzida." onclick="falar()"></a>
            <!-- <a href="javascript:;" id="ouvir" title="clique para ouvir"></a> -->
        </div>                
        <div class="six columns" class="traducao">
            <h4>SignWriting</h4>
            <div id="traducao"  >
                <figure >
                    <span class="trs next"></span>
                    <span class="trs prev"></span>
                    
                    <div id="slider" >
                       <a href="#" class="trs"><img src="" alt="" /></a> <!-- necessário para iniciar o script -->
                        <!--
                       <a href="#" class="trs"><img src="/img/sliders2.jpg" alt="Legenda da imagem 2" /></a>
                       <a href="#" class="trs"><img src="/img/sliders3.jpg" alt="Legenda da imagem 3" /></a>
                        -->
                    </div>
                    <figcaption></figcaption>
                 </figure>
                <script>
                    window.addEventListener("load",setaImagem,false);
                </script>
                <div id="dicionario" class='aumentar'></div>
            </div>
            <!--<div id="verlibras" class='aumentar ico' style='cursor: pointer;'> Mostrar Libras</div> -->                       
            <input id="verlibras" class="button-primary aumentar ico" type="button" value="Mostrar Libras" style="display: none;">
        </div>
            <div id="audio"></div>
    </div>
</section>    

  
<script type="text/javascript">
    var recognizer;
    (function(){
        // Test browser support
        window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition || null;

            //caso não suporte esta API DE VOZ                              
            if (window.SpeechRecognition === null || recognizer === null ) {
                document.getElementById('falar').style.display('none');
            }else {
                recognizer = new window.SpeechRecognition();
                
                var transcription = document.forms["pesquisa"]["data[expressao]"];
                //Para o reconhecedor de voz, não parar de ouvir, mesmo que tenha pausas no usuario
                recognizer.continuous = false;
                recognizer.onresult = function(event){
                    transcription.value = "";
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        if(event.results[i].isFinal){
                            transcription.value += event.results[i][0].transcript;//+' (Taxa de acerto [0/1] : ' + event.results[i][0].confidence + ')';
                        }else{
                            transcription.value += event.results[i][0].transcript;
                        }
                    }
                };
            }
    })();

    function falar(){
        try {
            recognizer.start();
        } catch(ex) {
            alert("error: Função disponível apenas no navegador Chrome. " + ex.message);
        }
    };
</script>
