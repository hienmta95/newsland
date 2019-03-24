jQuery(document).ready(function () {

    $('.checkDescription').on('ifChanged', function(event){

        var lang=$('.checkDescription').data('lang');
        switch (lang){
            case 'en': autoDescription('en');
                break;
            case 'jp':autoDescription('jp');
                break;
            case 'kr':autoDescription('kr');
                break;
            case 'cn':autoDescription('cn');
                break;
            case 'zh':autoDescription('zh')
                break;
        }
    });

    $('.tag-background').colorpicker().on('changeColor', function (ev) {
        $('.tag-value').css('background-color', ev.color.toHex());
        $(this).css('background-color', ev.color.toHex());
    });
    $(".tag-color").colorpicker().on('changeColor', function (ev) {
        $('.tag-value').css('color', ev.color.toHex());
        $(this).css('background-color', ev.color.toHex());
    });
    $(".btn-editor").click(function (e) {
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].updateElement();
        }
    });
    $(".cke_editable").blur(function (e) {
        alert("allo");
    });
    $('.ajaxDel').click(handleDelete);

    function handleDelete(e) {
        e.preventDefault();
        var $link = $(e.target),
            callUrl = $(this).attr('href');
        $.ajax({
            type: 'post',
            url: callUrl,
            dataType: 'json',
            success: function (data) {
                alert(data.message);
                if (data.success) {
                    $.pjax.reload({container: ".pjaxContent"});
                }
            }
        });
    }

    $(".c_timezone").each(function () {
        var date = new Date($(this).text().replace(/-/g, "/") + " GMT+0000");
        if (date) {
            $(this).text(moment(date.getTime()).format("YYYY-MM-DD HH:mm:ss"));
        }
    });
    $("#event-start_at").blur(function () {
        var start_time = $("#event-start_at").val();
        var reg = new RegExp('-', 'g');
        var start_time_stamp = Date.parse(start_time.replace(reg,"/"));
        var end_time = new Date(start_time_stamp + 86400000);
        var end_time_string = end_time.getFullYear() + "-" + getTwoDigit(end_time.getMonth()+1) + "-" + getTwoDigit(end_time.getDate())  + " " + getTwoDigit(end_time.getHours()) + ":" + getTwoDigit(end_time.getMinutes()) + ":" + getTwoDigit(end_time.getSeconds());
        $("#event-end_at").val(end_time_string);
    });
    function getTwoDigit(number){
        return ("0" + number).slice(-2);
    }

    if ($("#collaboration").val() == 0) {
        $('#original_ip').prop('disabled', true);
        $('#collaborationIP').prop('disabled', true);
    } else {
        $('#collaborationIP').prop('disabled', false);
        $('#original_ip').prop('disabled', false);
    }



});

