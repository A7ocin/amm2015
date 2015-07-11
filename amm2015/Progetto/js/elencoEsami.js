/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $(".error").hide();
    $("#tabella_esami").hide();
    
    $('#filtra').click(function(e){
        // impedisco il submit
        e.preventDefault(); 
        var _insegnamento = $( "#insegnamento option:selected" ).attr('value');
        if(_insegnamento === 'qualsiasi'){
            _insegnamento = '';
        }
        var _nome = $("#nome").val();
        var _cognome = $("#cognome").val();
        var _matricola = $("#matricola").val();
        
        var par = {
            insegnamento : _insegnamento,
            nome: _nome,
            cognome:_cognome,
            matricola: _matricola
        };
        $.ajax({
            url: 'docente/filtra_esami',
            data : par,
            dataType: 'json',
            success: function (data, state) {
                if(data['errori'].length === 0){
                    // nessun errore
                    $(".error").hide();
                    if(data['esami'].length === 0){
                        // mostro il messaggio per nessun elemento
                        $("#nessuno").show();
                       
                        // nascondo la tabella
                        $("#tabella_esami").hide();
                    }else{
                        // nascondo il messaggio per nessun elemento
                        $("#nessuno").hide();
                        $("#tabella_esami").show();
                        //cancello tutti gli elementi dalla tabella
                        $("#tabella_esami tbody").empty();
                       
                        // aggingo le righe
                        var i = 0;
                        for(var key in data['esami']){
                            var esame = data['esami'][key];
                            $("#tabella_esami tbody").append(
                                "<tr id=\"row_" + i + "\" >\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>\n\
                                          <ul class=\"none no-space\" id=\"com_"+ i + "\" >\n\
                                          </ul>\n\
                                       </td>\n\
                                 </tr>");
                            if(i%2 == 0){
                                $("#row_" + i).addClass("alt-row");
                            }
                            
                            var colonne = $("#row_"+ i +" td");
                            $(colonne[0]).text(esame['insegnamento']);
                            $(colonne[1]).text(esame['cfu']);
                            $(colonne[2]).text(esame['matricola']);
                            $(colonne[3]).text(esame['cognome'] + " " + esame['nome']);
                            $(colonne[4]).text(esame['voto']);
                            for(var mbr in esame["commissione"]){
                                
                                $("#com_" + i).append("<li>" + esame['commissione'][mbr]+ "</li>");
                            }
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
