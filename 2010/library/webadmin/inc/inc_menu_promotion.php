<script language="JavaScript" type="text/JavaScript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<body onLoad="MM_preloadImages('images/but_violet_over.gif')">
<table width="164"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="27" align="right"><img src="images/topic_menu_left01.gif" width="114" height="18"></td>
        </tr>
		<tr>
				   <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black02.gif">
                     <tr>
                       <td height="1"></td>
                     </tr>
                   </table></td>
  </tr>		
				 <tr>
                   <td  onmouseover="this.style.backgroundColor='#def8f8'" 
                                style="CURSOR: default" 
                                onmouseout="this.style.backgroundColor='#FFFFFF' "height="20" class=""><div align="right"><a href="promotion_new.php" class="text_black_normal" onMouseOver="MM_swapImage('menu_add02','','images/but_violet_over.gif',1)" onMouseOut="MM_swapImgRestore()">Add Promotion</a><img src="images/but_white.gif" name="menu_add02" width="27" height="20" border="0" align="absmiddle" id="menu_add02"></div></td>
				 </tr>
				 
        <tr>
          <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black02.gif">
              <tr>
                <td height="1"></td>
              </tr>
          </table></td>
        </tr>
             <tr>
          <td align="right"><img src="images/topic_menu_left02.gif" width="114" height="18"></td>
        </tr>
             <tr>
               <td height="1" align="right" background="images/line_black02.gif" class="text_black_normal"></td>
             </tr>
		        <tr>
                  <td  onmouseover="this.style.backgroundColor='#def8f8'" 
                                style="CURSOR: default" 
                                onmouseout="this.style.backgroundColor='#FFFFFF' "height="20" class=""><div align="right"><a href="promotion_to_edit.php" class="text_black_normal" onMouseOver="MM_swapImage('menu_edit03','','images/but_violet_over.gif',1)" onMouseOut="MM_swapImgRestore()">Edit Promotion</a><img src="images/but_white.gif" name="menu_edit03" width="27" height="20" align="absmiddle" id="menu_edit03"></div></td>
		        </tr>
        <tr>
          <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black02.gif">
              <tr>
                <td height="1"></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td align="right"><img src="images/topic_menu_left03.gif" width="114" height="18"></td>
        </tr> 
		<tr>
          <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black02.gif">
              <tr>
                <td height="1"></td>
              </tr>
          </table></td>
  </tr>
		        <tr>
                  <td  onmouseover="this.style.backgroundColor='#def8f8'" 
                                style="CURSOR: default" 
                                onmouseout="this.style.backgroundColor='#FFFFFF' "height="20" class=""><div align="right"><a href="promotion_to_delete.php" class="text_black_normal" onMouseOver="MM_swapImage('menu_del02','','images/but_violet_over.gif',1)" onMouseOut="MM_swapImgRestore()">Delete Promotion</a><img src="images/but_white.gif" name="menu_del02" width="27" height="20" align="absmiddle" id="menu_del02"></div></td>
		        </tr>     
				   <tr>
          <td><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black02.gif">
              <tr>
                <td height="1"></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>