<!-- Static navbar -->
<nav class="navbar-default navbar-fixed-top visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-xs" href="<?php echo site_url('home');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/home_40x40.png')?>" width="40" height="40" alt=""/></a>
            <a class="navbar-brand visible-xs" href="<?php echo site_url('home');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/logo_40x40.png')?>" width="40" height="40" alt=""/></a>
        </div>
        <?php if(isset($menulist)):?>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php foreach ($menulist as $menu):?>
                        <li <?php echo (!empty($menu['sub_menu'])) ? 'class="dropdown"':''?>><a <?php echo (!empty($menu['sub_menu'])) ? 'class="dropdown-toggle main-menu" data-toggle="dropdown"':'class="main-menu"'?> href="<?php echo ($menu['type']=='content')? site_url('content/'.$menu['id']):$menu['url'];?>"><?php echo $menu['name'];?><?php echo (!empty($menu['sub_menu'])) ? '<span class="caret"></span>':''?></a>
                            <?php if(!empty($menu['sub_menu'])):?>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach ($menu['sub_menu'] as $sub_menu):?>
                                        <li><a href="<?php echo ($sub_menu['type']=='content')? site_url('content/'.$sub_menu['id']):$sub_menu['url'];?>"><?php echo $sub_menu['name'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        </li>
                    <?php endforeach;?>
                </ul>

                <a  href="<?php echo site_url('home');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/th.png')?>"  alt=""/></a>
                <a  href="<?php echo site_url('content/21');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/en.png')?>"  height="29" alt=""/></a>

            </div><!--/.nav-collapse -->
        <?php endif;?>



    </div><!--/.container-fluid -->
</nav>
<!-- Static navbar -->
<nav class="navbar navbar-default hidden-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-xs" href="<?php echo site_url('home');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/home_40x40.png')?>" width="40" height="40" alt=""/></a>
            <a class="navbar-brand visible-xs" href="<?php echo site_url('home');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/logo_40x40.png')?>" width="40" height="40" alt=""/></a>
        </div>
        <?php if(isset($menulist)):?>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php foreach ($menulist as $menu):?>
                        <li <?php echo (!empty($menu['sub_menu'])) ? 'class="dropdown"':''?>><a <?php echo (!empty($menu['sub_menu'])) ? 'class="dropdown-toggle main-menu" data-toggle="dropdown"':'class="main-menu"'?> href="<?php echo ($menu['type']=='content')? site_url('content/'.$menu['id']):$menu['url'];?>"><?php echo $menu['name'];?><?php echo (!empty($menu['sub_menu'])) ? '<span class="caret"></span>':''?></a>
                            <?php if(!empty($menu['sub_menu'])):?>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach ($menu['sub_menu'] as $sub_menu):?>
                                        <li><a href="<?php echo ($sub_menu['type']=='content')? site_url('content/'.$sub_menu['id']):$sub_menu['url'];?>"><?php echo $sub_menu['name'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        </li>
                    <?php endforeach;?>
                </ul>

                <a  href="<?php echo site_url('home');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/th.png')?>"  alt=""/></a>
                <a  href="<?php echo site_url('content/21');?>"><img src="<?php echo site_assets_url('layouts/frontend/images/en.png')?>"  height="29" alt=""/></a>

            </div><!--/.nav-collapse -->
        <?php endif;?>



    </div><!--/.container-fluid -->
</nav>
<?php if(isset($slider)):?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="border-color: #33b1e6;border-style: solid;border-width: 10px 10px 0;">
    <ol class="carousel-indicators">
        <?php foreach ($slider as $index=>$rows): ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $index;?>" <?php echo ($index == 0)?'class="active"':'';?>></li>
        <?php endforeach;?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach ($slider as $index=>$rows): ?>
        <div class="item <?php echo ($index == 0)?'active':'';?>">
            <a href="<?php echo $rows['link'];?>" target="_blank">
                <img src="<?php echo site_assets_url('images/slide/'.$rows['image']);?>" title="<?php echo $rows['title'];?>" width="1140" height="500" alt="one"/>

            </a>
            <div class="carousel-caption" style="bot">
                <h4><?php echo $rows['title'];?></h4>
            </div>

        </div>
        <?php endforeach;?>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?php endif;?>
<div class="clearfix"></div>