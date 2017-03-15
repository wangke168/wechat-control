<!DOCTYPE html>
<html>
<head>
    <script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#btn1").click(function () {
                $.ajax({
                    url: "http://hd-control.dev/json/qrscene",
                    type: "get",
                    success: function (data, state) {
                        //这里显示从服务器返回的数据
                        //alert(data);
                        //这里显示返回的状态
                        alert(state);
                    }
                });
            });
            $("#btn2").click(function () {
                $("#test2").html("<b>Hello world!</b>");
            });
            $("#btn3").click(function () {
                $("#test3").val("Dolly Duck");
            });
        });
    </script>
</head>

<body>
<p id="test1">这是段落。</p>

<p id="test2">这是另一个段落。</p>

<p>Input field: <input type="text" id="test3" value="Mickey Mouse"></p>
<button id="btn1">设置文本</button>
<button id="btn2">设置 HTML</button>
<button id="btn3">设置值</button>
</body>
</html>