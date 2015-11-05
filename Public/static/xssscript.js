function url_decode(){ 
  //url decode
  if($(".hex_text") != ''){ 
    var vText = $(".hex_text").val(); 
    $(".ascii_text").val(unescape(vText)); 
  } 
} 

function encode(){ 
  if($(".ascii_text") != ''){ 
    var vText = $(".ascii_text").val(); 
    $(".hex_text").val(convertToHex(vText));
    $(".hex_html_text").val(convertToHexHTML(vText));
    $(".hex_html_1_text").val(convertToUnicode(vText));
    $(".hex_base64_text").val(encodeBase64(vText));
  } 
} 

function convertToUnicode(source) { 
  result = ''; 
  for (i=0; i<source.length; i++) {
    result += '&#' + source.charCodeAt(i); 
  }
  return result; 
} 

function convertToHex(num) { 
  var hex = ''; 
  for (i=0;i<num.length;i++) {
    if (num.charCodeAt(i).toString(16).toUpperCase().length < 2) {
      hex += "%0" + num.charCodeAt(i).toString(16).toUpperCase(); 
    } else {
      hex += "%" + num.charCodeAt(i).toString(16).toUpperCase(); 
    }
  }
  return hex; 
} 

function convertToHexHTML(num) { 
  var hexhtml = ''; 
  for (i=0;i<num.length;i++) {
    if (num.charCodeAt(i).toString(16).toUpperCase().length < 2) {
      hexhtml += "&#x0" + num.charCodeAt(i).toString(16).toUpperCase() + ";"; 
    } else {
      hexhtml += "&#x" + num.charCodeAt(i).toString(16).toUpperCase() + ";"; 
    }
  }
  return hexhtml; 
} 

function convertToASCII() {
  if ($(".hex_html_1_text").val() != '') {
    var uniText = $(".hex_html_1_text").val();
    var testText = uniText.substring(2,uniText.length).split("&#")
    var resultString = ""
    for (i=0;i<testText.length;i++) {
      if  (dec2hex(testText[i]).length < 2) {
        resultString += "%0" + dec2hex(testText[i])
      } else {
        resultString += "%" + dec2hex(testText[i])
      }
      
    }
    $(".ascii_text").val(unescape(resultString));
  }
}

function convertHexToASCII() {
  if ($(".hex_html_text") != '') {
    var hexText = $(".hex_html_text").val();

    var testText = hexText.substring(3,hexText.length).split("&#x");
    var resultString = '';
    var sub = '';
    for (i=0;i<testText.length;i++) {
      sub = testText[i].substring(testText[i].length-3,testText[i].length-1) 
      if  (sub.length < 2) {
        resultString += "%0" + sub;
        alert ("输入不正确", sub, " - ", resultString);
      } else {
        resultString += "%" + sub;
      }
     
    }
    $(".ascii_text").val(unescape(resultString));
  }
}

function dec2hex(n){
  var hex = "0123456789ABCDEF";
  var mask = 0xf;
  var retstr = "";
  while(n != 0){
    retstr = hex.charAt(n&mask) + retstr;
    n>>>=4;
  }
  return retstr.length == 0 ? "0" : retstr;
}

var base64Chars = new Array(
    'A','B','C','D','E','F','G','H',
    'I','J','K','L','M','N','O','P',
    'Q','R','S','T','U','V','W','X',
    'Y','Z','a','b','c','d','e','f',
    'g','h','i','j','k','l','m','n',
    'o','p','q','r','s','t','u','v',
    'w','x','y','z','0','1','2','3',
    '4','5','6','7','8','9','+','/'
);

var reverseBase64Chars = new Array();
for (var i=0; i < base64Chars.length; i++){
    reverseBase64Chars[base64Chars[i]] = i;
}

