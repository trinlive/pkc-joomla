<!-- start: SIDEBAR -->
<div class="main-navigation navbar-collapse collapse">
<!-- start: MAIN MENU TOGGLER BUTTON -->
<div class="navigation-toggler">
    <i class="clip-chevron-left"></i>
    <i class="clip-chevron-right"></i>
</div>
<!-- end: MAIN MENU TOGGLER BUTTON -->
<!-- start: MAIN NAVIGATION MENU -->
<ul class="main-navigation-menu">
<li class="active open">
    <a href="<?php echo site_url('administator/dashboard');?>"><i class="clip-home-3"></i>
        <span class="title"> หน้าแรก </span><span class="selected"></span>
    </a>
</li>
<li>
    <a href="javascript:void(0)"><i class="clip-screen"></i>
        <span class="title"> จัดการเมนู </span><i class="icon-arrow"></i>
        <span class="selected"></span>
    </a>
    <ul class="sub-menu">
        <li ><a href="<?php echo site_url('administator/preference/menu');?>"><span class="title">จัดการเมน</span>ู</a></li>
        <li ><a href="<?php echo site_url('administator/preference/slide');?>"><span class="title">จัดการรูปภาพสไลด์</span></a></li>
        <li ><a href="<?php echo site_url('administator/preference/intro');?>"><span class="title">จัดการ Intro</span></a></li>
        <li ><a href="<?php echo site_url('administator/preference/link');?>"><span class="title">จัดการ Links</span></a></li>
        <li ><a href="<?php echo site_url('administator/preference/highlight ');?>"><span class="title">จัดการเมนู Highlight</span></a></li>
        <li ><a href="<?php echo site_url('administator/preference/content ');?>"><span class="title">จัดการเมนู Content</span></a></li>
        <li ><a href="<?php echo site_url('administator/preference/users ');?>"><span class="title">จัดการ ผู้ใช้งาน </span></a></li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)"><i class="clip-screen"></i>
        <span class="title"> รายงานงบการเงิน </span><i class="icon-arrow"></i>
        <span class="selected"></span>
    </a>
    <ul class="sub-menu">
        <li ><a href="<?php echo site_url('administator/media/financial_statement?cate=1');?>"><span class="title">การโอนเงินงบประมาณรายจ่ายประจำปี</span> </a></li>
        <li ><a href="<?php echo site_url('administator/media/financial_statement?cate=2');?>"><span class="title">งบการเงิน </span></a></li>
        <li ><a href="<?php echo site_url('administator/media/financial_statement?cate=3');?>"><span class="title">งบแสดงฐานะการเงิน </span></a></li>
        <li ><a href="<?php echo site_url('administator/media/financial_statement?cate=4');?>"><span class="title">รายงานแสดงผลการดำเนินงาน </span></a></li>
        <li ><a href="<?php echo site_url('administator/media/financial_statement?cate=5');?>"><span class="title">ประกาศรายงานการรับจ่ายเงิน </span></a></li>
    </ul>
</li>
    <li>
        <a href="javascript:void(0)"><i class="clip-screen"></i>
            <span class="title"> รายงานการประชุม</span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li ><a href="<?php echo site_url('administator/media/meeting?cate=1');?>"><span class="title">การประชุมสภาเทศบาล</span> </a></li>
            <li ><a href="<?php echo site_url('administator/media/meeting?cate=2');?>"><span class="title">การประชุมหัวหน้าส่วนราชการ </span></a></li>
            <li ><a href="<?php echo site_url('administator/media/meeting?cate=3');?>"><span class="title">รายงานการประชุมคณะกรรมการชุมชน </span></a></li>
           >
        </ul>
    </li>
    <li>
        <a href="javascript:void(0)"><i class="clip-screen"></i>
            <span class="title"> จัดการคอนเทน </span><i class="icon-arrow"></i>
            <span class="selected"></span>
        </a>
        <ul class="sub-menu">
            <li ><a href="<?php echo site_url('administator/media/news/pr');?>"><span class="title">จัดการข่าวประชาสัมพันธ์</span></a></li>
            <li ><a href="<?php echo site_url('administator/media/news/event');?>"><span class="title">จัดการข่าวกิจกรรม</span></a></li>
            <li ><a href="<?php echo site_url('administator/media/news/seminars');?>"><span class="title">จัดการข่าวโครงการ/สัมนา</span></a></li>
            <li ><a href="<?php echo site_url('administator/media/special');?>"><span class="title">จัดการข่าวกิจกรรมพิเศษ</span></a></li>
            <li ><a href="<?php echo site_url('administator/media/activity');?>"><span class="title">จัดการภาพกิจกรรม</span></a></li>
            <li ><a href="<?php echo site_url('administator/media/call');?>"><span class="title">จัดการสายตรงเทศบาล</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/poll');?>"><span class="title">จัดการ โพล</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/download');?>"><span class="title">จัดการ ดาวน์โหลด</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/service');?>"><span class="title">จัดการ  บริการประชาชน</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/jobs');?>"><span class="title">จัดการ งานน่ารู้</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/planauction');?>"><span class="title">จัดการ แผนการจัดซื้อ/จัดจ้าง</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/auction');?>"><span class="title">จัดการ ประกาศจัดซื้อ/จัดจ้าง</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/rightauction');?>"><span class="title">จัดการ ผู้มีสิทธิเสนอราคาจัดซื้อ/จัดจ้าง</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/finauction');?>"><span class="title">จัดการ ผลการดำเนินการจัดซื้อ/จัดจ้าง</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/reportauction');?>"><span class="title">จัดการ รายงานผลการปฏิบัติการจัดซื้อ/จัดจ้าง</span></a></li>
            <li> <a href="<?php echo site_url('administator/media/checkauction');?>"><span class="title">จัดการ ตรวจรับงานจัดซื้อ/จัดจ้าง</span></a></li>
        </ul>
    </li>

</ul>
<!-- end: MAIN NAVIGATION MENU -->
</div>
<!-- end: SIDEBAR -->