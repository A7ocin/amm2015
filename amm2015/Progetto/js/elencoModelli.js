/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $(".error").hide();
    $("#tabella_modelli").hide();
    
    $('#filtra').click(function(e){
        // impedisco il submit	<-------------------------------------
        //e.preventDefault(); 
        /*var _insegnamento = $( "#insegnamento option:selected" ).attr('value');
        if(_insegnamento === 'qualsiasi'){
            _insegnamento = '';
        }*/
        var _uploader = $("#uploader").val();
        var _nome = $("#nome").val();
        //var _matricola = $("#matricola").val();
        
        var par = {
            //insegnamento : _insegnamento,
            //cognome:_cognome,
            //matricola: _matricola
            uploader: _uploader,
            nome: _nome
        };
        $.ajax({
            url: 'administrator/filtra_modelli',
            data : par,
            dataType: 'json',
            success: function (data, state) {
                if(data['errori'].length === 0){
                    // nessun errore
                    $(".error").hide();
                    if(data['models'].length === 0){
                        // mostro il messaggio per nessun elemento
                        $("#nessuno").show();
                       
                        // nascondo la tabella
                        $("#tabella_modelli").hide();
                    }else{
                        // nascondo il messaggio per nessun elemento
                        $("#nessuno").hide();
                        $("#tabella_modelli").show();
                        //cancello tutti gli elementi dalla tabella
                        $("#tabella_modelli tbody").empty();
                       
                        // aggiungo le righe
                        var i = 0;
                        for(var key in data['models']){
                            var model = data['models'][key];
                            $("#tabella_modelli tbody").append(
                                "<tr id=\"row_" + i + "\" >\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                 </tr>");
                            if(i%2 == 0){
                                $("#row_" + i).addClass("alt-row");
                            }
                            
                            var colonne = $("#row_"+ i +" td");
                            $(colonne[0]).text(model['id']);
                            $(colonne[1]).text(model['data']);
                            $(colonne[2]).text(model['dimensione']);
                            $(colonne[3]).text(model['nome']);
                            $(colonne[4]).text(model['uploader']);
                            $(colonne[5]).text(model['descrizione']);
                            i++;
                            
                           
                        }
                    }
                }else{
                    $(".error").show();
                    $(".error ul").empty();
                    for(var k in data['errori']){
                        $(".error ul").append("<li>"+ data['errori'][k] + "<\li>");
                    }
                }
               
            },
            error: function (data, state) {
            }
        
        });
        
    })
});
