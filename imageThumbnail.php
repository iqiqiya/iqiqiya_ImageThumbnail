<?php
/**
 * Title: imageThumbnail
 * Author: iqiqiya (77sec.cn)
 * Date: 2019/8/11
 */

/*打开图片*/
//1.配置要处理的图片路径
$src = "./image/Akie.png";

//2.获取图片信息
$info = getimagesize($src);
//print_r($info);

//3.通过编号来获取图片类型
$type = image_type_to_extension($info[2],false);

//4.在内存中建立一个和图片类型一样的图像
$fun = "imagecreatefrom{$type}";

//5.把图片拷贝到内存中
$image = $fun($src);

/*操作图片*/
//1.在内存中建立一个宽300，高200的真色彩图片
$image_thumbnail = imagecreatetruecolor(300,200);
//2.将原图复制到新建的真色彩图片上，并且按照一定比例压缩
imagecopyresampled($image_thumbnail,$image,0,0,0,0,300,200,$info[0],$info[1]);
//3.销毁原始图片
imagedestroy($image);

/*输出缩略图*/
//两种展示方式
//1.浏览器显示
header("Content-type:".$info['mime']);
$func = "image{$type}";//imagejpeg;imagepng;
$func($image_thumbnail);

//2.保存图片
$func($image_thumbnail,'./image/newimage3.'.$type);

//清理内存
imagedestroy($image_thumbnail);
?>