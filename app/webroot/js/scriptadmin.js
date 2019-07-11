$(document).ready(function(){            
    $( "form#pesquisa" ).submit(function( event ) {



        event.preventDefault();
        var dados = $( this ).serialize();

        $.ajax({
            type: "post",
            url: "/Textos/query",
            data: dados,
            success: function( data ){                
                $("div#traducao").html(data);
                var frase = $( "form#pesquisa textarea#frase" ).val();
                $("div#audio").html("<audio autoplay=true><source src=/Textos/ouvir/"+ frase +" type='audio/mpeg'></audio>");                        
            },
            beforeSend: function(){
                $("div#traducao").css("background-image", "url('/img/icons/reload.GIF')");
            },
            complete: function(){
                $("div#traducao").css("background-image", "none");
            }
        });
    });

    $( "a#ouvir" ).click(function( event ) {
        var frase = $( "form#pesquisa textarea#frase" ).val();
        //$.post("/Textos/ouvir",{
          //  data: {"expressao":frase}
        //},
        //function(data, status){
            $("div#audio").html("<audio autoplay=true><source src=/Textos/ouvir/"+ frase +" type='audio/mpeg'></audio>");
            //alert("Data: " + data + "\nStatus: " + status);
        //});
    });

    $( "section").on("click","a#veranime" ,function( ) {
        $( "img#animacao" ).toggle();
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

   $(document).on("click", "a.excluirimg", function (evt){
       evt.preventDefault();
       var href = $(this).attr("href");
        $.get(href, function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            $( "#dialog-message" ).dialog("open");
            $( "#dialog-message p" ).text(data);
            requisitar("/Textos/search?expressao="+getUrlVars()['expressao'],"#resultado");

        });

   });


   function addUser() {


   }
   var dialog, form;
    dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 550,
        width: 550,
        modal: true,
        buttons: {
          //"Concluir adição": addUser,
          Cancel: function() {
            dialog.dialog( "close" );
          }
        },
        close: function() {
          form[0].reset();
          //allFields.removeClass( "ui-state-error" );
        }
      });

    $( "#dialog-message" ).dialog({
        autoOpen: false,
        modal: true,
        buttons: {
          Ok: function() {
            $( this ).dialog( "close" );
          }
        }
      });

    /*
    var flash = [''].join('');
    if(flash !== ''){
        $( "#dialog-message p" ).text(flash);
        $( "#dialog-message" ).dialog("open");    
    }
    */
      form = dialog.find( "form#addadm" ).on( "submit", function( event ) {
//                  return null;
        event.preventDefault();
        var dados = $( this ).serialize();
         var formData = new FormData(this);
        console.log(formData);

        //alert("");
        $.ajax({
            type: "POST",
            url: "/Textos/editlibra",
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            data: formData,
            success: function( data ){
               $( "#dialog-form" ).dialog("close");
               //$( "#dialog-message" ).dialog("open");
               //$( "#dialog-message p" ).text("Sua imagem foi adicionada com sucesso, por favor atualize a página novamente.");
               alert("Sua imagem foi adicionada com sucesso, por favor atualize a página novamente.");
                location.reload(true);
               //Your files have uploaded successfully.
            },
            beforeSend: function(){
                //$("form#comentarios div#comentariotexto textarea").val("");
               // listarComentarios();
            },
            complete: function(){
                //$("form#comentarios div#comentariotexto textarea").val("");
               // listarComentarios();
            }
        });
        //addUser();
      });

      $( document).on( "submit", "form#formtextoedit" ,function( event ) {
        event.preventDefault();
        //alert("oi");
        var action = $( this ).attr("action");
        var dados = $( this ).serialize();
        //alert("");
        $.ajax({
            type: "POST",
            url: action,
            data: dados,
            success: function( data ){

               $( "#dialog-message" ).dialog("open");
               $( "#dialog-message p" ).text("Texto editado com sucesso!");
               //alert("Sua imagem foi adicionada com sucesso, por favor atualize a página novamente.");

               //Your files have uploaded successfully.
            },
            beforeSend: function(){
                //$("form#comentarios div#comentariotexto textarea").val("");
               // listarComentarios();
            },
            complete: function(){
                //$("form#comentarios div#comentariotexto textarea").val("");
               // listarComentarios();
            }
        });
      });


    $( document).on( "", "" ,function( event ) {
        event.preventDefault();
        return ;
        var action = $( this ).attr("action");
        var dados = $( this ).serialize();

        $.ajax({
            type: "POST",
            url: action,
            data: dados,
            success: function( data ){
               //$( "#dialog-message" ).dialog("open");
               //$( "#dialog-message p" ).text("Texto editado com sucesso!");
               //alert("Sua imagem foi adicionada com sucesso, por favor atualize a página novamente.");

               //Your files have uploaded successfully.
            },
            beforeSend: function(){},
            complete: function(){}
        });
      });
      
      $(document).on("change", "input#imgsimboladd",function (){
          $("input#addimg").attr("disabled",false);
          
      });
      
      $(document).on("change", "input#imganimeadd",function (){
          $("input#addimg").attr("disabled",false);
          
      });


      $(document).on( "click",".addsign" ,function() {
          //alert($(this).val());
        //var librasid = 
        $("#libraid").val($(this).val());
        $("#imgsimbol").attr("name","data[Libra][signwrite]");        
        $("#imgsimbol").attr("accept","image/png");
        document.getElementById('listsign').innerHTML="";
        $("span#orient").text("São aceitas apenas imagens do tipo png 200 x 200)");

        dialog.dialog( "open" );
      });
      $(document).on( "click", ".addanime", function() {
          //alert($(this).val());
        //var librasid = 
        $("#libraid").val($(this).val());
        $("#imgsimbol").attr("name","data[Libra][animacao]");
        $("#imgsimbol").attr("accept","image/gif");
        document.getElementById('listsign').innerHTML="";
        $("span#orient").text("São aceitas apenas imagens do tipo gif 300 x 400");

        dialog.dialog( "open" );
      });

       dialog.dialog( "close" );


});
