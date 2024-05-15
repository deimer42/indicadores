const CryptoJS = require("crypto-js");

function encriptadoDesencriptado(comando, datoSensible, naturalezaDato) {
  let dato;
  let pass;
  let iv = '1234567890123456'; // IV constante para AES-256-CBC
  
  switch (naturalezaDato) {
    case 'usuario':
      pass = '1995@kJ51C::';
      break;
    // Agrega más casos según sea necesario

  }

  if (comando === 'encriptar') {
    let sal = CryptoJS.lib.WordArray.random(16);
    let sal_encode = CryptoJS.enc.Base64.stringify(sal);
    let concatenado = sal_encode + datoSensible;
    let key = CryptoJS.enc.Utf8.parse(pass);
    let encrypted = CryptoJS.AES.encrypt(concatenado, key, {
      iv: CryptoJS.enc.Utf8.parse(iv),
      mode: CryptoJS.mode.CBC,
      padding: CryptoJS.pad.Pkcs7
    });
    dato = encrypted.toString();
  } else if (comando === 'desencriptar') {
    let key = CryptoJS.enc.Utf8.parse(pass);
    let decrypted = CryptoJS.AES.decrypt(datoSensible, key, {
      iv: CryptoJS.enc.Utf8.parse(iv),
      mode: CryptoJS.mode.CBC,
      padding: CryptoJS.pad.Pkcs7
    });
    let datoOperado = decrypted.toString(CryptoJS.enc.Utf8);
    dato = datoOperado.slice(24);
  }
  return dato;
}

// Ejemplo de uso:
let datoEncriptado = encriptadoDesencriptado('encriptar', 'dato sensible', 'usuario');
console.log("Dato encriptado:", datoEncriptado);

let datoDesencriptado = encriptadoDesencriptado('desencriptar', datoEncriptado, 'usuario');
console.log("Dato desencriptado:", datoDesencriptado);
