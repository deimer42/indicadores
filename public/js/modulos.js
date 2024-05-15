'use strict';
class ComunicarArchivos{
     constructor(rutaPhp,datos,divResponse,camposVaciar,campoFocus){
         this.dominio='http://indicadores.com/';
         this.rutaPhp=rutaPhp;
         this.datos=datos;
         this.divResponse=divResponse; //div html donde se muestra la respuesta de la peticion
         this.camposVaciar=camposVaciar;
         this.campoFocus=campoFocus;
        }

     comunicarArchivos(){ //de manera asíncrona, sin recargar la pagina
         let peticion_http;
         if(window.XMLHttpRequest){
             peticion_http=new XMLHttpRequest();
            }
         else if(window.ActiveXObject){
             peticion_http=new ActiveXObject('Microsoft.XMLHTTP');
            }
         peticion_http.onreadystatechange= () => {
             if(peticion_http.readyState==4){
                 document.getElementById(this.divResponse).innerHTML=peticion_http.responseText;
                 document.getElementById(this.campoFocus).focus();
                 for(let i=0; i<this.camposVaciar.length; i++){ //un bucle for recorre los elementos del array camposVaciar ejecutando el null a todos los campos. Esto es magia
                     document.getElementById(this.camposVaciar[i]).value=null;
                    }
                }
            };
         peticion_http.open('POST',this.dominio+this.rutaPhp,true); //true indica si la solicitud debe ser asíncrona
         peticion_http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         peticion_http.send(this.datos); //send envia el cuerpo de la solicitud, en este caso los campos del formulario
        }
    }

    class GestionModal{
        constructor(comando, nombreModal){
            this.comando=comando;
            this.nombreModal='#'+nombreModal;
           }
   
        gestionModal(){
            if(this.comando=='abrirModal'){
                const modal=document.querySelector(this.nombreModal);
                modal.showModal();
               }
            else if(this.comando=='cerrarModal'){
                const modal=document.querySelector(this.nombreModal);
                modal.close();
                window.location.reload();
               }
           }
   
        asignarIdDocumento(valor,idElemento){
            /* Esta clase se crea para colocar valores de variables dentro de un hidden en cualquier modal */
            document.getElementById(idElemento).value=valor;
           }
   
    }

       