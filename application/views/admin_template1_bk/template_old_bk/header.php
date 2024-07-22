            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo site_url('control/template1');?>" title="THAI OLDER">
                            <div class="row">
                                <div class="col-sm-10 hidden-xs" style="padding-left: 20px;">
                                    <img width="47" height="47" src="<?php echo path('image9.png','webconfig');?>" alt="Chania">
                                </div>
                                <div class="col-sm-12 hidden-sm hidden-md hidden-lg">
                                    <img width="40" height="40" style="margin-top: -5px;" class="img-responsive" width="100%" src="<?php echo path('image9.png','webconfig');?>" alt="Chania">

                                </div>
                                <div class="col-sm-2 hidden-xs">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse hidden-xs" id="myNavbar">
                            <a id="bt_menu" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-menu-hamburger"></span>
                            </a>
                        <!--
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Deals</a></li>
                            <li><a href="#">Stores</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                        -->
                        <ul class="nav navbar-nav navbar-right" style='z-index:10000;'>
                            <li title="Message">
                                <a href="#"><img id="message" width="20px" height="16px" src="<?php echo path('Messaging-Message-icon.png','webconfig');?>"></a>
                            </li>
                            <li title="เทิดศักดิ์ พาคินสัน">
                                <a href="#"><img src="<?php echo path('tmp.jpg','webconfig');?>" class="profile img-circle border-1" alt="Cinque Terre" width="40" height="40"> เทิดศักดิ์ พาคินสัน </a>
                            </li>
                            <li title="Sign Out"><a href="<?php echo site_url('manage/logout');?>"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
                            <li title="Help"><a href="./index.html"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                        </ul>
                    </div>
                </div>
            </nav>



