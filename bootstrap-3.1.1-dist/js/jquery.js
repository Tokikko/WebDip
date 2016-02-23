$(document).ready(function($){
 if ($.cookie("css")) {
            $("link").attr("href", $.cookie("css"));
        }
    var found = true;


	$('#registracija_korisnickoime').focusout(function(event){
        var provjera = $('#registracija_korisnickoime').val();
        var pronadeno = false;
         $.ajax({
                type : 'POST',
                url : 'avalible.php',
                dataType : 'json',
                data: { },
                success: function( jsondata ){
                    for (var i = 0; i < jsondata.length;i++){
                        
                        if(provjera === jsondata[i]){
                            
                            $('#registracija_korisnickoime').css("background-color", "red");
                            found = false;
                          
                        }
                        else{
                            found = true;
                        }
                        

                    }

                   

                }
            });

         if (found){
            $('#registracija_korisnickoime').css("background-color", "white");
         }
         found = false;
    });
var straniceIspis = 12;

$.ajax({
                
                url : '../stranicenje.json',
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
                
                url : 'stranicenje.json',
                dataType : 'json',
                data: { },
                success: function( jsondata ){
                    tabIspis = true;
                    straniceIspis = jsondata['stranica'];
                    
                    $('#ispisKorisnika111').dataTable({

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
                url:"ajaxzakljucajotkljucaj.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    $('#ispisKorisnika1').dataTable().fnDestroy();
                    $('#ispisKorisnika1').remove();
                    
                    var tablica ="<div class='table-responsive'><table id='ispisKorisnika1' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Korisnici</caption><thead><tr><th>Korisničko ime</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Sifra<th>Status</th><th>Tip korisnika</th><th>Klik</th></th></tr></thead><tbody>"

                    for (var i =0;i<json.length;i++){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + json[i].korisnickoIme + "</td>";
                            tablica += "<td>" + json[i].ime + "</td>";
                            tablica += "<td>" + json[i].prezime + "</td>";
                            tablica += "<td>" + json[i].email + "</td>";
                            tablica += "<td>" + json[i].sifra + "</td>";
                            tablica += "<td>" + json[i].statuss + "</td>";
                            tablica += "<td>" + json[i].tipKorisnika + "</td>";
                            if(json[i].statuss ==1){
                              tablica += "<td>" + "<button class='btn btn-success' data-email="+json[i].email + " data-status=" +json[i].statuss +">Otkljucaj</button>" + "</td>";
                                      }
                            else{
                              tablica += "<td>" + "<button class='btn btn-danger' data-email="+json[i].email + " data-status=" +json[i].statuss + ">Zakljucaj</button>" + "</td>";
                                      }
                            tablica += "</tr>";
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#tablicaMjesto').append(tablica);
                    
                    $('#ispisKorisnika1').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": false
                         } ); 
                    
                }
            }); 
        
$('#ispisKorisnika232').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": false
                         } ); 

$("#nav li a").click(function() { 
  
    $("link").attr("href",$(this).attr('rel'));
    $.cookie("css", $(this).attr('rel'), { expires: 365, path: '/' });
    return false;
  });

 $( "#datepicker" ).datepicker();
  $( "#datepicker1" ).datepicker();

  $("body").on("click","#ispisKorisnika1 > tbody > tr > td > button",function(evt){
        var email =$(this).attr('data-email');
     
       var status = $(this).attr('data-status');
   
       
       
       //$('#div_spremanje').remove();
        // $('#promjene').append("<div id='div_spremanje' class='table-responsive'></div>");

            $.ajax({
                type:"POST",
                url:"ajaxotkljucaj.php",
                dataType:"json",
                data : 
                    {
                     'email' : email, 
                     'status' : status,
                     
                     },
                success:function(json){
                  
                    $('#ispisKorisnika1').dataTable().fnDestroy();
                    $('#ispisKorisnika1').remove();
                   
                    var tablica ="<div class='table-responsive'><table id='ispisKorisnika1' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Korisnici</caption><thead><tr><th>Korisničko ime</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Sifra<th>Status</th><th>Tip korisnika</th><th>Klik</th></th></tr></thead><tbody>"

                    for (var i =0;i<json.length;i++){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + json[i].korisnickoIme + "</td>";
                            tablica += "<td>" + json[i].ime + "</td>";
                            tablica += "<td>" + json[i].prezime + "</td>";
                            tablica += "<td>" + json[i].email + "</td>";
                            tablica += "<td>" + json[i].sifra + "</td>";
                            tablica += "<td>" + json[i].statuss + "</td>";
                            tablica += "<td>" + json[i].tipKorisnika + "</td>";
                            if(json[i].statuss ==1){
                              tablica += "<td>" + "<button class='btn btn-success' data-email="+json[i].email + " data-status=" +json[i].statuss +">Otkljucaj</button>" + "</td>";
                                      }
                            else{
                              tablica += "<td>" + "<button class='btn btn-danger' data-email="+json[i].email + " data-status=" +json[i].statuss + ">Zakljucaj</button>" + "</td>";
                                      }
                            tablica += "</tr>";
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#tablicaMjesto').append(tablica);
                    
                    $('#ispisKorisnika1').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": false
                         } ); 
                    
                }
            }); //ajax
    });

  $("body").on("click","#ispisKorisnika111 > tbody > tr > th > button",function(evt){
     
     var ajaxId =$(this).attr('data-id');
     var ajaxTablica = $(this).attr('data-tablica');
   
      
       
       //$('#div_spremanje').remove();
        // $('#promjene').append("<div id='div_spremanje' class='table-responsive'></div>");

            $.ajax({
                type:"POST",
                url:"ispisforma.php",
                dataType:"json",
                data : 
                    {
                     'id' : ajaxId, 
                     'tablica' : ajaxTablica,
                     
                     },
                success:function(json){
                    
                    $('#ispisKorisnika111').dataTable().fnDestroy();
                    $('#ispisKorisnika111').remove();
                   // var uzmiMe = json[0];
                    var forma = "<form role='form' id='crudforma' name='crudforma' class='form-horizontal' novalidate action='crud.php' method='POST'"+
                            "<div class='form-group'>";
                      for(var x=0;x<json.length;x++){
                      var obj = json[x];
                        for(var key in obj){
                            var attrName = key;
                            var attrValue = obj[key];
                             forma += "<label for = "+key +" class = 'col-lg-4 control-label'>"+ key +"</label>" + "<div  class = 'col-lg-8'><input name="+key+" class = form-control type='text' value="+obj[key]+"></input></div><br>";
                        }
                  }       
                    forma += "<input name=imeTablica  type='text' value="+ajaxTablica +" hidden>";

                    forma += "<br><button type='submit' id = 'btnCRUD'  name='btnCRUD' class='btn btn-success' data-table="+ajaxTablica+" data-id="+ajaxId+">Submit</button>";
                    forma += "</div></form>";
                    
                    $('#tablicaAdministracija').append(forma);
                    
                    
                    
                }
            }); //ajax
    });