function changeTab(lang,id) {
    var description_en = $('#event-description').val();
    var name_en = $('#event-name').val();
    var url = window.location.href;
    var arr = url.split("/");
    var result = arr[0] + "//" + arr[2];
    var url_translate = result + '/backend/event/translate-description';
    switch (lang){
        case "jp":
        {
            var description_lang = $("#event-description_jp").val();
            var name_lang = $('#event-name_jp').val();
            if(description_lang === ""){
                var request = $.ajax({
                    url : url_translate,
                    method: "GET",
                    data:{
                        'to_lang': 'ja',
                        'name_lang':name_en,
                        'description': description_en
                    },
                    dataType: "json"

                });

                request.done(function (response) {
                    if(response.code == 200){
                        $("#event-description_jp").val(response.description);
                        CKEDITOR.instances['event-description_jp'].setData(response.description);
                        $('#event-name_jp').val(response.name);
                    }
                });
            }
        }
            break;
        case "cn":
        {
            var description_lang = $("#event-description_cn").val();
            var name_lang = $('#event-name_cn').val();
            if(description_lang === ""){
                var request = $.ajax({
                    url : url_translate,
                    method: "GET",
                    data:{
                        'to_lang': 'zh-CN',
                        'description': description_en,
                        'name_lang':name_en
                    },
                    dataType: "json"

                });

                request.done(function (response) {
                    if(response.code == 200){
                        $("#event-description_cn").val(response.description);
                        CKEDITOR.instances['event-description_cn'].setData(response.description);
                        $('#event-name_cn').val(response.name);
                    }
                });
            }
        }
            break;
        case "zh":
        {
            var description_lang = $("#event-description_zh").val();
            var name_lang = $('#event-name_zh').val();
            if(description_lang === ""){
                var request = $.ajax({
                    url : url_translate,
                    method: "GET",
                    data:{
                        'to_lang': 'zh-TW',
                        'description': description_en,
                        'name_lang':name_en
                    },
                    dataType: "json"

                });

                request.done(function (response) {
                    if(response.code == 200){
                        $("#event-description_zh").val(response.description);
                        CKEDITOR.instances['event-description_zh'].setData(response.description);
                        $('#event-name_zh').val(response.name);
                    }
                });
            }
        }
            break;
        case "kr":
        {
            var description_lang = $("#event-description_kr").val();
            var name_lang = $('#event-name_kr').val();
            if(description_lang === ""){
                var request = $.ajax({
                    url : url_translate,
                    method: "GET",
                    data:{
                        'to_lang': 'ko',
                        'description': description_en,
                        'name_lang': name_en
                    },
                    dataType: "json"

                });

                request.done(function (response) {
                    if(response.code == 200){
                        $("#event-description_kr").val(response.description);
                        CKEDITOR.instances['event-description_kr'].setData(response.description);
                        $('#event-name_kr').val(response.name);
                    }
                });
            }
        }
            break;
    }


}

function autoDescription(lang) {
    var text = "■" + $("span#select2-event-type_id-container").attr("title") + "<br>" + $("#event-name").val() + "<br>";
    var weekday = {};
    var time_limit = '';
    $('.checkDescription').data('lang',lang);


    weekday.jp = ["日", "月", "火", "水", "木", "金", "土"];
    weekday.kr = ["일", "월", "화", "수", "목", "금", "토"];
    weekday.cn = ["日", "一", "二", "三", "四", "五", "六"];
    weekday.zh = ["日", "一", "二", "三", "四", "五", "六"];
    weekday.en = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    var reg = new RegExp('-', 'g');
    var start_at = new Date();
    start_at.setDate(start_at.getDate() - 1);
    if ($("#event-start_at").val() != "") {
        start_at = new Date($("#event-start_at").val().toString().replace(reg, '/'));
    }
    var end_at = new Date();
    if ($("#event-end_at").val() != "") {
        end_at = new Date($("#event-end_at").val().toString().replace(reg, '/'));
    }

    var start_month = start_at.getMonth() + 1;
    var start_date = start_at.getDate();
    var start_hour = start_at.getHours();
    var start_minute = start_at.getMinutes();

    var end_month = end_at.getMonth() + 1;
    var end_date = end_at.getDate();
    var end_hour = end_at.getHours();
    var end_minute = end_at.getMinutes();


    if (start_month < 10) {
        start_month = "0" + start_month;
    }
    if (start_date < 10) {
        start_date = "0" + start_date;
    }
    if (start_hour < 10) {
        start_hour = "0" + start_hour;
    }
    if (start_minute < 10) {
        start_minute = "0" + start_minute;
    }


    if (end_month < 10) {
        end_month = "0" + end_month;
    }
    if (end_date < 10) {
        end_date = "0" + end_date;
    }
    if (end_hour < 10) {
        end_hour = "0" + end_hour;
    }
    if (end_minute < 10) {
        end_minute = "0" + end_minute;
    }

    switch (lang) {
        case "jp":

            time_limit = '(時間限定開催)';
            text += "期間:" + start_at.getFullYear() + "/" + start_month + "/" + start_date + "(" + weekday.jp[start_at.getDay()] + ") " +
                start_hour + ":" + start_minute + " ~ ";
            text += end_at.getFullYear() + "/" + end_month + "/" + end_date + "(" + weekday.jp[end_at.getDay()] + ") " + end_hour + ":" + end_minute;
            break;
        case "kr":
            time_limit = '(시간 한정 개최)';
            text += "기간:" + start_at.getFullYear() + "/" + start_month + "/" + start_date + "(" + weekday.kr[start_at.getDay()] + ") " +
                start_hour + ":" + start_minute + " ~ ";
            text += end_at.getFullYear() + "/" + end_month + "/" + end_date + "(" + weekday.kr[end_at.getDay()] + ") " + end_hour + ":" + end_minute;
            break;
        case "cn":
            time_limit = '(活动期间中非全程开放)';
            text += "日期:" + start_at.getFullYear() + "/" + start_month + "/" + start_date + "(" + weekday.cn[start_at.getDay()] + ") " +
                start_hour + ":" + start_minute + " ~ ";
            text += end_at.getFullYear() + "/" + end_month + "/" + end_date + "(" + weekday.cn[end_at.getDay()] + ") " + end_hour + ":" + end_minute;
            break;
        case "zh":
            time_limit = '(活動期間中非全程開放)';
            text += "日期:" + start_at.getFullYear() + "/" + start_month + "/" + start_date + "(" + weekday.zh[start_at.getDay()] + ") " +
                start_hour + ":" + start_minute + " ~ ";
            text += end_at.getFullYear() + "/" + end_month + "/" + end_date + "(" + weekday.zh[end_at.getDay()] + ") " + end_hour + ":" + end_minute;
            break;
        case "en":
            time_limit = '(Time limited events)';
            text += "Time:" + start_at.getFullYear() + "/" + start_month + "/" + start_date + "(" + weekday.en[start_at.getDay()] + ") " +
                start_hour + ":" + start_minute + " ~ ";
            text += end_at.getFullYear() + "/" + end_month + "/" + end_date + "(" + weekday.en[end_at.getDay()] + ") " + end_hour + ":" + end_minute;
            break;
    }
    if ($('.checkDescription').is(":checked")) {
        text += ' ' + time_limit;
    }
    CKEDITOR.instances['event-description'].setData(text)
}

