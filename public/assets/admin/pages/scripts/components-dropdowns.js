var ComponentsDropdowns = function () {

    var handleSelect2 = function () {

        $('#select2_sample1').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        $('#select2_sample2').select2({
            placeholder: "Select a State",
            allowClear: true
        });

        $("#select2_sample3").select2({
            placeholder: "Select...",
            allowClear: true,
            minimumInputLength: 1,
            query: function (query) {
                var data = {
                    results: []
                }, i, j, s;
                for (i = 1; i < 5; i++) {
                    s = "";
                    for (j = 0; j < i; j++) {
                        s = s + query.term;
                    }
                    data.results.push({
                        id: query.term + i,
                        text: s
                    });
                }
                query.callback(data);
            }
        });

        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='" + Metronic.getGlobalImgPath() + "flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }

        $("#select2_sample4").select2({
            placeholder: "Select a Country",
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });

        $("#select2_sample5").select2({

            tags: ["全部显示", "上海市场部", "温州市场部", "杭州市场部", "宁波市场部", "台州市场部", "嘉兴市场部", "湖州市场部", "义乌市场",
                "绍兴市场部", "嵊州市场部", "丽水市场", "衢州市场部", "金华市场", "永康市场", "东阳市场", "磐安市场", "兰溪市场", "南京市场",
                "苏州市场", "无锡市场", "常州市场", "扬州市场", "南通市场", "泰州市场", "盐城市场", "苏北市场", "南昌市场", "九江市场",
                "上饶景德镇市场", "抚州市场", "广东市场", "福州市场", "南平市场", "三明市场", "宁德市场", "泉州市场", "厦门市场",
                "合肥市场", "芜湖市场", "宣城市场", "黄山市场", "安庆市场", "滁州市场", "武汉市场","赣南市场",
                "山东市场","浦江市场","徐州市场","宿迁市场","淮安市场","马鞍山市场","鄂州黄石市场","皖北市场","湖南市场","镇江市场",
                "星河酒店", "万豪大酒店", "影星酒店万盛楼", "国贸大厦", "贵宾楼", "丰景嘉丽酒店", "旅游大厦", "影星酒店",
                "测试市场",
                "浙江卫视6频道","浙江车友服务公司",
                "京华大厦", "岭南宾馆", "旅行社",
                "国防科技园", "屏岩洞府", "大智禅寺", "华夏文化园", "明清民居博览城", "梦幻谷", "明清宫苑", "广州街香港街", "清明上河图", "秦王宫",
                "九十九台阶","秦王宫四海归一殿","秦王宫正大门","秦王宫前广场","秦王宫中宫门",
                "宁波自驾游协会",
                "推广联盟测试",
                "龙帝惊临取号",
                "官网预定页面",
                "自驾车卡",
                "广州街电影博物馆测试1",
                "广州街电影博物馆测试2",
                "义乌游客中心",
                "火龙影视",
                "义乌游客中心门口影视",
                "义乌游客中心门口演艺秀",
                "龙帝惊临（99台阶）",
                "电影博物馆-序","电影博物馆-周恩来与中国电影","电影博物馆-中国多个第一次","电影博物馆-中国电影机械厂",
                "电影博物馆-鸦片战争与影视城","电影博物馆-数字时代","电影博物馆-世界第一次公映","电影博物馆-孪生姐妹",
                "电影博物馆-卢米埃尔兄弟","电影博物馆-立体电影","电影博物馆-宽荧幕电影","电影博物馆-柯达与放映机",
                "电影博物馆-横店首台电影放映机","电影博物馆-放映机的手摇时代","电影博物馆-放映机的前身","电影博物馆-放映机的诞生",
                "电影博物馆-电影放映机结构分析","电影博物馆-从无声到有声","电影博物馆-从黑白到彩色",
                "清明上河图智慧旅游",
                "清明上河图导览图",
                "清明上河图-高俅府", "清明上河图-清明上河图景区概况", "清明上河图-陈朝天府", "清明上河图-虹桥","清明上河图-大宋坊","清明上河图-平桥观鱼",
                "清明上河图-上善门","清明上河图-孙羊正店和曹记脚店","清明上河图-水上戏台","清明上河图-御街","清明上河图-赵太丞府","清明上河图-奉诏亭",
                "清明上河图-开封府","清明上河图-《聊斋惊梦》","清明上河图-樊楼","清明上河图-汴梁一梦","清明上河图-小御街","清明上河图-李师师门厅楼",
                "清明上河图-东门展示厅","清明上河图-蔡童区","清明上河图-金祥湖","清明上河图-金祥湖畔观景台","清明上河图-车门和水门",
                "清明上河图-水泊梁山","清明上河图-水月飞瀑","清明上河图-《游龙戏凤》","清明上河图-烟柳渚","清明上河图-范丹庙","清明上河图-点将台"
            ]
        });


        function movieFormatResult(movie) {
            var markup = "<table class='movie-result'><tr>";
            if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
            }
            markup += "<td valign='top'><h5>" + movie.title + "</h5>";
            if (movie.critics_consensus !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
            } else if (movie.synopsis !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
            }
            markup += "</td></tr></table>"
            return markup;
        }

        function movieFormatSelection(movie) {
            return movie.title;
        }

        $("#select2_sample6").select2({
            placeholder: "Search for a movie",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "https://api.github.com/search/repositories",
                dataType: 'jsonp',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        results: data.movies
                    };
                }
            },
            initSelection: function (element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected movie's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the movie name is shown preselected
                var id = $(element).val();
                if (id !== "") {
                    $.ajax("http://api.rottentomatoes.com/api/public/v1.0/movies/" + id + ".json", {
                        data: {
                            apikey: "ju6z9mjyajq2djue3gbvv26t"
                        },
                        dataType: "jsonp"
                    }).done(function (data) {
                        callback(data);
                    });
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }

    var handleSelect2Modal = function () {

        $('#select2_sample_modal_1').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        $('#select2_sample_modal_2').select2({
            placeholder: "Select a State",
            allowClear: true
        });

        $("#select2_sample_modal_3").select2({
            allowClear: true,
            minimumInputLength: 1,
            query: function (query) {
                var data = {
                    results: []
                }, i, j, s;
                for (i = 1; i < 5; i++) {
                    s = "";
                    for (j = 0; j < i; j++) {
                        s = s + query.term;
                    }
                    data.results.push({
                        id: query.term + i,
                        text: s
                    });
                }
                query.callback(data);
            }
        });

        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='" + Metronic.getGlobalImgPath() + "flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }

        $("#select2_sample_modal_4").select2({
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });

        $("#select2_sample_modal_5").select2({
            tags: ["red", "green", "blue", "yellow", "pink"]
        });


        function movieFormatResult(movie) {
            var markup = "<table class='movie-result'><tr>";
            if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
            }
            markup += "<td valign='top'><h5>" + movie.title + "</h5>";
            if (movie.critics_consensus !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
            } else if (movie.synopsis !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
            }
            markup += "</td></tr></table>"
            return markup;
        }

        function movieFormatSelection(movie) {
            return movie.title;
        }

        $("#select2_sample_modal_6").select2({
            placeholder: "Search for a movie",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "http://api.rottentomatoes.com/api/public/v1.0/movies.json",
                dataType: 'jsonp',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        results: data.movies
                    };
                }
            },
            initSelection: function (element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected movie's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the movie name is shown preselected
                var id = $(element).val();
                if (id !== "") {
                    $.ajax("http://api.rottentomatoes.com/api/public/v1.0/movies/" + id + ".json", {
                        data: {
                            apikey: "ju6z9mjyajq2djue3gbvv26t"
                        },
                        dataType: "jsonp"
                    }).done(function (data) {
                        callback(data);
                    });
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }

    var handleBootstrapSelect = function () {
        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
    }

    var handleMultiSelect = function () {
        $('#my_multi_select1').multiSelect();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleSelect2();
            handleSelect2Modal();
            handleMultiSelect();
            handleBootstrapSelect();
        }
    };

}
();