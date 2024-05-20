//alert('Hola');
class Mediciones{
    calcularPorcentaje(){
        let v1=document.getElementById('meta_medicion').value;
        let v2=document.getElementById('resultado_dia_medicion').value;
        let porcentaje=(parseFloat(v2)/parseFloat(v1))*100;
        document.getElementById('porcentaje_logro_medicion').value=porcentaje;
    }
    
    crearMedicion(){
        let v1=document.getElementById('meta_medicion').value;
        let v2=document.getElementById('resultado_dia_medicion').value;
        let v3=document.getElementById('porcentaje_logro_medicion').value;
        let v4=document.getElementById('id_indicador_medicion').value;
        let v5=document.getElementById('fecha_medicion').value;

        if(v1.trim()==='' || v4.trim()===''){
            alert('Llene todos los campos');
            return false;
        }else{
            let rutaPhp='public/php/medicion.insertar.php';
            let datos=`let1=${encodeURIComponent(v1)}&let2=${encodeURIComponent(v2)}&let3=${encodeURIComponent(v3)}&let4=${encodeURIComponent(v4)}&let5=${encodeURIComponent(v5)}`;
            let divResponse='avisosDesdeResponse2';
            let camposVaciar=['meta_medicion','resultado_dia_medicion','porcentaje_logro_medicion','id_indicador_medicion'];
            let campoFocus='meta_medicion';
            document.getElementById('avisosDesdeResponse2').innerHTML='<div class="alert alert-info" role="alert">Un momento porfavor...</div>';
            setTimeout(()=>{
                const comArch=new ComunicarArchivos(rutaPhp,datos,divResponse,camposVaciar,campoFocus); comArch.comunicarArchivos();
                },1000);
        }
    }

    editarMedicion(){
        let v1=document.getElementById('meta_medicion').value;
        let v2=document.getElementById('resultado_dia_medicion').value;
        let v3=document.getElementById('porcentaje_logro_medicion').value;
        let v4=document.getElementById('id_medicion').value;

        if(v1.trim()==='' || v4.trim()===''){
            alert('Llene todos los campos');
            return false;
        }else{
            let rutaPhp='public/php/medicion.editar.php';
            let datos=`let1=${encodeURIComponent(v1)}&let2=${encodeURIComponent(v2)}&let3=${encodeURIComponent(v3)}&let4=${encodeURIComponent(v4)}`;
            let divResponse='avisosDesdeResponse2';
            let camposVaciar=[];
            let campoFocus='';

            document.getElementById('avisosDesdeResponse2').innerHTML='<div class="alert alert-info" role="alert">Un momento porfavor...</div>';
            setTimeout(()=>{
                const comArch=new ComunicarArchivos(rutaPhp,datos,divResponse,camposVaciar,campoFocus); comArch.comunicarArchivos();
                },1000);
        }
    }

    tomarCapture(){
        html2canvas(document.body).then(function(canvas) {
            // Crea un enlace temporal para descargar la imagen
            var link = document.createElement('a');
            link.download = 'captura.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
        // alert('Hola');
    }

}

class Usuario{
    crearUsuario(){
        let v1=document.getElementById('nombre_usuario').value;
        let v2=document.getElementById('usuario').value;
        let v3=document.getElementById('contrasena_usuario').value;
        let v6=document.getElementById('contrasena_confirm').value;
        let v4=document.getElementById('rol_usuario').value;
        let v5=document.getElementById('empresa_usuario').value;
        
        if(v3!=v6){
            alert('Las contrasenas no coinciden');
            document.getElementById('contrasena_confirm').focus();
            return false;
        }
        if(v1.trim()==='' || v2.trim()==='' || v3.trim()==='' || v4.trim()==='' || v5.trim()===''){
            alert('Llene todos los campos');
            return false;
        }else{
            let rutaPhp='public/php/usuario.insertar.php';
            let datos=`let1=${encodeURIComponent(v1)}&let2=${encodeURIComponent(v2)}&let3=${encodeURIComponent(v3)}&let4=${encodeURIComponent(v4)}&let5=${encodeURIComponent(v5)}`;
            let divResponse='avisosDesdeResponse2';
            let camposVaciar=['nombre_usuario','usuario','contrasena_usuario','rol_usuario','empresa_usuario'];
            let campoFocus='nombre_usuario';

            document.getElementById('avisosDesdeResponse2').innerHTML='<div class="alert alert-info" role="alert">Un momento porfavor...</div>';
            setTimeout(()=>{
                const comArch=new ComunicarArchivos(rutaPhp,datos,divResponse,camposVaciar,campoFocus); comArch.comunicarArchivos();
                },1000);
        }
    }
}