var a = "";
$.ajax({
                type:"POST",
                url:"dohvatipostarsluzba.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var a = "<select id=selectPostar name=selectPostar>";
                    
                    for (var i =0;i<json.length;i++){
                      if(i%2 == 0)
                            a += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    } 
                  a += "</select><br/>";
                  $('#postar').append(a); 
                }
               
            }); 

$.ajax({
                type:"POST",
                url:"dohvatisluzbapostar.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                 
                    var b = "<select id=selectSluzba name=selectSluzba>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 == 0)
                            b += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    } 
                  b += "</select><br/>";
                  $('#sluzba').append(b); 
                }
               
            });

     
/*$.ajax({
                type:"POST",
                url:"dohvatneregistriranikorisnik.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    $('#ispisKorisnika1').dataTable().fnDestroy();
                    $('#ispisKorisnika1').remove();
                    
                    var tablica ="<div class='table-responsive'><table id='neregistriranKorisnik' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Popis kurirskih službi</caption><thead><tr><th>Id službe</th><th>Naziv službe</th><th>Kilometraza</th><th>Vrijeme dostave(h)</th><th>Id rute<th>Odredište</th><th>Polazište</th></tr></thead><tbody>"

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
            }); */

$.ajax({
                type:"POST",
                url:"odredistepolaziste.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-5>";
                    op += "<select class = col-lg-5 id=selectPolaziste name=selectPolaziste>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 == 0)
                            op += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#polaziste').append(op); 
                }
               
            });

