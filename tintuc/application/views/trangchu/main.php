<div class="wrap">
    <div id="banner-slider-box" class="banner-slider">
        <div class="">
            <div class="bx-wrapper" style="max-width: 100%;">
                <div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 250px;">
                    <ul class="bn-slide" style="width: 515%; position: relative; transition-duration: 0.5s; transform: translate3d(-1340px, 0px, 0px);">
                        <li style="float: left; list-style: none; position: relative; width: 670px;" class="bx-clone">
                            <a href="https://360game.vn/dtbs/redirect?token=MjAwmw&amp;" target="_blank"><img src="https://img.f.360game.vn/banner/dtb-upload/bi kiep san code-1537758661967.png" alt="nth360game">
                            </a>
                        </li>
                        <li style="float: left; list-style: none; position: relative; width: 670px;">
                            <a href="https://360game.vn/dtbs/redirect?token=MjAwnQ&amp;" target="_blank"><img src="https://img.f.360game.vn/banner/dtb-upload/672x251-1537505506006.png" alt="nth360game">
                            </a>
                        </li>
                        <li style="float: left; list-style: none; position: relative; width: 670px;">
                            <a href="https://360game.vn/dtbs/redirect?token=MjAwmQ&amp;" target="_blank"><img src="https://img.f.360game.vn/banner/dtb-upload/su-kien-may-chu-moi-1537332879830.jpg" alt="nth360">
                            </a>
                        </li>
                        <li style="float: left; list-style: none; position: relative; width: 670px;">
                            <a href="https://360game.vn/dtbs/redirect?token=MjAwmw&amp;" target="_blank"><img src="https://img.f.360game.vn/banner/dtb-upload/bi kiep san code-1537758661967.png" alt="nth360game">
                            </a>
                        </li>
                        <li style="float: left; list-style: none; position: relative; width: 670px;" class="bx-clone">
                            <a href="https://360game.vn/dtbs/redirect?token=MjAwnQ&amp;" target="_blank"><img src="https://img.f.360game.vn/banner/dtb-upload/672x251-1537505506006.png" alt="nth360game">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bx-controls bx-has-pager">
                    <div class="bx-pager bx-default-pager">
                        <div class="bx-pager-item"><a href="" data-slide-index="0" class="bx-pager-link">1</a>
                        </div>
                        <div class="bx-pager-item"><a href="" data-slide-index="1" class="bx-pager-link active">2</a>
                        </div>
                        <div class="bx-pager-item"><a href="" data-slide-index="2" class="bx-pager-link">3</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="//js.f.360game.vn/v1/js/jquery.bxslider.min.js"></script>

        <script type="text/javascript">
            (function() {
                $.ajax({
                    url: "https://360game.vn/dtbs/get",
                    jsonp: "callback",
                    dataType: "jsonp",
                    data: {
                        action: "get",
                        pos: "54",
                        count: "{54:4}"
                    },
                    success: function(resp) {
                        if (resp.error >= 0) {
                            var banner = resp.data;
                            for (var i in banner) {
                                $('.banner-slider ul').append('<li><a href="' + (banner[i].link + '&' + location.search.substring(1)) + '" target="_blank"><img src="' + banner[i].img + '" alt="' + banner[i].appname + '"></a></li>');
                            }
                            $('.bn-slide').bxSlider({
                                auto: true,
                                controls: false
                            });
                        }
                    }
                });
            })();
        </script>
    </div>
    <div class="news-event clearfix">
        <div id="news-event-box">
            <div class="tabs-block news-block">
                <ul class="tab-menu clearfix" role="tablist">
                    <li class="active" role="presentation">
                        <a href="#3q-tab01" aria-controls="3q-tab01" role="tab" data-toggle="tab" aria-expanded="true">
				Tin tức
			</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#3q-tab02" aria-controls="3q-tab02" role="tab" data-toggle="tab" aria-expanded="false">
				Sự kiện
			</a>
                    </li>
                </ul>
                <a href="#" class="seemore">Xem thêm</a>
                <ul class="tab-content">
                    <li class="active" role="tabpanel" id="3q-tab01">
                        <ul class="news-list clearfix">
                            <?php foreach($list as $row) { ?>
                            <li>
                                <a href="<?php echo $row->slug ?>">
                                    <div class="date"><?php echo $row->ngay ?></div>
                                    <div class="txt"><?php echo $row->tieude ?></div>
                                </a>
                            </li>
                        <?php } ?>
                            

                        </ul>
                    </li>
                    <li role="tabpanel" id="3q-tab02" class="">
                        <ul class="event-list clearfix">

                            <li>
                                <div class="pic">
                                    <a href="//nth.360game.vn/thong-tin-chi-tiet?id=RTZmPQ"><img src="https://img.f.360game.vn/photo/2019/mo-Server-NTH-s107-1552616021.jpg">
                                    </a>
                                </div>
                                <div class="detail">
                                    <h2><a href="//nth.360game.vn/thong-tin-chi-tiet?id=RTZmPQ">07:00 ngày 15/03: Khai Mở S107.Anh Sơn</a></h2>
                                    <p class="date">15/03/2019</p>
                                    <p class="txt">Nghịch Thủy Hàn - Nhất Kiếm Định Giang Sơn</p>
                                </div>
                            </li>

                            

                        </ul>
                    </li>
                </ul>
            </div>
            <script type="text/javascript">
                (function() {
                    var clickHandler = function(e) {
                        e.preventDefault();
                        $.fn.tab.call($(this), 'show');
                    }

                    $(document)
                        .on('click.bs.tab.data-api', '[data-toggle="tab"]', clickHandler)
                        .on('click.bs.tab.data-api', '[data-toggle="pill"]', clickHandler)
                })();
            </script>
        </div>
        <div id="ranking-box-change-id">

            <div class="ranking" data-top-ranking="" data-url="https://nth.360game.vn/ranking" data-num-of-item="7">
                <div class="tab">BẢNG XẾP HẠNG </div>
                <a href="javascript:void(0);" class="see btn popup-btn">Xem thêm</a>

                <div class="popup-wrap">
                    <div class="popup-box" style="background: url(&quot;http://img.f.360game.vn/landing/nth360/popup-1537439124272.png&quot;) no-repeat; --darkreader-inline-bgcolor: initial;" data-darkreader-inline-bgcolor="">

                        <ul class="tab-menu clearfix" role="tablist">
                        </ul>
                        <div class="uiselector" style="display:none">
                            <p class="select-click list-server-choose" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chọn Môn Phái</p>
                            <ul class="select-option" aria-labelledby="list-server-choose">
                                <li>
                                    <a href="javascript:void(0)">Võ Thần 61</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Võ Thần 1</a>
                                </li>
                            </ul>
                        </div>
                        <div class="uiselector dropdown1" style="display:none">
                            <p class="select-click list-server-choose" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chọn Sever</p>
                            <ul class="select-option" aria-labelledby="list-server-choose">
                                <li>
                                    <a href="javascript:void(0)">Võ Thần 61</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Võ Thần 1</a>
                                </li>
                            </ul>
                        </div>
                        <ul class="tab-content">
                            <li class="active" role="tabpanel" id="3q-tab03">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table_popup" style="" data-top-ranking-table="">
                                    <tbody>
                                        <tr>
                                            <td> HẠNG</td>
                                            <td> TÊN NHÂN VẬT</td>
                                            <td>CẤP</td>
                                            <td>LỰC CHIẾN</td>
                                            <td>SEVER</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>

                                <ul class="paging popup_btn" data-pagination="">

                                    <li class="prev"><a href="#" data-first=""> &lt; Trang đầu</a>
                                    </li>
                                    <li class="active"><a href="#" data-page="1">1</a>
                                    </li>
                                    <li><a href="#" data-page="2">2</a>
                                    </li>
                                    
                                    <li class="next"> <a href="#" data-last=""> Trang cuối &gt; </a>
                                    </li>
                                </ul>

                            </li>
                            <li role="tabpanel" id="3q-tab04" class="popup_luchien">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table_popup" style="">
                                    <colgroup>
                                        <col>
                                            <col>
                                                <col>
                                                    <col>
                                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                HẠNG</td>
                                            <td>
                                                CLASS</td>
                                            <td>
                                                TÊN NHÂN VẬT</td>
                                            <td>
                                                CẤP</td>
                                            <td>
                                                LỰC CHIẾN</td>
                                            <td>
                                                SEVER</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <ul class="paging popup_btn">
                                    <li class="prev inactive">
                                        <a href="javascript:void(0)"> &lt; Trang đầu</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void(0)">1</a>
                                    </li>
                                    
                                    <li class="next">
                                        <a href="javascript:void(0)"> Trang cuối &gt; </a>
                                    </li>
                                </ul>
                            </li>


                            <li role="tabpanel" id="3q-tab05" class="popup_luchien">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table_popup" style="">
                                    <colgroup>
                                        <col>
                                            <col>
                                                <col>
                                                    <col>
                                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>
                                                HẠNG</td>
                                            <td>
                                                CLASS</td>
                                            <td>
                                                TÊN NHÂN VẬT</td>
                                            <td>
                                                CẤP</td>
                                            <td>
                                                LỰC CHIẾN</td>
                                            <td>
                                                SEVER</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <ul class="paging popup_btn">
                                    <li class="prev inactive">
                                        <a href="javascript:void(0)"> &lt; Trang đầu</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void(0)">1</a>
                                    </li>
                                    
                                    <li class="next">
                                        <a href="javascript:void(0)"> Trang cuối &gt; </a>
                                    </li>
                                </ul>
                            </li>



                        </ul>



                        <a class="close-btn popup-close" href="#"></a>
                    </div>
                </div>

                <div class="tile_bxh">

                    <div class="LC">Lực Chiến</div>
                    <div class="ten">Tên Nhân Vật</div>

                </div>
                <ul class="bxh_detail" data-top-ten="">

                    <li>
                        <div class="tennhanvat">
                            <h3>1</h3>MrHoang</div>
                        <div class="lucchien">1457107</div>
                    </li>
                   
                </ul>


            </div>

        </div>
    </div>
    <div class="item-game-slide">
        <ul class="slider-menu clearfix" role="tablist">
            <li class="item1 active" role="presentation">
                <a href="#item-game-tab01" aria-controls="item-game-tab01" role="tab" data-toggle="tab" aria-expanded="true"></a>
            </li>
            <li class="item2" role="presentation">
                <a href="#item-game-tab02" aria-controls="item-game-tab02" role="tab" data-toggle="tab" aria-expanded="false"></a>
            </li>
            <li class="item3" role="presentation">
                <a href="#item-game-tab03" aria-controls="item-game-tab03" role="tab" data-toggle="tab" aria-expanded="false"></a>
            </li>
            <li class="item4" role="presentation">
                <a href="#item-game-tab04" aria-controls="item-game-tab04" role="tab" data-toggle="tab" aria-expanded="false"></a>
            </li>
        </ul>
        <ul class="slider">
            <li class="active" role="tabpanel" id="item-game-tab01">
                <div class="item-desc clearfix">
                    <div class="l-item-desc">
                        <h2 class="name">THẦN BINH</h2>
                        <p class="txt">Thần Kiếm được tôi luyện từ mảnh huyền thiết cực nóng ở miệng núi lửa, sở hữu uy lực vô song. </p>
                    </div>
                    <div class="r-item-desc" style="background: url(&quot;http://img.f.360game.vn/landing/nth360/s1-1537414198581.png&quot;) 0px 0px no-repeat; width: 700px; transform: none; --darkreader-inline-bgcolor: initial;" data-darkreader-inline-bgcolor=""></div>
                </div>
            </li>
            <li role="tabpanel" id="item-game-tab02" class="">
                <div class="item-desc clearfix">
                    <div class="l-item-desc">
                        <h2 class="name">LONG HỔ CHIẾN</h2>
                        <p class="txt">Hai thế lực Thiên Long và Mãnh Hổ trành hùng. Đại Hiệp chọn phe nào? Long hay Hổ sẽ trở thành bá chủ? Chiến ngay!</p>
                    </div>
                    <div class="r-item-desc"></div>
                </div>
            </li>
            <li role="tabpanel" id="item-game-tab03" class="">
                <div class="item-desc clearfix">
                    <div class="l-item-desc">
                        <h2 class="name">KHINH CÔNG</h2>
                        <p class="txt">Tuyệt thế thân pháp với 4 bước khinh công vượt mọi địa hình. Phi như rồng lượn, cước như hổ vồ. </p>
                    </div>
                    <div class="r-item-desc"></div>
                </div>
            </li>
            <li role="tabpanel" id="item-game-tab04" class="">
                <div class="item-desc clearfix">
                    <div class="l-item-desc">
                        <h2 class="name">THÚ CƯỠI</h2>
                        <p class="txt">Chiến kỵ dũng mãnh đồng hành cùng chư vị đại hiệp phiêu bạt giang hồ.</p>
                    </div>
                    <div class="r-item-desc"></div>
                </div>
            </li>
        </ul>
    </div>
    <ul class="lib-block clearfix">
        <li>
            <a href="//nth.360game.vn/thu-vien">
                <p class="pic"><img src="https://img.f.360game.vn/photo/2018/09-1537359237.png">
                </p>
                <p class="txt">Hình nền</p>
            </a>
        </li>
        <li>
            <a href="//nth.360game.vn/thu-vien">
                <p class="pic"><img src="https://img.f.360game.vn/photo/2018/hinh1-1537360126.png">
                </p>
                <p class="txt">Hình trong game</p>
            </a>
        </li>
       <!-- <li>
            <a href="//nth.360game.vn/thu-vien">
                <p class="pic"><img src="https://img.f.360game.vn/photo/2018/hinhvideo-1537435242.png">
                </p>
                <p class="txt">Phim ảnh</p>
            </a>
        </li> -->
    </ul>
</div>