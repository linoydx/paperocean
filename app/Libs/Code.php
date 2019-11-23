<?php

namespace App\Libs;

class Code {
 private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//随机因子
 private $code;//验证码
 private $codelen = 4;//验证码长度
 private $width = 80;//宽度
 private $height = 30;//高度
 private $img;//图形资源句柄
 private $font;//指定的字体
 private $fontsize = 10;//指定字体大小
 private $fontcolor;//指定字体颜色
// 生成随机码

 //生成背景
 private function createBg() {
  $this->img = imagecreatetruecolor($this->width, $this->height);
  $color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
  imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
 }
 //生成文字
 private function createFont() {
  
  
  $len = strlen($this->charset);
  for ($i=0;$i<$this->codelen;$i++) {
    $x = $this->width / $this->codelen * $i+mt_rand(5,10);
   $this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
   $this->codecontent= $this->charset[mt_rand(0,$len)];
   $this->code .= $this->codecontent;
   $_SESSION['code'] = $this->code;
  imagestring($this->img,$this->fontsize,$x,mt_rand(5,10),$this->codecontent,$this->fontcolor);
  }

 }
 //生成线条、雪花
 private function createLine() {
  //线条
  for ($i=0;$i<6;$i++) {
   $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
   imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
  }
  //雪花
  for ($i=0;$i<20;$i++) {
   $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
   imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
  }
 }
 //输出
 private function outPut() {
  header('Content-type:image/png');
  imagepng($this->img);
  imagedestroy($this->img);
 }
 //对外生成
 public function make() {
  $this->createBg();
  $this->createLine();
  $this->createFont();
  $this->outPut();
 }
 //获取验证码
 public function getCode() {
  return strtolower($_SESSION['code']);
 }
}