$.ajax({
                type:"POST",
                url:"odredistepolaziste.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-5>";
                     op += "<select class = col-lg-5  id=selectOdrediste name=selectOdrediste>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 == 0)
                            op += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#odrediste').append(op); 
                }
               
            });

$.ajax({
                type:"POST",
                url:"preuzmitip.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-5>";
                     op += "<select class = col-lg-5  id=selectTip name=selectTip>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 == 0)
                            op += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#tipdostave').append(op); 
                }
               
            });

$.ajax({
                type:"POST",
                url:"preuzmisluzba.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-5>";
                     op += "<select class = col-lg-5  id=selectSluzba name=selectSluzba>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 == 0)
                            op += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#kurirskasluzba').append(op); 
                }
               
            });


$.ajax({
                type:"POST",
                url:"nadirutu.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-5>";
                    op += "<select class = col-lg-5 id=selectRuta name=selectRuta>";
                    
                    for (var i =0;i<json.length;i++){
                        
                        op += "<option value=" +json[i] +">"+json[i] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#ruta').append(op); 
                }
               
            });

$('#trkorisnickoime').focusout(function(event){
        var provjera = $('#trkorisnickoime').val();
         $('span').remove();
        // $('#trazikorisnickoprezime').remove();
         //$('#trazikorisnickograd').remove();
         //$('#trazikorisnickoadresa').remove();
        
         $.ajax({
                type : 'POST',
                url : 'avalible2.php',
                dataType : 'json',
                data: {
                  'korinickoime' : provjera,
                 },
                success: function( jsondata ){
                  $('#trkorisnickoime').css("background-color", "grey");
                  var popuni = "<span><div class = form-group ><label for = trazikorisnickoime class = col-lg-4 control-label>Ime:</label><div  class = col-lg-8>";
                  popuni += "<input type = text class = form-control id =trazikorisnickoime name =trazikorisnickoime  value =" +jsondata[0]+ "></div></div>";
                  popuni += "<div class = form-group ><label for = trazikorisnickoprezime class = col-lg-4 control-label>Prezime:</label><div  class = col-lg-8>";
                  popuni += "<input type = text class = form-control id =trazikorisnickoprezime name =trazikorisnickoprezime  value =" +jsondata[1]+ "></div></div>";
                  popuni += "<div class = form-group ><label for = trazikorisnickoadresa class = col-lg-4 control-label>Grad:</label><div  class = col-lg-8>";
                  popuni += "<input type = text class = form-control id =trazikorisnickoadresa name =trazikorisnickoadresa  value =" +jsondata[2]+ "></div></div>";
                  popuni += "<div class = form-group ><label for = trazikorisnickograd class = col-lg-4 control-label>Adresa:</label><div  class = col-lg-8>";
                  popuni += "<input type = text class = form-control id =trazikorisnickograd name =trazikorisnickograd  value =" +jsondata[3]+ "></div></div>";
                  popuni += "<div class = form-group ><label for = trazikorisnicpaket class = col-lg-4 control-label>Tip dostave:</label><div  class = col-lg-8>";
                  popuni += "<select class = form-control id =trazikorisnicpaket name =trazikorisnicpaket  ><option value=1>Brzi</option><option value=2>Obicni</option><option value=3>Posebni</option></select></div></div></div></span>";
                  $('#dodajOvdje').append(popuni); 
                      }
                       
                        

                    
                   
                   
                
            });

         
    });
