<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, maximum-scale=1, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <link rel="stylesheet" href="/media/image/map/style.css"/>

</head>
<body>
<?php
$zone = new \App\WeChat\Zone();
$zone_map = $zone->get_zone_info($zone_id)->zone_map;


$zone_map_small = $zone->get_zone_info($zone_id)->zone_map_small;
?>
<script src="/media/image/map/photoTilt.js"></script>
<script>
    (function () {
        var photoTilt = new PhotoTilt({
            url: '{!! $zone_map !!}',
            lowResUrl: '{!! $zone_map_small !!}'
        });
    })();
</script>
</body>
</html>