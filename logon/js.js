
    $("#enviar").on('click', function(e){
          e.preventDefault();
            var form = $('form')[0];
            var formData = new FormData(form);
          
              $.ajax({
                url: 'upload/upImagem.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                  $('#foto').val(data);
                  $('#mensagens').html('Upload completo!');
                },
                error: function(){
                  alert('Ocorreu um erro');
                }

              });
        });

    var marker;
    var markers = [];
    var ligaM=false;
    var desligaM=false;
    var myPosition =null;
    var cod;


    {//pega a localização o Usuario e inicia o Mapa
      
      if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(verlatlng);
      }
      function verlatlng(position){
        var latitude  = position.coords.latitude;
        var longitude = position.coords.longitude;
        var myPosition = {
          lat: latitude,
          lng: longitude
        }
        //console.log(myPosition);
        //alert('lat: '+latitude+' lng: '+longitude);
        initMap(myPosition);    

      }
    }

    resolvido.style.visibility='hidden';
    document.getElementById('formpost').style.visibility='hidden';

    desc.value = '';
    title.value = '';

    


    function initMap(position){
      var center = position;
      var map = new google.maps.Map(document.getElementById('map'),{
        zoom: 16,
        center: center
      });


      map.addListener('click', function(event) {
              
              if(ligaM){

                var dadosinfow = postagem();
                
              // ajax para salvar o marcardor no BD
              {
                $.post("markers/salvarM.php",{
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng(),
                    tipo: dadosinfow[0],
                    titulo: dadosinfow[1],
                    descricao: dadosinfow[2],
                    foto: dadosinfow[3],
                  },
                  function(data){
                    alert(data);
                    //gambiarra pra corrigir bug(pra o bug retire essa linha) o bug é no post que foi colocado antes da pagina ser recarregada;
                    location.reload();
                  })
              }
              addMarker(event.latLng, dadosinfow);
              formpost.style.visibility='hidden';
            
                
              }
              
          });
    
      function addMarker(location, dadosinfow){
          if(dadosinfow[0] == "A")
            var iconBase = 'icons/a.png';
          if(dadosinfow[0] == "E")
            var iconBase = 'icons/e.png';
          
          
          marker = new google.maps.Marker({
            position: location,
            //label: dadosinfow[0],
            map: map,
            icon: iconBase 
          });
          markers.push(marker);
          

          var stringContent = '<div>'+
          '<h3>'+dadosinfow[1]+'</h3>'+
          '<p>'+dadosinfow[2]+'</p>'+
          "<img src='upload/upload/"+dadosinfow[4]+"' width='300' height='150'><br/>"+
         // '<p>localFoto:zx.c,mzxc.,zmx upload/upload/'+dadosinfow[4]+'</p>'+
          '<a href="comentarios/index.php?lat='+location.lat+'&lng='+location.lng+'&foto=../upload/upload/'+dadosinfow[4]+'">'+'detalhes'+'</a>'+
          '</div>';
          //ADICIONAR O LINK PARA O COMENTÁRIOS DA POSTAGEM

          var infow = new google.maps.InfoWindow({
            content: stringContent
          });

          marker.addListener('click', function(){
            
            infow.open(map,this);
            //busca o marker no banco e mostra os dados na pagina

                $.post("markers/findM.php",{
                    lat: this.position.lat,
                    lng: this.position.lng,
                  },
                  function(data){
                    //alert(data);
                    var variavel = JSON.parse(data);
                    //checa se o usuário e admin ou criador do marcador
                    //retornando uma string de valor v ou f
                    var c = variavel[0].controle;
                    
                    if(c == "v")
                      resolvido.style.visibility='visible';
                    else
                      resolvido.style.visibility='hidden';
                    
                  })

            if(desligaM){
                   
                  $.post("markers/deleteM.php",{
                    tipo: dadosinfow[0],
                    titulo: dadosinfow[1],
                    descricao: dadosinfow[2]
                  },
                  function(data){
                    var variavel = JSON.parse(data);
                    
                    //1 - deu certo
                    //2 - erro
                    //3 - não pode
                    if (variavel[0].resp == 1){
                        alert("Deletado com sucesso!");
                        this.setMap(null);
                        desligaM = false;      
                    }
                    if (variavel[0].resp == 2){
                        alert("Ocorreu algum erro ao deletar, tente denovo");
                    }      
                    if (variavel[0].resp == 3){
                      alert("Você não pode marcar como resolvido pois você não criou essa postagem");
                    }
                              
                  
                  })

                this.setMap(null);
                desligaM = false;
                
            }


          });

          console.log(markers);

          ligaM = false;
      }

      function carregaMarcadores(){

        $.post("markers/carregaM.php",{}, function(data/*é o que vem do servidor*/){
          //alert(data);
          var variavel = JSON.parse(data);
          
          for (var i = variavel.length - 1; i >= 0; i--) {
            var location = {lat: variavel[i].lat, lng: variavel[i].lng};
            var dadosinfow = [variavel[i].type, variavel[i].name, variavel[i].address,variavel[i].creater,variavel[i].foto];

            addMarker(location, dadosinfow); 
          }
        })

      }
  
      carregaMarcadores();

    }//fecha initMap


    function ligMarker(){
      ligaM = true;
    }
    function resolvidof(){
       desligaM = true;
    }

    function Logout(){
      window.location.href = "../autentica/logout.php";
    }
    
    function postagem(){//retorna um array com os dados da postagem

      if(title.value !='' & type.value !=''){
        var descricao = desc.value;
        var tipo = type.value;
        var titulo = title.value;
        var nomeFoto = foto.value;
        
        formpost.style.Zindex='-10';
        formpost.style.visibility='hidden';

        return [tipo,titulo,descricao,nomeFoto];   
      }else{
        alert('VOCÊ NÃO ESCOLHEU O TIPO E O TITULO');
      }
    }
    
        
   
  
    
    