function s3UploadOnClick(config) {
    var _e_ = new Evaporate(config);
    var files;
    files = $('#video_upload-file')[0].files;
    for (var i = 0; i < files.length; i++) {
        filename = 'spicemart_' + Date.now() + '.' + files[i].name.split('.').pop();
        _e_.add({
            //#TODO add file name by time
            name: filename,
            file: files[i],
            notSignedHeadersAtInitiate: {
                'Cache-Control': 'max-age=3600'
            },
            xAmzHeadersAtInitiate: {
                'x-amz-acl': 'public-read'
            },
            //signParams: {
            //    foo: 'bar'
            //},
            complete: function () {
                //#TODO add file name...
                console.log('complete................yay!');
            },
            progress: function (progress) {
                $('#video_upload-progress').html(progress / 1 * 100 + "%");
                $('#video_upload-percentage').width(progress * 100 + '%');
            },
            complete: function (complete) {
                $('#video_upload-progress').html("100%");
                $('#video_upload-percentage').width('100%');
                $('#video-file_name').val(config.cloud_front + '/mov/' + filename);
            }
        });
    }
}

$("#collaboration").change(function () {
    if ($(this).val() == 0) {
        $('#collaborationIP').prop('disabled', true);
        $('#collaborationIP').val('');
        $('#original_ip').prop('disabled', true);
        $('#original_ip').val('');
        $('.field-original_ip').removeClass("has-error");
        $('.field-collaborationIP').removeClass("has-error");
        $('.field-collaborationIP .help-block').text("");
        $('.field-original_ip .help-block').text("");
    } else {
        $('#collaborationIP').prop('disabled', false);
        $('#original_ip').prop('disabled', false);
    }
});