$("body").on("change","#trazikorisnicpaket",function(evt){
$('#ovo').remove();
  var paket = $("#trazikorisnicpaket").val();
  var grad = $("#trazikorisnickograd").val();
  $.ajax({
                type : 'POST',
                url : 'nadisluzbu.php',
                dataType : 'json',
                data: {
                  'paket' : paket,
                  'grad' : grad,
                 },
                success: function( jsondata ){
                  
                  var popuni1 = "";
                  popuni1 += "<span id =ovo><div class = form-group ><label for = trazikorisniciSluzba class = col-lg-4 control-label>Kurirska sluzba:</label><div  class = col-lg-8>";
                  popuni1 += "<select class = form-control id =trazikorisniciSluzba name =trazikorisniciSluzba  >";
                  for (var i = 0; i < jsondata.length; i++){
                    if(i%2==0){
                    popuni1 += "<option value="+jsondata[i]+ ">" +jsondata[i+1] + "</option>";
                  }
                  }
                  popuni1 += "</select></div></div>";
                  popuni1 += "<button type=submit id =btnDodajPaket  name=btnDodajPaket class=btn"+" btn-success"+" >Posalji paket</button></span>";
                  $('#dodajOvdje').append(popuni1); 
                      }
                       
                        

                    
                   
                   
                
            });
  });
$.ajax({
                type:"POST",
                url:"preuzmipaket.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<span><div class = form-group ><label for = trazikorisniciSluzba class = col-lg-4 control-label>Korisnik:</label><div  class = col-lg-8><select class = form-control id =trazikorisniciSluzba name =trazikorisniciSluzba  >";
                   
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 == 0){
                        op += "<option value=" +json[i]+">"+json[i+1] +"</option>";
                      }
                    } 
                  op += "</select></div></div><br/>";
                  op += "<div class = form-group ><label for = paketime class = col-lg-4 control-label>Naziv:</label><div  class = col-lg-8>";
                  op += "<input type = text class = form-control id =paketime name =paketime  ></div></div>";
                  op += "<div class = form-group ><label for = pakettezina class = col-lg-4 control-label>Težina:</label><div  class = col-lg-8>";
                  op += "<input type = text class = form-control id =pakettezina name =pakettezina  ></div></div>";
                  op += "<div class = form-group ><label for = paketsirina class = col-lg-4 control-label>Širina:</label><div  class = col-lg-8>";
                  op += "<input type = text class = form-control id =paketsirina name =paketsirina  value ></div></div>";
                  op += "<div class = form-group ><label for = paketduzina class = col-lg-4 control-label>Dužina:</label><div  class = col-lg-8>";
                  op += "<input type = text class = form-control id =paketduzina name =paketduzina ></div></div>";
                  op += "<div class = form-group ><label for = paketvisina class = col-lg-4 control-label>Visina:</label><div  class = col-lg-8>";
                  op += "<input type = text class = form-control id =paketvisina name =paketvisina ></div></div>";
                  op += "<div class = form-group ><label for = slika1 class = col-lg-4 control-label>Slika:</label><div  class = col-lg-8>";
                  op += "<input type = file class = form-control id =slika1 name =slika1 ></div></div>";
                  op += "<div class = form-group ><label for = slika2 class = col-lg-4 control-label>Slika:</label><div  class = col-lg-8>";
                  op += "<input type = file class = form-control id =slika2 name =slika2 ></div></div>";
                  op += "<div class = form-group ><label for = slika3 class = col-lg-4 control-label>Slika:</label><div  class = col-lg-8>";
                  op += "<input type = file class = form-control id =slika3 name =slika3 ></div></div>";
                  op += "</div></div></div></span>";
                  $('#dodajOvdje1').append(op); 
                }
               
            });

$.ajax({
                type:"POST",
                url:"nadirutu.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var ij = "<div class = form-group ><label for = trazikorisniciRuta class = col-lg-4 control-label>Ruta:</label><div  class = col-lg-8><select class = form-control id =trazikorisniciRuta name =trazikorisniciRuta  >";
                    
                    
                    for (var i =0;i<json.length;i++){
                        
                        ij += "<option value=" +json[i] +">"+json[i] +"</option>";
                    } 
                  ij += "</select></div><br/>";
                  $('#dodajOvdje1').append(ij); 
                }
               
            });

$.ajax({
                type:"POST",
                url:"pronadicijenaruta.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-4>";
                    op += "<select class = col-lg-8 id=selectRuta name=selectRuta>";
                    
                    for (var i =0;i<json.length;i++){
                        
                        op += "<option value=" +json[i] +">"+json[i] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#dodajOvdjeRuta').append(op); 
                }
               
            });

