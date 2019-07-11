function setaImagem(){
    var elemento;
    var settings = {
        
        animationExists: function (ob){
            var ele = ob.querySelector(".animacao");
            if(ele){
                //alert('existe');
                document.getElementById("verlibras").style.display = "block";
            }else{
                document.getElementById("verlibras").style.display = "none";
            }
        },
        
        primeiraImg: function(){
            elemento = document.querySelector("#traducao #slider a:last-child");
            elemento.classList.add("ativo");
            
            this.legenda(elemento);
            /*
            var prox = document.querySelector("#traducao .ativo").nextElementSibling;
            var prev = document.querySelector("#traducao .ativo").previousElementSibling;
            
            if(!(prox && prev)){
                document.querySelector("#traducao span").style.display = "none";
            }else{
                document.querySelector("#traducao span").style.display = "block";
            }*/
        },

        slide: function(){
            elemento = document.querySelector("#traducao .ativo");

            if(elemento.nextElementSibling){
                elemento.nextElementSibling.classList.add("ativo");
                settings.legenda(elemento.nextElementSibling);
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");
                settings.primeiraImg();
            }
        },

        proximo: function(){
            //clearInterval(intervalo);
            elemento = document.querySelector("#traducao .ativo");
            document.querySelector("#traducao span.prev").style.display = "block";
            document.querySelector("#traducao span.prev").style.opacity = 1;
            
            
            if(!elemento.nextElementSibling.nextElementSibling){
                document.querySelector("#traducao span.next").style.display = "none";
            }
            if(elemento.nextElementSibling){
                //document.querySelector("#traducao span.next").style.display = "block";
                settings.animationExists(elemento.nextElementSibling);
                
                elemento.nextElementSibling.classList.add("ativo");
                settings.legenda(elemento.nextElementSibling);
                elemento.classList.remove("ativo");
            }else{
                //document.querySelector("#traducao span.next").style.display = "none";
                document.querySelector("#traducao span.prev").style.display = "block";
                
                elemento.classList.remove("ativo");
                settings.primeiraImg();
            }

           // intervalo = setInterval(settings.slide,4000);
        },

        anterior: function(){
            // clearInterval(intervalo);
            elemento = document.querySelector("#traducao .ativo");
            document.querySelector("#traducao span.next").style.display = "block";
            document.querySelector("#traducao span.next").style.opacity = 1;
            
            
            if(!elemento.previousElementSibling.previousElementSibling){
                document.querySelector("#traducao span.prev").style.display = "none";
            }
            
             if(elemento.previousElementSibling){
                //document.querySelector("#traducao span.prev").style.display = "block";
                settings.animationExists(elemento.previousElementSibling);
                
                elemento.previousElementSibling.classList.add("ativo");
                settings.legenda(elemento.previousElementSibling);
                elemento.classList.remove("ativo");
             }else{
                document.querySelector("#traducao span.prev").style.display = "none";
                document.querySelector("#traducao span.next").style.display = "block";
                
                elemento.classList.remove("ativo");						
                elemento = document.querySelector("#traducao a:first-child");
                elemento.classList.add("ativo");
                settings.legenda(elemento);
             }
             //intervalo = setInterval(settings.slide,4000);
        },

        legenda: function(obj){
            var imagem = obj.querySelector("img");
            if(imagem){                
                var legenda = imagem.getAttribute("alt");
                document.querySelector("#traducao figcaption").innerHTML = legenda;
            }
        }

    };

    //chama o slide
    settings.primeiraImg();

    //chama a legenda
    settings.legenda(elemento);
    

    //chama o slide à um determinado tempo
    //var intervalo = setInterval(settings.slide,4000);
    //clearInterval(intervalo);
    document.querySelector("#traducao span.next").addEventListener("click",settings.proximo,false);
    document.querySelector("#traducao span.prev").addEventListener("click",settings.anterior,false);
}

//window.addEventListener("load",setaImagem,false);