(function ($, window) {
    $.bindViewer = function (elm) {
        var $elm = $(elm),
            $win = $(window);
        $("html").css("minHeight", "100%");

        if ($elm.data("bindCategory")) $(document).off("click", elm);
        else $elm.data("bindCategory", "bound");
        $(document).on("click", elm, viewImg);

        function viewImg() {
            var $obj = $(this),
                src = $obj.attr("src"),
                win_h = window.innerHeight || document.documentElement.clientHeight,
                win_w = window.innerWidth || document.documentElement.clientWidth,
                sroll_t = $win.scrollTop(),
                sroll_l = $win.scrollLeft(),
                doc_h = Math.max($("body").height(), $("html").height()),
                $img = $("<img style='box-shadow:0px 0px 10px #C0C0C0;position:absolute;z-index:9999998;left:50%;opacity:0;' src='" + src + "' />"),
                $bg = $("<div style='position:absolute;z-index:9999997;top:0;left:0;width:100%;height:" + doc_h + "px;background:#002265;opacity:0.6;'></div>"),
                $close = $("<a title='关闭' style='position:absolute;z-index:9999999;left:49.05%;padding:11px 15px;cursor:pointer;background:#002265;color:white;font-family:Arial;font-size:14px;transition:background .5s;text-decoration:none;'>X</a>");
            $bg.appendTo("body").hide().fadeIn(200);
            $close.appendTo("body").hover(function () {
                $(this).css({"background": "#002265", "text-decoration": "none"})
            }, function () {
                $(this).css("background", "black")
            }).hide();
            $img.appendTo("body").load(function () {
                var img_w = $(this).width(),
                    img_h = $(this).height();
                if(win_h*0.8<img_h||win_w*0.8<img_w){
                    var win_scale = win_w/win_h,
                        img_scale = img_w/img_h,
                        temp = 0;
                    if(win_scale>img_scale){ 
                        temp = img_h;
                        img_h = win_h*0.8;
                        img_w = img_w*img_h/temp;
                    }else{
                        temp = img_w;
                        img_w = win_w*0.8;
                        img_h = img_w*img_h/temp;
                    }
                }
                $(this).css({"top": win_h / 2 + sroll_t, "margin-left": sroll_l - 50, "margin-top": "-50px", "width": "100px", "height": "100px"})
                    .animate({"opacity": "1", "margin-left": -img_w / 2, "margin-top": -img_h / 2, "width": img_w, "height": img_h}, 300,
                    function () {
                        $close.css({"top": win_h / 1.96+ sroll_t, "margin-left": img_w / 2 - 20 + sroll_l, "margin-top": -10 - img_h / 2}).fadeIn(500);
                    });
                $close.add($bg).click(function () {
                    $img.add($bg).add($close).remove();
                    $img = $bg = $close = null;
                })
            })
        }
    };

}(jQuery, window));