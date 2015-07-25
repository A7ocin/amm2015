
$(document).ready(function () {
    
    $(".error").hide();
    $("#tabella_modelli").hide();
    
    $('#filtra').click(function(e){
        // prevent submit
        e.preventDefault(); 
        var _uploader = $("#uploader").val();
        var _nome = $("#nome").val();
        
        var par = {
            uploader: _uploader,
            nome: _nome
        };
        $.ajax({
            url: 'administrator/filtra_modelli',
            data : par,
            dataType: 'json',
            success: function (data, state) {
                    if(data['models'].length === 0){
                        $("#tabella_modelli").hide();
                    }else{
                        $("#tabella_modelli").show();
                        //delete all the table entries
                        $("#tabella_modelli tbody").empty();
                       
                        // add rows
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
            },
            error: function (data, state) {
            }
        
        });
        
    })
});