$('select#company-is_actived').change(function () {
    if ($(this).val() == 0) {
        $('input#company-downloadcsv').val('0');
        $('select#company-downloadcsv').val('0');
        $('select#company-downloadcsv').prop('disabled', 'disabled');
    }
    if ($(this).val() == 1) {
        $('select#company-downloadcsv').prop('disabled', false);
    }
});

$(function () {
    var availableTags = [
        "新世紀エヴァンゲリオンシリーズ",
        "初音ミク",
        "FINAL FANTASYシリーズ",
        "ドラゴンクエストシリーズ",
        "ドラゴンボール",
        "幽☆遊☆白書",
        "るろうに剣心",
        "ドラえもん",
        "鋼の錬金術師",
        "進撃の巨人",
        "北斗の拳",
        "MONSTER HUNTER",
        "魔法少女まどか☆マギカ",
        "ダンジョンに出会いを求めるのは間違っているだろうか",
        "攻殻機動隊シリーズ",
        "七つの大罪",
        "Fateシリーズ",
        "この素晴らしい世界に祝福を！",
        "Re：ゼロから始める異世界生活",
        "THE KING OF FIGHTERS",
        "アイドルマスターシリーズ",
        "ストリートファイターシリーズ",
        "サクラ大戦シリーズ",
        "FAIRY TAIL",
        "とある魔術の禁書目録",
        "サムライスピリッツシリーズ",
        "GUILTY GEARシリーズ",
        "NieRシリーズ",
        "BLEACH―ブリーチ―",
        "NARUTO―ナルト―",
        "テイルズオブシリーズ",
        "VALKYRIE PROFILE",
        "頭文字Ｄ",
        "聖闘士星矢",
        "聖剣伝説シリーズ",
        "あの日見た花の名前を僕達はまだ知らない。",
        "でんぱ組.inc",
        "遊☆戯☆王",
        "魔界戦記ディスガイア",
        "物語シリーズ",
        "ソードアート・オンライン",
        "HUNTER×HUNTER",
        "サンリオ",
        "ジョジョの奇妙な冒険シリーズ",
        "魔法科高校の劣等生",
        "やはり俺の青春ラブコメはまちがっている。",
        "名探偵コナン",
        "僕のヒーローアカデミア",
        "美少女戦士セーラームーン",
        "東京喰種トーキョーグール",
        "弱虫ペダル",
        "機動戦士ガンダムシリーズ",
        "亜人",
        "マクロスシリーズ",
        "刃牙シリーズ",
        "カイジシリーズ",
        "ダンガンロンパシリーズ",
        "亜人ちゃんは語りたい",
        "八月のシンデレラナイン",
        "ONE PIECE",
        "RPG アヴァベル オンライン",
        "城とドラゴン",
        "ダービーインパクト",
        "ユニゾンリーグ",
        "ヴァルキリーコネクト",
        "ドリフトスピリッツ",
        "アイドリッシュセブン",
        "ミトラスフィア -MITRASPHERE-",
        "ドラゴンプロジェクト",
        "プロ野球VS",
        "クイズRPG魔法使いと黒猫のウィズ",
        "バトルガール ハイスクール",
        "プロ野球PRIDE",
        "白猫プロジェクト",
        "ランブル・シティ",
        "軍勢RPG 蒼の三国志",
        "白猫テニス",
        "サマナーズウォー: Sky Arena",
        "BanG Dream!",
        "エレメンタルストーリー",
        "オルタナティブガールズ",
        "イケメン戦国◆時をかける恋",
        "シャドウバース",
        "グランブルーファンタジー",
        "逆転オセロニア",
        "ダービースタリオン",
        "みんなのGOLF",
        "夢王国と眠れる100人の王子様",
        "黒騎士と白の魔王",
        "ファントム オブ キル",
        "クリスタル オブ リユニオン",
        "誰ガ為のアルケミスト",
        "パズル＆ドラゴンズ",
        "メルクストーリア",
        "あんさんぶるスターズ！",
        "陰陽師",
        "ラブライブ！",
        "キャプテン翼",
        "実況パワフルプロ野球",
        "ワールドサッカーコレクションS",
        "Winning Elevenシリーズ",
        "プロ野球スピリッツ",
        "実況パワフルサッカー",
        "妖怪ウォッチ",
        "A3!",
        "LINE POP2",
        "LINE ポコポコ",
        "LINE：ディズニー ツムツム",
        "LINE バブル2",
        "戦刻ナイトブラッド",
        "剣と魔法のログレス いにしえの女神",
        "崩壊学園シリーズ",
        "モンスターストライク",
        "Lineage",
        "セブンナイツ",
        "HIDE AND FIRE",
        "HIT - ヒット",
        "#コンパス 【戦闘摂理解析システム】",
        "ポケットモンスターシリーズ",
        "ファイアーエムブレムシリーズ",
        "SINoALICE ーシノアリスー",
        "戦姫絶唱シンフォギア",
        "にゃんこ大戦争",
        "オルタンシア・サーガ -蒼の騎士団-",
        "ぷよぷよシリーズ",
        "チェインクロニクル３",
        "キングダムハーツシリーズ",
        "BRAVELY DEFAULT FAIRY'S EFFECT",
        "ミリオンアーサーシリーズ",
        "スクールガールストライカーズ",
        "ぼくとドラゴン",
        "戦国炎舞 -KIZNA-",
        "消滅都市2",
        "うたの☆プリンスさまっ♪"
    ];
    $("#original_ip").autocomplete({
        source: availableTags
    });
});

