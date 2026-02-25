<style type="text/css">
    html, body {
        margin: 0px;
        display: block;
        width: 100%;
        height: 100%;
        background-color: <?php echo ($intro['color'] !='') ? $intro['color'] : '#fff';?>;
    }
    h1, h2 {margin: 0;}
    .menu {
        height: 50px;
        width: 450px; margin:0 auto; padding-top:840px;

    }
    .prathep {
        width: auto;
        height: 100%;
        display: block;
        margin: 0 auto;

        /*width: 1425px;
        height: 930px;*/
        position: relative;
        overflow: hidden;
    }
    /*.prathep>a {position: absolute; bottom: 20px;}*/
    .prathep>img {
        height: 100%;
        width: auto;
        display: block;
        margin: 0 auto;
        text-align:center;
        position: absolute;
        left: 50%;
        top: 50%;
        -moz-transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .content-text {text-indent: -99999px; display: none;}
    .button-group {
        width: 450px;
        height: 50px;
        position: absolute;
        bottom: 25px;
        left: 50%;
        margin-left:  -340px;
        z-index: 2;
    }
    .home{display:block; width:220px; height:50px; float: right;}

</style>
<div class="prathep">
    <div class="button-group">
        <a href="<?php echo site_url('home');?>" class="home"></a>
    </div>
    <img src="<?php echo site_assets_url('images/intro/'.$intro['image']);?>" title="<?php echo $intro['title'];?>" alt="<?php echo $intro['title'];?>"/>

</div>