var base64Str;
var base64Count;
function setBase64Str(str){
    base64Str = str;
    base64Count = 0;
}
function readBase64(){    
    if (!base64Str) return -1;
    if (base64Count >= base64Str.length) return -1;
    var c = base64Str.charCodeAt(base64Count) & 0xff;
    base64Count++;
    return c;
}
function encodeBase64(str){
    setBase64Str(str);
    var result = '';
    var inBuffer = new Array(3);
    var lineCount = 0;
    var done = false;
    while (!done && (inBuffer[0] = readBase64()) != -1){
        inBuffer[1] = readBase64();
        inBuffer[2] = readBase64();
        result += (base64Chars[ inBuffer[0] >> 2 ]);
        if (inBuffer[1] != -1){
            result += (base64Chars [(( inBuffer[0] << 4 ) & 0x30) | (inBuffer[1] >> 4) ]);
            if (inBuffer[2] != -1){
                result += (base64Chars [((inBuffer[1] << 2) & 0x3c) | (inBuffer[2] >> 6) ]);
                result += (base64Chars [inBuffer[2] & 0x3F]);
            } else {
                result += (base64Chars [((inBuffer[1] << 2) & 0x3c)]);
                result += ('=');
                done = true;
            }
        } else {
            result += (base64Chars [(( inBuffer[0] << 4 ) & 0x30)]);
            result += ('=');
            result += ('=');
            done = true;
        }
        lineCount += 4;
        if (lineCount >= 76){
            result += ('\n');
            lineCount = 0;
        }
    }
    return result;
}

function readReverseBase64(){   
    if (!base64Str) return -1;
    while (true){      
        if (base64Count >= base64Str.length) return -1;
        var nextCharacter = base64Str.charAt(base64Count);
        base64Count++;
        if (reverseBase64Chars[nextCharacter]){
            return reverseBase64Chars[nextCharacter];
        }
        if (nextCharacter == 'A') return 0;
    } 
}

function ntos(n){
    n=n.toString(16);
    if (n.length == 1) n="0"+n;
    n="%"+n;
    return unescape(n);
}

function decodeBase64(str){
    setBase64Str(str);
    var result = "";
    var inBuffer = new Array(4);
    var done = false;
    while (!done && (inBuffer[0] = readReverseBase64()) != -1
        && (inBuffer[1] = readReverseBase64()) != -1){
        inBuffer[2] = readReverseBase64();
        inBuffer[3] = readReverseBase64();
        result += ntos((((inBuffer[0] << 2) & 0xff)| inBuffer[1] >> 4));
        if (inBuffer[2] != -1){
            result +=  ntos((((inBuffer[1] << 4) & 0xff)| inBuffer[2] >> 2));
            if (inBuffer[3] != -1){
                result +=  ntos((((inBuffer[2] << 6)  & 0xff) | inBuffer[3]));
            } else {
                done = true;
            }
        } else {
            done = true;
        }
    }
    return result;
}

function convet(ip,level){
  if (level > 1) {
    alert("Dword level must be 0 or 1");
    
  }
  n=ip.split('.'); 
  for(i=0;i<4;i++) {
    n[i]=parseInt(n[i]);
  } 
  var dword=(n[0]*16777216)+(n[1]*65536)+(n[2]*256)+n[3]+(parseInt(level)*4294967296);
  $(".DWord").val(dword); 
  tooct(ip);
  tohex(ip);
} 

function tooct(a){ 
  n=a.split('.'); 
  for(i=0;i<4;i++) { 
    n[i]=parseInt(n[i]);
    if(n[i]>255||isNaN(n[i])){
      alert('IP地址不正确!');
      return;
    }
    var one=Math.floor(n[i]/64); 
    var t=n[i]%64; 
    var two=Math.floor(t/8);
    var three=n[i]%8; 
    n[i]='0'+one+two+three; 
  } 
  var octip=n.join('.');
  if(octip.substring(octip.length-1,octip.length)=='.') {
    octip=octip.substring(0,octip.length-1);
  } 
  $(".Octal").val(octip);
  return;
} 

function tohex(ip){ 
  n=ip.split('.'); 
  for(i=0;i<4;i++) { 
    n[i]=parseInt(n[i]);
    if(n[i]>255||isNaN(n[i])){
      return;
    }
    var two=numlet(n[i]%16); 
    var one=numlet(Math.floor(n[i]/16));
    n[i]='0x'+one+two;
  } 
  var hexip=n.join('.');
  if(hexip.substring(hexip.length-1,hexip.length)=='.') {
    hexip=hexip.substring(0,hexip.length-1);
  } 
  $(".Hex").val(hexip);
  return; 
}

function numlet(num){ 
  if(num==10){return 'a';} 
  if(num==11){return 'b';}
  if(num==12){return 'c';} 
  if(num==13){return 'd';} 
  if(num==14){return 'e';}
  if(num==15){return 'f';} 
  return num;
} 
$(".btn_base64encode").click(function(){
  $('.ascii_text').val(decodeBase64($('.hex_base64_text').val()));
});