function editComment(id){
    $('#comment-edit-input-' + id).show();
    $('#content-message-' + id).hide();

    var text_content = $('#content-message-' + id).html();
    $('#comment-' + id + '-txt').val(text_content);

    // hide edit btn , remove btn
    // show ok btn, refresh btn
    $('#btn-edit-'+id).hide();
    $('#btn-ok-'+id).show();
    $('#btn-cancel-'+id).show();
    $('#btn-remove-'+id).hide();
}

function updateComment(id){
    // up to server
    var edited = $('#comment-' + id + '-txt').val();
    var url = window.location.href;
    var arr = url.split("/");
    var result = arr[0] + "//" + arr[2];
    var url_edit_comment = result + '/backend/eventcomment/editcomment';

    var request = $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: url_edit_comment,
        method: "POST",
        data: { 
            'id' : id,
            'comment' : edited
        },
        dataType: "json"
    });
     
    request.done(function( msg ) {
        if(msg.code == 200){
            // hide edit btn , remove btn
            // show ok btn, refresh btn
            $('#btn-edit-'+id).show();
            $('#btn-ok-'+id).hide();
            $('#btn-cancel-'+id).hide();
            $('#btn-remove-'+id).show();

            $('#content-message-' + id).html($('#comment-' + id + '-txt').val());
            $('#comment-edit-input-' + id).hide();
            $('#content-message-' + id).show();
        }else{
            alert(msg.message);
        }
    });
     
    request.fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
}

function cancelComment(id){
    $('#comment-edit-input-' + id).hide();
    $('#content-message-' + id).show();

    // hide edit btn , remove btn
    // show ok btn, refresh btn
    $('#btn-edit-'+id).show();
    $('#btn-ok-'+id).hide();
    $('#btn-cancel-'+id).hide();
    $('#btn-remove-'+id).show();

}

function removeComment(id){
    var r = confirm("Are you sure to delete this comment?");
    if (r == true) {
        // up to server
        var url = window.location.href;
        var arr = url.split("/");
        var result = arr[0] + "//" + arr[2];
        var url_remove_comment = result + '/backend/eventcomment/deletecomment';

        var request = $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: url_remove_comment,
            method: "POST",
            data: { 
                'id' : id
            },
            dataType: "json"
        });
         
        request.done(function( msg ) {
            if(msg.code == 200){
                $('#' + id).remove();
            }else{
                alert(msg.message);
            }
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    }
}
    