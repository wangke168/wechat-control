function menuchushi() {
    var num = 0;
    var menua = $(".page-sidebar-menu").find("a");
    for (var i = 0; i < menua.length; i++) {
        var urlstr = window.location.toString();
        if (urlstr.indexOf(menua.eq(i).attr("href").toString()) >= 0) {
            num = i;
            break;
        }
    }
    menua.eq(num).closest("li").addClass("active")
        .closest("ul.sub-menu").parent("li").addClass("active")
        .find("span.arrow").addClass("open");
}