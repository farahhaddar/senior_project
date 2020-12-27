
function bold()
{
    document.execCommand('bold',false,null);
}

function italic()
{
    document.execCommand('italic',false,null);
}
function underline()
{
    document.execCommand('underline',false,null);
}
function  fontSize()
{
    var size=prompt("Enter a size ","");
    document.execCommand('fontsize',true,size);
    
}
function fontColor()
{
    var color=prompt("Enter a color name or hexadecimalValue","");
    document.execCommand('forecolor',false,color);
}
function highlight()
{
    var color=prompt("Enter a color name or hexadecimalValue","");
    document.execCommand('backcolor',false,color);
}
function unhighlight()
{
    document.execCommand('backcolor',false,"white");
}
function llink()
{
    var link=prompt("Enter a link ","http://");
    document.execCommand('createLink',false,link);
}
function ulink()
{
    document.execCommand('unlink',false,null);
}
function jc()
{
  document.execCommand('justifyCenter',false,null);
}
function jr()
{
    document.execCommand('justifyRight',false,null);
}
function jf()
{
    document.execCommand('justifyFull',false,null);
}
function jl()
{
 document.execCommand('justifyLeft',false,null);
}
function undo()
{
 document.execCommand('undo',false,null);
}

function val(){
    document.getElementById("tx").value= document.getElementById("editor").innerHTML;
    
}
