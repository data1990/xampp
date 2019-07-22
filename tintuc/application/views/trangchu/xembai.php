<div id="info-detail-box" class="wrap">
    <div class="news-list-block news-detail">
        <div class="title-block">
            
            <div class="breadcrumb">
                <ul class="clearfix">
                    <li><a href="">Trang chủ</a>
                    </li>
                    <li><a href="<?php echo $chuyenmuc ?>"><?php echo $chuyenmuc ?></a>
                    </li>
                    <li><a href=""><?php echo substr($row->tieude,0,50).'...' ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="news-detail-box">
            <div class="news-title clearfix">
                <h2><a href=""><?php echo $row->tieude ?></a></h2>
                <p class="date"><?php echo $row->ngay ?></p>
            </div>
            <div class="txt-content">
                <?php echo $row->noidung ?>
            </div>
            <div class="related-news">
                <h3>Tin Tức liên quan</h3>
                <ul>
                	<?php foreach($list as $row) { ?>
                    <li><a href="<?php echo $row->slug ?>"><?php echo $row->tieude ?><span class="date"><?php echo $row->ngay ?></span></a>
                    </li>
                <?php } ?>
                   

                </ul>
            </div>
        </div>
    </div>
</div>