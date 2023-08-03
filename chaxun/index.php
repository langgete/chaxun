<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta charset="UTF-8">
    <title>Get Parts Price</title>
    
    <style type="text/css">
    .hidden-image {
            display: none;
        }
        td {padding: 10px; }
        table {
            border: #0000002e dotted 1px;
        }
        .hidden {
            display: none;
        }
        .english-parts-name img{ width: 40px; }

       #partsNames{outline-color:#4e6ef2!important;
        border-radius: 15px;
    font-size: 15px;
    margin-left: auto;
    height: 16px;
    padding: 12px 16px;
    vertical-align: top;
    box-shadow: none;
    border-radius: 10px 0 0 10px;
    border: 2px solid #c4c7ce;
    background: #fff;}
    .sr{max-width: 35rem;
        width: 100%;
    margin-left: auto;
    margin-right: auto;border:0}
    .ann{cursor: pointer;
        width: 108px;
    height: 44px;
    line-height: 45px;
    line-height: 44px\9;
    padding: 0;
    background: 0 0;
    background-color: #4e6ef2;
    border-radius: 0 10px 10px 0;
    font-size: 17px;
    color: #fff;
    box-shadow: none;
    font-weight: 400;
    border: none;
    outline: 0;}
   
    .ccx{position: relative;display: inline-block;
    max-width: 430px; width: 100%;vertical-align: top;
}
.ccx1{position: relative;display: inline-block;vertical-align: top;}
.ccx:hover #partsNames {border-color: #a7aab5;}
 #partsNames {
  transition: height 0.3s; /* 添加过渡效果，让高度变化更平滑 */
}


.ccx:hover {
    z-index: 999;
}

.ccx:hover #partsNames{height: 200px;
    width: 600px;
    border-radius: 20px;}
@media screen and (max-width:800px){
.ccx{max-width: 100%;}
.sr{max-width: 100%;    text-align: center;}
#partsNames{width: 90%;border-radius:10px;
    margin-bottom: 10px;
height: 3rem;
}
.ann{border-radius: 10px;    width: 120px;
    height: 50px;margin-bottom: 10px;
}
.ccx:hover #partsNames{height: 200px;
width: 90%;
    border-radius: 20px;}

}
.tab{max-width: 740px;
    width: 100%;
    margin: auto;}
form{margin:50px 0 20px 0}
body{text-align: center;}
#toggleButton{margin: 10px;}

    </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleButton = document.getElementById('toggleButton');
        var priceTdList = document.querySelectorAll('.price');
        var unitTdList = document.querySelectorAll('.unit');
        var imgTdList = document.querySelectorAll('.img');

        toggleButton.addEventListener('click', function() {
            priceTdList.forEach(function(priceTd) {
                priceTd.classList.toggle('hidden');
            });

            unitTdList.forEach(function(unitTd) {
                unitTd.classList.toggle('hidden');
            });
             imgTdList.forEach(function(imgTd) {
                imgTd.classList.toggle('hidden');
            });
        });
    });

   
        function hideFailedImages() {
            var images = document.getElementsByTagName('img');
            for (var i = 0; i < images.length; i++) {
                images[i].addEventListener('error', function() {
                    this.style.display = 'none';
                });
            }
        }
    

</script>
</head>
<body >
  

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       
        <div class="sr">
    <span class="ccx">     <textarea id="partsNames" name="partsNames" rows="4" cols="50" required></textarea></span>

<span class="ccx1">        <input class="ann" type="submit" value="查询"></div></span>

    </form>
 <button id="toggleButton">点击隐藏/显示</button>
    <?php
    // 处理表单提交
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 获取用户输入的partsNames值
        $partsNames = $_POST['partsNames'];

        if (!empty($partsNames)) {
            // 将输入的字符串分割成多个partsName
            $partsNamesArray = explode("\n", $partsNames);

            foreach ($partsNamesArray as $partsName) {
                $partsName = trim($partsName);

                // 设置目标URL
                $url = 'https://www.yutong.com/partsPrice/parts/getPrice.do?partsName=' . urlencode($partsName);

                // 使用file_get_contents发送请求并获取响应
                $response = file_get_contents($url);

                // 将响应从GB2312编码转换为UTF-8编码
                $response = iconv('GB2312', 'UTF-8//IGNORE', $response);

                // 解码JSON响应为关联数组
                $data = json_decode($response, true);

                if ($data === null) {
                    // JSON解码失败
                    echo "$partsName: Failed to decode JSON: " . json_last_error_msg();
                } else {
                    // 提取所需的值
                    $price = $data['price'];
                    $count = $data['count'];
                    $unitName = $data['unitName'];
                    $moduleName = $data['moduleName'];
                    
                    // 输出提取的值
                    echo "
                    <table class=tab>
                      <tr>
                        <td>$partsName</td>
                        <td>$moduleName</td>
                        <td class=price>单价: $price</td>
                        <td class=unit>单位: $unitName</td>
                        <td class=img><button onclick='viewImageGallery(\"$partsName\");'>查看图片合集</button></td>
                      </tr>
                    </table>";
                }
            }
        } else {
            echo "No parts names entered";
        }
    }
    ?>
     <script>
        function viewImageGallery(partsName) {
            // 构建图片合集的URL
            var imageUrl1 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-01.JPG`;
            var imageUrl2 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-02.JPG`;
            var imageUrl3 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-03.JPG`;
            var imageUrl4 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-04.JPG`;
            var imageUrl5 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-05.JPG`;
            var imageUrl6 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-00.JPG`;
            var imageUrl7 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-01.jpg`;
            var imageUrl8 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-02.jpg`;
            var imageUrl9 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-03.jpg`;
            var imageUrl10 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-04.jpg`;
            var imageUrl11 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-05.jpg`;
            var imageUrl12 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-1.jpg`;
            var imageUrl13 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-2.jpg`;
            var imageUrl14 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-3.jpg`;
            var imageUrl15 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-4.jpg`;
            var imageUrl16 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}-5.jpg`;
            var imageUrl17 = `https://tis.yutong.com/tis/showImageServlet?imageSrc=upload/spares/${partsName}.jpg`;

            // 构建图片合集数组
            var imageUrls = [imageUrl1, imageUrl2,imageUrl3,imageUrl4,imageUrl5,imageUrl6,imageUrl7,imageUrl8,imageUrl9,imageUrl10,imageUrl11,imageUrl12,imageUrl13,imageUrl14,imageUrl15,imageUrl16,imageUrl17/* 其他图片链接 */];

            // 将图片合集数组转换为JSON字符串，并编码为Base64，传递到新页面
            var encodedImageUrls = btoa(JSON.stringify(imageUrls));

            // 打开新页面并传递编码后的图片链接
            window.open(`image_gallery.php?partsName=${encodeURIComponent(partsName)}&imageUrls=${encodedImageUrls}`);
        }
    </script>
</body>
</html>
