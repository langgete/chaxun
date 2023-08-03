<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Image Gallery</title>
    <style type="text/css">
        body {
    text-align: center;
}
img {
    width: 50em;
}
    </style>
</head>
<body>
    <h1>Image Gallery</h1>
    <?php
        // 获取传递过来的部件名称和图片链接数组
        $partsName = $_GET['partsName'];
        $encodedImageUrls = $_GET['imageUrls'];

        // 解码图片链接数组
        $imageUrls = json_decode(base64_decode($encodedImageUrls));

        echo "<h2>$partsName</h2>";

        // 输出图片
        foreach ($imageUrls as $imageUrl) {
            echo "<img src='$imageUrl' onerror=this.style.display='none'>";
        }
    ?>
</body>
</html>
