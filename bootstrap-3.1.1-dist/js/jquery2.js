$(document).ready(function($){
 var straniceIspis = 7;   
$.ajax({
                
                url : 'stranicenje.json',
                dataType : 'json',
                data: { },
                success: function( jsondata ){
                    tabIspis = true;
                    straniceIspis = jsondata['stranica'];
                    
                    $('#ispisKorisnika').dataTable({

          //"aaSorting" : [[3, "asc"], [0, "desc"]]
          "bPaginate":true,
          "bFilter":true,
          "aLengthMenu": [[straniceIspis, straniceIspis*2, straniceIspis*3, straniceIspis*4 , -1], [straniceIspis, straniceIspis*2, straniceIspis*3, straniceIspis*4, "All"]],
            "iDisplayLength" : straniceIspis,
          open: function( event, ui ) {
        
     },
     close: function(event, ui ){
       
     }
          }); 

                }
            });

$.ajax({
                type:"POST",
                url:"dohvatneregistriranikorisnik.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    $('#ispisKorisnika1').dataTable().fnDestroy();
                    $('#ispisKorisnika1').remove();
                    
                    var tablica ="<div class='table-responsive'><table id='neregistriranKorisnik' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Popis kurirskih sluzbi</caption><thead><tr><th>Id sluzbe</th><th>Naziv službe</th><th>Kilometraza</th><th>Vrijeme dostave(h)</th><th>Id rute<th>Odrediste</th><th>Polaziste</th></tr></thead><tbody>"

                    for (var i =0;i<json.length;i++){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + json[i].id_kurirskasluzba + "</td>";
                            tablica += "<td>" + json[i].naziv + "</td>";
                            tablica += "<td>" + json[i].kilometraza + "</td>";
                            tablica += "<td>" + json[i].vrijemeDostava + "</td>";
                            tablica += "<td>" + json[i].id_ruta + "</td>";
                            tablica += "<td>" + json[i].odrediste + "</td>";
                            tablica += "<td>" + json[i].polaziste + "</td>";
                           
                            tablica += "</tr>";
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#popisSluzbi').append(tablica);
                    
                    $('#neregistriranKorisnik').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": false
                         } ); 
                    
                }
            });

});