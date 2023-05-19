/**
* Javascript prototypes - String.pad() and Number.format()
* Carlos Reche (carlosreche@yahoo.com)


Bom, eu criei um método "prototipado" às variáveis numéricas pra formatar a exibição de seus valores...
são 3 parâmetros que vc pode passar (todos opcionais): o primeiro é um inteiro que representa o número de casas
decimais, o segundo é uma string com o caractere que ficará entre a parte inteira e a decimal, e o terceiro é uma
string também com o caractere que irá separar os milhares. Por exemplo:
var x = 1331.34;
alert(x.format(2, ",", ".")); // retorna 1.331,34
*/
String.PAD_LEFT  = 0;
String.PAD_RIGHT = 1;
String.PAD_BOTH  = 2;

String.prototype.pad = function(size, pad, side) {
  var str = this, append = "", size = (size - str.length);
  var pad = ((pad != null) ? pad : " ");
  if ((typeof size != "number") || ((typeof pad != "string") || (pad == ""))) {
    throw new Error("Wrong parameters for String.pad() method.");
  }
  if (side == String.PAD_BOTH) {
    str = str.pad((Math.floor(size / 2) + str.length), pad, String.PAD_LEFT);
    return str.pad((Math.ceil(size / 2) + str.length), pad, String.PAD_RIGHT);
  }
  while ((size -= pad.length) > 0) {
    append += pad;
  }
  append += pad.substr(0, (size + pad.length));
  return ((side == String.PAD_LEFT) ? append.concat(str) : str.concat(append));
}

Number.prototype.format = function(d_len, d_pt, t_pt) {
  var d_len = d_len || 0;
  var d_pt = d_pt || ".";
  var t_pt = t_pt || ",";
  if ((typeof d_len != "number")
    || (typeof d_pt != "string")
    || (typeof t_pt != "string")) {
    throw new Error("wrong parameters for method 'String.pad()'.");
  }
  var integer = "", decimal = "";
  var n = new String(this).split(/\./), i_len = n[0].length, i = 0;
  if (d_len > 0) {
    n[1] = (typeof n[1] != "undefined") ? n[1].substr(0, d_len) : "";
    decimal = d_pt.concat(n[1].pad(d_len, "0", String.PAD_RIGHT));
  }
  while (i_len > 0) {
    if ((++i % 3 == 1) && (i_len != n[0].length)) {
      integer = t_pt.concat(integer);
    }
    integer = n[0].substr(--i_len, 1).concat(integer);
  }
  return (integer + decimal);
}