$("body").on("change","#selectRuta",function(evt){
  var ruta = $("#selectRuta").val();
 
   $.ajax({
                type : 'POST',
                url : 'usporedicijenarute.php',
                dataType : 'json',
                data: {
                  'ruta' : ruta,
                  
                 },
                success: function( jsondata ){
                  
                   $('#ispisKorisnika1').dataTable().fnDestroy();
                    $('#ispisKorisnika1').remove();
                   
                    var tablica ="<div class='table-responsive'><table id='ispisKorisnika1' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Usporedivanje ruta</caption><thead><tr><th>Naziv rute</th><th>Cijena</th><th>Vrijeme dostave</th><th>Kilometraza</th><th>Kurirska sluzba<th>Tip dostave</th></th></tr></thead><tbody>"

                    for (var i =0;i<jsondata.length;i++){
                      
                      if(i%6==0){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + jsondata[i] + "</td>";
                            tablica += "<td>" + jsondata[i+1]+ "</td>";
                            tablica += "<td>" + jsondata[i+2]+ "</td>";
                            tablica += "<td>" + jsondata[i+3] + "</td>";
                            tablica += "<td>" + jsondata[i+4] + "</td>";
                            tablica += "<td>" + jsondata[i+5] + "</td>";
                            
                             
                            tablica += "</tr>";
                          }
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#dodajOvdjeRuta').append(tablica);
                    
                    $('#ispisKorisnika1').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": false
                         } ); 
                   
                   
                
            }

});

  
});
$.ajax({
                type : 'POST',
                url : 'dohvatistatitikasluzba.php',
                dataType : 'json',
                data: {
                  
                  
                 },
                success: function( jsondata ){
                  
                   $('#ispisKorisnika2').dataTable().fnDestroy();
                    $('#ispisKorisnika2').remove();
                   
                    var tablica ="<div class='table-responsive'><table id='ispisKorisnika2' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Statistika sluzba</caption><thead><tr><th>Naziv sluzbe</th><th>Broj paketa</th></tr></thead><tbody>"

                    for (var i =0;i<jsondata.length;i++){
                      
                      if(i%2==0){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + jsondata[i] + "</td>";
                            tablica += "<td>" + jsondata[i+1]+ "</td>";
                            
                            
                             
                            tablica += "</tr>";
                          }
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#dodajOvdjeStatiskitaSluzbe').append(tablica);
                    
                    $('#ispisKorisnika2').dataTable
                          ( {"dom": 'T<"clear">lfrtip',
                                                "otableTools": {
                                                    "sSwfPath": "../copy_csv_xls_pdf.swf"
                                                },
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": true
                         } ); 
                   
                   
                
            }

    });

$('#ispisKorisnikaPD').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": true
                         } ); 

                        
$( "#btnSluzbaStatistika" ).click(function() {
 $.ajax({
  type: "POST",
  url:"dohvatistatistikasluzbachart.php",
  success: function(html){
  $.getJSON('sluzbachart.json', function(data) {
  var aa = Array();
  var bb = Array();
  $.each(data, function(index, value) {
                      
  aa.push(value[0]);
  bb.push(parseInt(value[1]));
                  });
      
         var options={
                chart: {
                     renderTo: 'chart',
                     type: 'column'
                },
                xAxis:{
                     categories: aa
                },
                yAxis: {
                     title: 'Broj'
                }, 
               series: 
                 [ {
                name : 'Rute',
                data: bb
            }]
            ,
           };
        var chart = new Highcharts.Chart(options);
    });
                
    //DO NOTHING
}
   
                 
  
               
           

    
  });
  });
