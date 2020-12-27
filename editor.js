function iframe()
{
    editor.document.designMode='on';
}

function bold()
{
    editor.document.execCommand('bold',false,null);
}

function italic()
{
    editor.document.execCommand('italic',false,null);
}
function underline()
{
    editor.document.execCommand('underline',false,null);
}
function  fontSize()
{
    var size=prompt("Enter a size ","");
    editor.document.execCommand('fontsize',false,size);
}
function fontColor()
{
    var color=prompt("Enter a color name or hexadecimalValue","");
    editor.document.execCommand('forecolor',false,color);
}
function highlight()
{
    var color=prompt("Enter a color name or hexadecimalValue","");
    editor.document.execCommand('backcolor',false,color);
}
function unhighlight()
{
    editor.document.execCommand('backcolor',false,"white");
}
function llink()
{
    var link=prompt("Enter a link ","http://");
    editor.document.execCommand('createLink',false,link);
}
function ulink()
{
    editor.document.execCommand('unlink',false,null);
}
function jc()
{
editor.document.execCommand('justifyCenter',false,null);
}
function jr()
{
    editor.document.execCommand('justifyRight',false,null);
}
function jf()
{
    editor.document.execCommand('justifyFull',false,null);
}
function jl()
{
 editor.document.execCommand('justifyLeft',false,null);
}
function undo()
{
editor.document.execCommand('undo',false,null);
}


function formsubmit()
{
    document.getElementById("tx").value= window.frames['editor'].document.body.innerHTML;
}