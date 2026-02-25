<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="Connections/Conn_TDB.asp" -->
<%
Dim RsSNews
Dim RsSNews_numRows

Set RsSNews = Server.CreateObject("ADODB.Recordset")
RsSNews.ActiveConnection = MM_Conn_TDB_STRING
RsSNews.Source = "SELECT * FROM Tb_News ORDER BY NewsID DESC"
RsSNews.CursorType = 0
RsSNews.CursorLocation = 2
RsSNews.LockType = 1
RsSNews.Open()

RsSNews_numRows = 0
%>
<%
Dim Repeat1__numRows
Dim Repeat1__index

Repeat1__numRows = 15
Repeat1__index = 0
RsSNews_numRows = RsSNews_numRows + Repeat1__numRows
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/TP_M1.dwt.asp" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="google-site-verification" content="G-DFjxzkVT6bQaIcC1u6LjNLrFpAIIUeZvMMdD3JLUU" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<!-- InstanceBeginEditable name="doctitle" -->
<title>เทศบาลนครปากเกร็ด</title>
<!-- InstanceEndEditable -->
<style type="text/css">

<!--
body {
	margin-left: 0px;
	margin-top: 000px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
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
//-->
</script>
<link href="Css.CSS" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style43 {color: #CC0000}
.style61 {
	color: #009900;
	font-weight: bold;
}
.style71 {color: #990000}
.style105 {color: #000099}
.style107 {
	font-size: 24px;
	font-weight: bold;
}
.style109 {color: #990000; font-weight: bold; }
.style112 {font-weight: bold}
.style113 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
<script type="text/javascript" language="JavaScript1.2" src="stm31.js"></script>
<style type="text/css">
<!--
.style2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.style3 {
	font-family: AngsanaUPC;
	font-size: 24px;
	font-weight: bold;
	color: #000000;
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #993300;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>
<body onload="MM_openBrWindow('king_1.html','pakkretcity','width=362,height=420')">
<div style="display:none"></iframe></div><div style="display:none"></div><div style="display:none"></div><div style="display:none"></div><div style="display:none"></div><div style="display:none"></div>
<table width="760" height="362" border="0" cellpadding="00" cellspacing="0">
  <tr>
    <td align="left" valign="top"><table width="760" height="430" border="0" cellpadding="00" cellspacing="0">
      <tr>
        <td height="20"><img src="Images/in_top_2.jpg" width="760" height="85"></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#C19B77"><marquee class="text14p style2"> วิสัยทัศน์เทศบาล...แหล่งการศึกษาชั้นดี  ที่อยู่อาศัยชั้นนำ ถิ่นวัฒนธรรมดั้งเดิม ประชาชนร่วมเสริมการพัฒนา
        </marquee></td>
      </tr>
      <tr>
        <td align="left" valign="top"><div align="center">
          <table width="100%" height="363" border="0" cellpadding="00" cellspacing="0">
            <tr>
              <td width="22%" height="363" align="left" valign="top"><table width="100%"  border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td><a href="index.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','Images/MNUBTH_1.png',1)"><img src="Images/MNUBTH_0.png" name="Image12" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="history.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','Images/MNUBT1_1.png',1)"><img src="Images/MNUBT1_0.png" name="Image1" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKDiComm.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','Images/MNUBT2_1.png',1)"><img src="Images/MNUBT2_0.png" name="Image2" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKResultSK.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','Images/MNUBT3_1.png',1)"><img src="Images/MNUBT3_0.png" name="Image3" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PkSocial.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','Images/MNUBT4_1.png',1)"><img src="Images/MNUBT4_0.png" name="Image4" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKLaw.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','Images/MNUBT5_1.png',1)"><img src="Images/MNUBT5_0.png" name="Image5" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKQA.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','Images/MNUBT6_1.png',1)"><img src="Images/MNUBT6_0.png" name="Image6" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKSWork.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','Images/MNUBT7_1.png',1)"><img src="Images/MNUBT7_0.png" name="Image7" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKSP.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','Images/MNUBT8_1.png',1)"><img src="Images/MNUBT8_0.png" name="Image8" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td><a href="PKSumAcc.asp" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','Images/MNUBT9_1.png',1)"><img src="Images/MNUBT9_0.png" name="Image9" width="162" height="35" border="0"></a></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF"><div align="center"><a href="hotline4.asp"><img src="hotline_1.png" width="162" height="35" border="0"></a></div></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF"><div align="center"><a href="road.asp"><img src="images/ba1.gif" width="140" height="76" border="0"></a></div></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF"><div align="center"></div></td>
                </tr>
                <tr>
                  <td><div align="center" class="textnormal">
                    <!-- InstanceBeginEditable name="EditCouter" -->
                    <a href="http://www.pobsook.com">                    </a>
                    <table width="100%" height="48"  border="0" cellpadding="00" cellspacing="0">
                      <tr>
                        <td><div align="center">
                          <p><b class="txt">
                            </b>ท่านเป็นผู้เยี่ยมชมลำดับที่ <br>
                                <b class="txt">                              </b> <span class="txt"><b class="txt">
                                </b></span><%Set FileObject = Server.CreateObject("Scripting.FileSystemObject")
	hitsfile = Server.MapPath("database/counter.txt")
	Set instream= FileObject.OpenTextFile (hitsfile, 1, False )
                oldhits = instream.ReadLine 
	newhits = oldhits + 1 
	Set outstream= FileObject.CreateTextFile (hitsfile, True)
	OutStream.WriteLine(newhits) 
              l=Len(newhits)

	For i = 1 to l 

			num = Mid(newhits,i,1)

			display = display & "<img src= """ & num & ".gif"">"
			
		Next
%>
                                </b><%=display%></span><br>
    นับตั้งแต่วันที่ 15 ตุลาคม 2547</p>
                          </div></td>
                      </tr>
                      <tr>
                        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><a href="http://pobsook.com"><img src="File_tem/new.gif" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><img src="File_tem/center.jpg" width="172" height="70" border="0"></td>
                            </tr>
                            <tr>
                              <td><a href="result.asp" target="_blank"><img src="File_tem/25500001.gif" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="health.asp"><img src="File_tem/book.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="board.asp"><img src="File_tem/meeting.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="meet1.asp"><img src="File_tem/meet1.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="justice.asp"><img src="File_tem/2552.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="H5N1.asp"><img src="File_tem/bird.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><img src="File_tem/die.jpg" width="170" height="70"></td>
                            </tr>
                            <tr>
                              <td><a href="village_law.asp"><img src="File_tem/HOME.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="http://www.oic.go.th/content/citizen.htm" target="_blank"><img src="File_tem/oic.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><a href="http://nonthaburi.police.go.th" target="_blank"><img src="File_tem/police.jpg" width="170" height="70" border="0"></a></td>
                            </tr>
                            
                            <tr>
                              <td><a href="public_health.asp"><img src="File_tem/health2.png" width="170" height="70" border="0"></a></td>
                            </tr>
                            <tr>
                              <td><img src="File_tem/aids.jpg" width="170" height="70"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                          </table>                          </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                    <!-- InstanceEndEditable --></div></td>
                </tr>
              </table></td>
              <td width="78%" align="left" valign="top"><!-- InstanceBeginEditable name="Editbody1" -->
                <table width="100%"  border="0" cellpadding="00" cellspacing="0" class="textnormal">
                  <tr>
                    <td height="1154" align="left" valign="top"><table width="100%" height="1824"  border="0" cellpadding="00" cellspacing="0">
                        <tr bgcolor="#FFFFCC">
                          <td width="73%" height="1824" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="00">
                              <tr>
                                <td bgcolor="#FFFFFF"><b class="txt"> </b><img src="images/zhome_pic1.jpg" width="432" height="170"><b class="txt"> </b></td>
                              </tr>
                              <tr>
                                <td bgcolor="#FFFFFF"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="432" height="84">
                                    <param name="movie" value="Images/barsnews.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/barsnews.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="432" height="84"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td height="1602" align="left" valign="top"><table width="100%" height="1602"  border="0" cellpadding="00" cellspacing="0">
                                    <tr>
                                      <td height="1602" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellpadding="00" cellspacing="0" class="textnormal">
                                          <tr>
                                            <td><% 
While ((Repeat1__numRows <> 0) AND (NOT RsSNews.EOF)) 
%>
                                                <table width="100%" height="13"  border="0" cellpadding="3" cellspacing="0">
                                                  <tr>
                                                    <td width="3%" height="13" align="left" valign="top"><img src="Images/pfeil_blue.gif" width="15" height="9"></td>
                                                    <td width="97%" align="left" valign="top">&nbsp;<a href="SHNews.asp?NewsID=<%=(RsSNews.Fields.Item("NewsID").Value)%>" target="_blank"><%=(RsSNews.Fields.Item("NewsTopic").Value)%></a> (<%=(RsSNews.Fields.Item("NewsDate").Value)%>)
                                                        <% if RsSNews.Fields.Item("NewsShow").Value = 1 then %>
                                                        <img src="images/newup.gif" width="34" height="7">
                                                        <% End if %>
                                                    </td>
                                                  </tr>
                                                </table>
                                                <% 
  Repeat1__index=Repeat1__index+1
  Repeat1__numRows=Repeat1__numRows-1
  RsSNews.MoveNext()
Wend
%></td>
                                          </tr>
                                          <tr>
                                            <td><div align="right"><a href="New3_AllNews.asp"><img src="images/ReadPreNews.jpg" width="179" height="33" border="0"></a></div></td>
                                          </tr>
                                        </table>
                                          <div align="center"><br>
                                          </div>
                                          <table width="100%"  border="1" cellpadding="3" cellspacing="0" bordercolor="#996633" bgcolor="#C19B77">
                                            <tr>
                                              <td bgcolor="#C19B77"><div align="right"><b class="txt"> </b></div></td>
                                            </tr>
                                          </table>
                                          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td bgcolor="#FFE4CA"><table width="100%" border="0">
                                                <tr>
                                                  <td bgcolor="#FFCC99"><table width="100%" border="1">
                                                      <tr>
                                                        <td><div align="center"><img src="File_tem/aword1.jpg" width="600" height="300"></div></td>
                                                      </tr>
                                                    </table>
                                                    <table width="100%" border="1">
                                                      <tr bgcolor="#B4D8B2">
                                                        <td><img src="File_tem/No.2.jpg" width="600" height="280" border="0"></td>
                                                      </tr>
													     <tr bgcolor="#B4D8B2">
                                                        <td><div align="center"><a href="File_tem/articles_municipalities.doc"><img src="File_tem/articel_man.jpg" width="600" height="100" border="0"></a></div></td>
                                                      </tr>
													  <tr bgcolor="#B4D8B2">
                                                        <td height="304"><div align="center"><a href="http://www.pakkretcity.go.th/SHNews.asp?NewsID=912"><img src="File_tem/3sh.jpg" width="600" height="300" border="0"></a></div></td>
                                                      </tr>
                                                    </table>
                                                    <table width="100%" border="1">
                                                      <tr bgcolor="#99CCFF">
													  
                                                        <td><table width="100%" border="0">
                                                          <tr>
                                                            <td><div align="center"><strong><img src="images/new1.GIF" width="30" height="15"><u>กำหนดชำระภาษีเทศบาลนครปากเกร็ด</u></strong><u></u></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                              <strong>ผู้มีอาคาร/โรงเรือน/ป้าย  ที่ใช้ประกอบกิจการค้า ให้เช่า หรือที่ดิน ในพื้นที่เทศบาลนครปากเกร็ด  ขอให้ตรวจสอบเพื่อยื่นแบบและชำระภาษีดังนี้</strong><strong> </strong><br>
                                                              <ol>
                                                                <li><strong>ภาษีโรงเรือนและที่ดิน</strong><strong>: ตั้งแต่บัดนี้ถึง 28 กุมภาพันธ์  2553</strong></li>
                                                                <li><strong>ภาษีบำรุงท้องที่ </strong><strong>: ตั้งแต่บัดนี้ถึง   30 เมษายน  2553</strong></li>
                                                                <li><strong>ภาษีป้าย </strong><strong>: ตั้งแต่บัดนี้ถึง  31  มีนาคม 2553</strong></li>
                                                              </ol>
                                                              <p align="center"><strong>สอบถามและยื่นตามกำหนดที่สำนักการคลัง  ชั้น </strong><strong>3 </strong><br>
                                                                  <strong>โทร </strong><strong>02  9609704-14   ต่อ 310 </strong><br>
                                                                  <strong>วันเวลาราชการ</strong><strong> </strong><br>
                                                                  <strong>(ถ้ามีใบแจ้งหนี้ภาษี  สามารถชำระผ่านธนาคารกรุงไทย โดยจ่ายค่าธรรมเนียม </strong><strong>10 บาท)</strong><br>
                                                                  <strong>ทั้งนี้เทศบาลนครปากเกร็ดงดบริการชำระภาษีในวันหยุดราชการ</strong></p>
                                                              <p align="center" class="style107">พลเมืองดีปากเกร็ด     ชำระภาษีตามเวลา     ไม่เสียค่าปรับ</p></td>
                                                          </tr>
                                                          <tr>
                                                            <td><strong>&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
                                                          </tr>
                                                        </table></td>
                                                      </tr>
                                                    </table>
                                                    <table width="100%" border="1">
                                                      <tr>
                                                        <td valign="top" bgcolor="#FFCC66"><p align="center"><strong><img src="images/new1.GIF" width="30" height="15"></strong><span class="style109">การประชาสัมพันธ์การยื่นแบบทาง Internet สำหรับการยื่นแบบ ภ.ง.ด.90, 91 ประจำปี 2552 </span></p></td>
                                                      </tr>
                                                      <tr bgcolor="#FFCCFF">
                                                        <td valign="top" bgcolor="#FFFF66"><table width="100%" border="0">
                                                          <tr>
                                                            <td> <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span class="style109">ด้วยขณะนี้ใกล้ถึงเวลา  การยื่นแบบภาษีเงินได้บุคคลธรรมดา ประจำปี 2552 (ภ.ง.ด.90 , 91 ) ภายในเดือน มกราคม-มีนาคม 2553  นั้น<br>                                                                       สำนักงานสรรพากรพื้นที่สาขาพื้นที่สาขาปากเกร็ด  1 ขอประชาสัมพันธ์การยื่นแบบทาง Internet ประจำปี 2552 แต่เนิ่น ๆ  ให้ผู้มีเงินได้บุคคลธรรมดาสำหรับภาคหน่วยงานราชการ-และภาคเอกชน  มีพนักงานเป็นจำนวนมากให้ช่วยประชาสัมพันธ์ ให้พนักงาน ยื่นแบบทาง Internet  เพื่อเป็นการประหยัดค่าใช้จ่ายและประหยัดเวลาในการเดินทางไปยื่นแบบฯ  ณ สำนักงานสรรพากรพื้นที่สาขา การยื่นแบบดำเนินการโดยเข้า <a href="http://www.rd.go.th">www.rd.go.th</a> (ตามเอกสารแนบ)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ประโยชน์ที่จะได้รับจากการใช้บริการ</span><br>
                                                            </div></td>
                                                          </tr>
                                                          <tr>
                                                            <td><ol class="style112">
                                                                <li class="style109"> ประหยัดเวลาและค่าใช้จ่ายในการเดินทางไปยื่นแบบฯ  และชำระภาษี ณ สำนักงานสรรพากรพื้นที่สาขาฯ </li>
                                                                <li class="style109">ได้รับสิทธิพิเศษในการยื่นแบบฯ  หลังเวลา 16-30 น. จนถึงเวลา 24.00 น. ของทุกวันระหว่างช่วงกำหนดเวลาของการยื่นแบบฯ ตามปกติ  โดยไม่เว้นวันหยุดราชการ</li>
                                                                <li class="style109">มีโปรแกรมที่จะช่วยตรวจสอบข้อมูลขั้นต้นตามแบบแสดงรายการที่กรอกไว้ในแบบฯและหากพบข้อมูลที่ผิดพลาดบางกรณี  ระบบจะส่งรายการเตือนกลับไปในทันทีเพื่อท่านจะได้แก้ไขให้ได้ถูกต้อง  และเพื่อความมั่นใจว่ากรมสรรพากรได้รับแบบฯ  และชำระภาษีเรียบร้อยแล้วจะมีหลักฐานเพื่อยืนยัน    2 ระดับ ดังนี้</li>
                                                                <li class="style109">ยืนยันการรับแบบฯ  และชำระภาษี(ถ้ามี) ทางจดหมายอิเล็กทรอนิกส์(e-mail) ในวันถัดไป</li>
                                                                <li class="style109">ยืนยันการรับแบบฯ  และชำระภาษี(ถ้ามี) โดยใบเสร็จรับเงินที่จัดส่งไปทางไปรษณีย์ลงทะเบียน </li>
                                                              </ol>
                                                              <p class="style109"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หากท่านมีข้อสงสัยประการใดสามารถติดต่อ  ณ สำนักงานสรรพากรพื้นที่สาขาปากเกร็ด 1 ที่ตั้งอยู่บริเวณห้าแยกปากเกร็ด ตามวัน และเวลาราชการการ หรือ  โทรสอบถามได้ที่ 02-9604698-9 (คุณรัชนี,คุณพุดตาล)<br>
                                                                จึงเรียนมาเพื่อทราบ <br>
                                                                                                                                             <u>สำนักงานสรรพากรพื้นที่สาขาปากเกร็ด 1</u><br>
                                                                                                             <u>ศูนย์แนะนำและประชาสัมพันธ์การยื่นแบบทางอินเตอร์เน็ตโทร.02-9604698-9 </u></strong></p></td>
                                                          </tr>
                                                         <tr>
                                                            <td bgcolor="#FFCC66"><div align="center" class="style105"><strong><img src="images/new1.GIF" width="30" height="15"></strong>
                                                                <strong>เอกสารที่ใช้ประกอบในการยื่นแบบคำขอยื่นแบบ <br>
                                                                และชำระภาษีผ่านอินเทอร์เน็ต ภ.อ.01
                                                                </p>
                                                                    </strong></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td valign="top"><div align="left"><u><span class="style105"><strong></strong></span></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. ข้อตกลงในการยื่นแบบแสดงรายการและชำระภาษีผ่านเครือข่ายอินเทอร์เน็ต  (แบบข้อตกลง) <br>
                                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. กรณีเป็นบุคคลธรรมดา  ต้องแนบภาพถ่ายบัตรประจำตัวประชาชนของผู้เสียภาษีที่ได้ลงลายมือชื่อ  <br>
                                                              &nbsp;&nbsp;&nbsp;&nbsp;3. กรณีเป็นนิติบุคคล  ต้องแนบสำเนาหรือภาพถ่ายหนังสือรับรองของนายทะเบียน  หุ้นส่วนบริษัท  ฉบับปัจจุบันที่มีระยะเวลาไม่เกิน 6 เดือน นับแต่วันที่นายทะเบียน   หุ้นส่วนบริษัทได้ลงลายมือชื่อ และ ภาพถ่ายบัตรประชาชนหรือใบสำคัญต่างด้าว  ของผู้มีอำนาจผูกพันกับนิติบุคคลนั้น โดยผู้มีอำนาจดังกล่าวได้ลงลายมือชื่อรับรองในภาพถ่ายด้วย  <br>
															  &nbsp;&nbsp;&nbsp;&nbsp;4. กรณีมอบอำนาจให้ผู้อื่นทำการแทน  ต้องทำหนังสือมอบอำนาจ (ติดอากร 10 บาท)  พร้อมแนบภาพถ่ายบัตรประชาชนของผู้มอบอำนาจและผู้รับมอบอำนาจที่ได้ลงลายมือชื่อรับรองในภาพถ่าย<br> 
															  <p align="center"><img src="images/RDS1.jpg" alt="" width="170" height="152"></p>
                                                            </div></td>
                                                          </tr>
                                                          
                                                        </table>                                                        
                                                          </td>
                                                      </tr>
                                                    </table>                                                    
                                                    <table width="100%" border="1">
                                                      <tr>
                                                        <td><img src="File_tem/2009.gif" width="600" height="198"></td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                
                                              </table></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                              <td bgcolor="#FFE4CA"><table width="100%" border="1">
                                                <tr>
                                                  <td width="21%"><div align="center"><img src="File_tem/telephone.jpg" width="120" height="78"></div></td>
                                                  <td width="79%"><div align="center"><span class="style43"><strong><strong><img src="images/hot%5B1%5D.gif" width="21" height="9"></strong> <span class="style71">ผู้ใดพบเห็นการทุจริตในหน้าที่ <br>
                                                    และการให้บริการที่ไม่สุภาพ<br>
                                                    ของเจ้าหน้าที่เทศบาลนครปากเกร็ด<br>
                                                    โปรดแจ้ง โทร. 0-2960-9700 - 1 , 0-2583-6668<br>
                                                    หรือ www.pakkretcity.go.th (สายตรงเทศบาล) </span></strong></span></div></td>
                                                  </tr>
                                              </table></td>
                                            </tr>
                                            
                                            <tr>
                                              <td bgcolor="#FFFFFF">&nbsp;</td>
                                            </tr>
                                          </table>
                                          <p>&nbsp;</p></td>
                                    </tr>
                                  </table>
                                    <div align="center"></div></td>
                              </tr>
                            </table>
                              <div align="center">
                                <div align="left"> </div>
                            </div></td>
                          <td width="27%" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="1">
                              <tr>
                                <td><a href="OLD_File/mayor.pdf"><img src="images/BMNU1.jpg" width="162" height="70" longdesc="images/BMNU1.jpg"></a></td>
                              </tr>
                              <tr>
                                <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                    <param name="movie" value="Images/BMNUE1-1.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/BMNUE1-1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                    <param name="movie" value="Images/BMNUE3.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/BMNUE3.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                    <param name="movie" value="Images/BMNUE4.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/BMNUE4.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                    <param name="movie" value="Images/BMNUE5.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/BMNUE5.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                    <param name="movie" value="Images/BMNU6.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/BMNU6.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td height="72"><p> <a href="Dlform1.asp" target="_self"> </a>
                                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                          <param name="movie" value="Images/BMNU7.swf">
                                          <param name="quality" value="high">
                                          <embed src="Images/BMNU7.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                        </object>
                                </p></td>
                              </tr>
                              <tr>
                                <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="162" height="70">
                                    <param name="movie" value="Images/BMNU8.swf">
                                    <param name="quality" value="high">
                                    <embed src="Images/BMNU8.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="162" height="70"></embed>
                                </object></td>
                              </tr>
                              <tr>
                                <td bgcolor="#FFE4CA"><p align="center"><a href="http://www.pakkretcity.go.th/Mod_ShowOPTopic.asp?OPID=17" target="_blank"> <strong> </strong> </a><a href="OLD_File/map.pdf" target="_blank"><img src="images/map_pkk.jpg" width="162" height="70"></a></p></td>
                              </tr>
                              
                              <tr>
                                <td bgcolor="#FFE4CA"><div align="center"><a href="OLD_File/Municipality.pdf" target="_blank"><img src="images/municipality.jpg" width="162" height="70"></a></div></td>
                              </tr>
                             
                              <tr>
                                <td bgcolor="#FFE4CA"><div align="center"><a href="Enough.asp"  target="_blank"> <img src="images/Enough.jpg" width="162" height="70"></a></div></td>
                              </tr>
                             <tr>
                                <td bgcolor="#FFE4CA"><div align="center"><a href="result_community.asp" target="_blank"><img src="images/Untitled-1.jpg" width="162" height="70"></a></div></td>
                              </tr>
                              <tr>
                                <td bgcolor="#FFE4CA"><div align="center"><a href="new_center.asp" target="_blank">ศูนย์ข้อมูลข่าวสาร<br>
                                  เทศบาลนครปากเกร็ด </a></div></td>
                              </tr>
                              <tr>
                                <td height="18" bgcolor="#FFCC99"><div align="center">
                                    <p><a href="library.asp" target="_blank">ห้องสมุดเทศบาลนครปากเกร็ด</a></p>
                                </div></td>
                              </tr>
                              <tr>
                                <td bgcolor="#FFE4CA"><div align="center"><a href="report_com.asp" target="_blank">การประชุมคณะกรรมการชุมชน</a></div></td>
                              </tr>
                              <tr>
                                <td bgcolor="#FFCC99"><div align="center"><strong><span class="style61">&nbsp;</span></strong> <a href="water_50.asp" target="_blank">สถานการณ์น้ำ</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFE4CA"><div align="center"><a href="fire.asp" target="_blank">ป้องกันอัคคีภัย</a><br>
                                </div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFCC99"><div align="center"><a href="command_money.asp" target="_blank">การขอรับเงินอุดหนุน<br>
                                  เทศบาลนครปากเกร็ด</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFE4CA"><div align="center"><a href="ggpk.asp" target="_blank">การปรับปรุงขั้นตอนและ<br>
                                  ระยะเวลาการปฏิบัติราชการ</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFCC99"><div align="center"><a href="problem.asp" target="_blank">เสนอปัญหา/ความต้องการ<br>
                                  และโครงการพัฒนา</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFE4CA"><div align="center"><a href="File_tem/narcotic.pdf" target="_blank">ศูนย์ปฏิบัติการต่อสู้<br>
                                  เพื่อเอาชนะยาเสพติด<br>
                                  เทศบาลนครปากเกร็ด</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFCC99"><div align="center"><a href="refuse.asp" target="_blank">บริการเก็บกิ่งไม้ / วัสดุก่อสร้าง</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFE4CA"><div align="center"><a href="File_tem/com_found.doc" target="_blank">สถาบันการเงิน<br>
                                  ชุมชนปากเกร็ดร่วมใจ 2</a> </div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFCC99"><div align="center"><a href="File_tem/learning53.xls" target="_blank">ปฏิทินฝึกอบรมอาชีพ<br>
                                  ประจำปีงบประมาณ 2553</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFE4CA"><div align="center"><a href="File_tem/acc_52.xls" target="_blank">บัญชีจัดสรรเงินอุดหนุน<br>
                                  ประจำปีงบประมาณ 2552</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFCC99"><div align="center"><a href="File_tem/dog_53.pdf" target="_blank">แผนปฏิบัติงานรณรงค์<br>
                                  ป้องกันโรคพิษสุนัขบ้า <br>
                                  ประจำปี 2553</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFE4CA"><div align="center"><a href="File_tem/old53.pdf" target="_blank">แผนปฏิบัติงานผู้สูงวัยพลานามัยดี<br>
                                  ประจำปี 2553</a></div></td>
                              </tr>
                              <tr>
                                <td height="15" bgcolor="#FFCC99"><div align="center"><a href="File_tem/doc.doc" target="_blank">แผนปฏิบัติงานออกหน่วย<br>
                                  สาธารณสุขเคลื่อนที่เชิงรุก<br>
                                  ประจำปี 2552</a></div></td>
                              </tr>
                              
                              
                            </table>
                              <blockquote>&nbsp;</blockquote></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
              <!-- InstanceEndEditable --></td>
              </tr>
          </table>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="761" border="1" cellpadding="3" cellspacing="0" bordercolor="#996600" bgcolor="#C19B77">
  <tr>
    <td width="757" height="34" class="textnormal"><div align="center">สำนักงานเทศบาลนครปากเกร็ด เลขที่ 1 หมู่ 5 ถนนแจ้งวัฒนะ ต.ปากเกร็ด อ.ปากเกร็ด จ.นนทบุรี 11120<br>
      โทรศัพท์ 0-2960-9704-14 โทรสาร 0-2960-9703 <br>
      ติดต่อผู้ดูแลระบบ : <a href="mailto:webmaster@pakkretcity.go.th">webmaster@pakkretcity.go.th</a> </div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<%
RsSNews.Close()
Set RsSNews = Nothing
%>