$.ajax({
                type : 'POST',
                url : 'dohvatistatistikaruta.php',
                dataType : 'json',
                data: {
                  
                  
                 },
                success: function( jsondata ){
                  
                   $('#ispisKorisnika3').dataTable().fnDestroy();
                    $('#ispisKorisnika3').remove();
                   
                    var tablica ="<div class='table-responsive'><table id='ispisKorisnika3' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Statistika Ruta</caption><thead><tr><th>Naziv Rute</th><th>Broj paketa</th></tr></thead><tbody>"

                    for (var i =0;i<jsondata.length;i++){
                      
                      if(i%2==0){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + jsondata[i] + "</td>";
                            tablica += "<td>" + jsondata[i+1]+ "</td>";
                            
                            
                             
                            tablica += "</tr>";
                          }
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#dodajOvdjeStatiskitaRuta').append(tablica);
                    
                    $('#ispisKorisnika3').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": true
                         } ); 
                   
                   
                
            }

    });

$( "#btnRutaStatistika" ).click(function() {
  $.ajax({
  type: "POST",
  url:"dohvatistatistikarutachart.php",
  success: function(html){
  $.getJSON('rutachart.json', function(data) {
  var aa = Array();
  var bb = Array();
  $.each(data, function(index, value) {
                      
  aa.push(value[0]);
  bb.push(parseInt(value[1]));
                  });
      
         var options={
                chart: {
                     renderTo: 'chart1',
                     type: 'column'
                },
                xAxis:{
                     categories: aa
                },
                yAxis: {
                     title: 'Broj'
                }, 
               series: 
                 [ {
                name : 'Rute',
                data: bb
            }]
            ,
           };
        var chart = new Highcharts.Chart(options);
    });
                
    //DO NOTHING
}
   
                 
  
               
           

    
  });
});
/*$( "#btnRutaStatistika" ).click(function() {
 
   
                 
  $.getJSON('rutachart.json', function(data) {
  var aa = Array();
  var bb = Array();
  $.each(data, function(index, value) {
                      
  aa.push(value[0]);
  bb.push(parseInt(value[1]));
                  });
      
         var options={
                chart: {
                     renderTo: 'chart1',
                     type: 'column'
                },
                xAxis:{
                     categories: aa
                },
                yAxis: {
                     title: 'Broj'
                }, 
               series: 
                 [ {
                name : 'Rute',
                data: bb
            }]
            ,
           };
        var chart = new Highcharts.Chart(options);
    });
                
               
           

    
  });*/

$.ajax({
                type:"POST",
                url:"pretragaRutaMjesto.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-4>";
                    op += "<select class = col-lg-8 id=selectRutaMjesto name=selectRutaMjesto>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2 ==0){
                        op += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                    }
                    } 
                  op += "</select></div><br/>";
                  $('#dodajOvdjeRutaMjesto').append(op); 
                }
               
            });

$("body").on("change","#selectRutaMjesto",function(evt){
  var ruta = $("#selectRutaMjesto").val();
 $('span').remove();
   $.ajax({
                type : 'POST',
                url : 'rutamjestoregistriraniajax.php',
                dataType : 'json',
                data: {
                  'ruta' : ruta,
                  
                 },
                success: function( jsondata ){
                  
                   
                    $('#ispisKorisnika4').remove();
                   
                    
                    var popuni = "<span>";
                    for (var i =0;i<jsondata.length;i++){
                      
                  popuni += "<div class = form-group ><label for = trazikorisnickoime class = col-lg-4 control-label>Mjesto:</label><div  class = col-lg-8>";
                  popuni += "<input type = text class = form-control id =trazikorisnickoime name =trazikorisnickoime  value =" +jsondata[i]+ "></div></div><br/>";
                       
                 
                 
                  }  
                   
                     popuni += "</span>";
                    
                    $('#dodajOvdjeRutaMjesto').append(popuni);
                    
                   
                   
                   
                
            }

});

  
});

$.ajax({
                type:"POST",
                url:"dohvatiPaketIme.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<center><div  class = row>";
                    op += "<select class=span8 offset3 id=selectRutaMjesto name=selectRutaMjesto>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2==0){
                        op += "<option value=" +json[i+1] +">"+json[i+1] +"</option>";
                      }
                    } 
                  op += "</select></div><br/></center>";
                  $('#paketMjesto').append(op); 
                }
               
            });

$("body").on("change","#selectRutaMjesto",function(evt){
  var ruta = $("#selectRutaMjesto").val();
 $('span').remove();
   $.ajax({
                type : 'POST',
                url : 'paketrutamjesto.php',
                dataType : 'json',
                data: {
                  'ruta' : ruta,
                  
                 },
                success:function(json){
                    var op = "<span><div   class = row>";
                    op += "<select class=span8 offset3 id=selectMjestoPaket name=selectMjestoPaket>";
                    
                    for (var i =0;i<json.length;i++){
                        if(i%2==0){
                        op += "<option value=" +json[i] +">"+json[i+1] +"</option>";
                      }
                    } 
                  op += "</select><br/><select class=span8 offset3 id=selectDostavljen name=selectDostavljen><option value=0>-------</option><option value=1>Paket isporucen</option><option value=2>Paket nije isporucen</option></select></div><br/><input type=text id=datepickerX name=datepickerX ><br/><button type=submit id =btnDodajMjestoRuta  name=btnDodajMjestoRuta class=btn"+" btn-success"+" >Posalji paket</button><br/></span>";
            
                  $('#paketMjesto').append(op); 
                  $( "#datepickerX" ).datepicker();
                  
 
                }

});

  
});

$("body").on("click","#btnDodajMjestoRuta",function(evt){
     var imePaket = $("#selectRutaMjesto").val();
     var idRutaMjesto = $("#selectMjestoPaket").val();
     var datum = $("#datepickerX").val();
     var dostavljen = $("#selectDostavljen").val();
     $('span').remove();
     

            $.ajax({
                type:"POST",
                url:"upisipaketrutamjesto.php",
                dataType:"json",
                data : 
                    {
                     'imePaket' : imePaket, 
                     'idRutaMjesto' : idRutaMjesto,
                     'datum' : datum,
                     'selectDostavljen' : dostavljen,
                     },
                success:function(json){
                    
                    
                    
                    
                    
                }
            }); 
    });
$( "#datepickerX" ).datepicker();
$( "#datepickerXY" ).datepicker();
$( "#datepickerXZ" ).datepicker();
$("body").on("click","#btnTablicaXZ",function(evt){
  var date1 = $("#datepickerXY").val();
  var date2 = $("#datepickerXZ").val();
$.ajax({
                type : 'POST',
                url : 'moderatorstatistikaposlani.php',
                dataType : 'json',
                data: {
                  'date1' : date1,
                  'date2' : date2,
                  
                 },
                success: function( jsondata ){
                  
                   $('#ispisKorisnika4').dataTable().fnDestroy();
                    $('#ispisKorisnika4').remove();
                   
                    var tablica ="<div class='table-responsive'><table id='ispisKorisnika4' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Statistika Korisnika</caption><thead><tr><th>Korisnicko ime</th><th>Broj paketa</th></tr></thead><tbody>"

                    for (var i =0;i<jsondata.length;i++){
                      
                      if(i%2==0){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + jsondata[i] + "</td>";
                            tablica += "<td>" + jsondata[i+1]+ "</td>";
                            
                            
                             
                            tablica += "</tr>";
                          }
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#statiskiaPoslaniPaketi').append(tablica);
                    
                    $('#ispisKorisnika4').dataTable
                        ( {
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": true
                         } ); 
                   
                   
                
            }

    });
});

$( "#btnKorisnikStatistika" ).click(function() {
  var date1 = $("#datepickerXY").val();
  var date2 = $("#datepickerXZ").val();
  $.ajax({
  type: "POST",
  url:"dohvatistatistikakorisnikchart.php",
  dataType : 'html',
                data: {
                  'date1' : date1,
                  'date2' : date2,
                  
                 },
  success: function(html){
  $.getJSON('korisnikchart.json', function(data) {
  var aa = Array();
  var bb = Array();
  $.each(data, function(index, value) {
                      
  aa.push(value[0]);
  bb.push(parseInt(value[1]));
                  });
      
         var options={
                chart: {
                     renderTo: 'chart3',
                     type: 'column'
                },
                xAxis:{
                     categories: aa
                },
                yAxis: {
                     title: 'Broj'
                }, 
               series: 
                 [ {
                name : 'Korisnici',
                data: bb
            }]
            ,
           };
        var chart = new Highcharts.Chart(options);
    });
                
    //DO NOTHING
}
   
                 
  
               
           

    
  });
});

$.ajax({
                type : 'POST',
                url : 'administratormaildohvatisve.php',
                dataType : 'json',
                data: {
                  
                  
                 },
                success: function( jsondata ){
                  
                   $('#korisniciMail').dataTable().fnDestroy();
                    $('#korisniciMail').remove();
                   
                    var tablica ="<div class='table-responsive'><table id='korisniciMail' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Nesiporuceni paketi</caption><thead><tr><th>Korisnicko ime</th><th>Adresa</th><th>Grad</th><th>Status</th><th>Posalji mail</th></tr></thead><tbody>"

                    for (var i =0;i<jsondata.length;i++){
                      
                      if(i%4==0){
                            tablica+= "<tr>";
                        
                            tablica += "<td>" + jsondata[i] + "</td>";
                            tablica += "<td>" + jsondata[i+1]+ "</td>";
                            tablica += "<td>" + jsondata[i+2] + "</td>";
                            tablica += "<td>" + jsondata[i+3]+ "</td>";
                            tablica += "<td><button type=submit id =btnPosalji  name=btnPosalji class='btn btn-success' data-table=korisniciMail data-korime="+jsondata[i]+">Submit</button></td>";
                             
                            tablica += "</tr>";
                          }
                    } 
                    tablica += "</tbody></table>";
                    
                    $('#tablicaMjestoMail').append(tablica);
                    
                    $('#korisniciMail').dataTable
                          ( {"dom": 'T<"clear">lfrtip',
                                                "otableTools": {
                                                    "sSwfPath": "../copy_csv_xls_pdf.swf"
                                                },
                            "iDisplayLength": straniceIspis,
                            "bLengthChange": false,
                            "ordering": true
                         } ); 
                   
                   
                
            }

    });

$("body").on("click","#korisniciMail > tbody > tr > td > button",function(evt){
     
     var korIme =$(this).attr('data-korime');
     
    $.ajax({
                type : 'POST',
                url : 'administratorpojedinacnomail.php',
                dataType : 'html',
                data: {
                  'korIme' : korIme,
                  
                 },
                success: function( jsondata ){
                  
                   
                
            }

    });
    
    });

$("#btnPosaljiSvima").click(function() { 
  
     $.ajax({
                type : 'POST',
                url : 'administratorposaljisvima.php',
                dataType : 'html',
                data: {
                  
                  
                 },
                success: function( jsondata ){
                  
                   
                
            }

    });
  });

$.ajax({
                type:"POST",
                url:"prikazpaketa.php",
                dataType:"json",
                data : 
                    {

                     },
                success:function(json){
                    var op = "<div  class = col-lg-4>";
                    op += "<select class = col-lg-8 id=selectPaketNadi name=selectPaketNadi>";
                    
                    for (var i =0;i<json.length;i++){
                        
                        op += "<option value=" +json[i] +">"+json[i] +"</option>";
                    } 
                  op += "</select></div><br/>";
                  $('#statusPaketa').append(op); 
                }
               
            });

$("body").on("change","#selectPaketNadi",function(evt){
var ruta = $("#selectPaketNadi").val();
 $('span').remove();
   $.ajax({
                type : 'POST',
                url : 'dohavtitrenutnulokacijupaketa.php',
                dataType : 'json',
                data: {
                  
                  
                 },
                success: function( jsondata ){
                  
                   
                    $('#ispisKorisnika4').remove();
                   
                    
                    var popuni = "<span>";
                    for (var i =0;i<jsondata.length;i++){
                      if(i%2==0){
                  popuni += "<div class = form-group ><label for = trazikorisnickoime class = col-lg-4 control-label>Mjesto:</label><div  class = col-lg-8>";
                  popuni += "<input type = text class = form-control id =trazikorisnickoime name =trazikorisnickoime  value =" +jsondata[i+1]+ "></div></div><br/>";
                       }
                 
                 
                  }  
                   
                     popuni += "</span>";
                    
                    $('#statusPaketa').append(popuni);
                    
                   
                   
                   
                
            }

});

  
});
});





