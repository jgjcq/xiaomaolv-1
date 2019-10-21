<?php
/**
 * Í¼Æ¬ÑéÖ¤ÂëÀà
 * Éú³ÉÍ¼Æ¬ÀàÐÍÑéÖ¤Âë£¬ÑéÖ¤Âë°üº¬Êý×ÖºÍ´óÐ´×ÖÄ¸£¬sessionÖÐ´æ·Åmd5¼ÓÃÜºóµÄÑéÖ¤Âë
 * 
 * Ê¹ÓÃ·½·¨£º
 * $captcha = new Catpcha();
 * $captcha->buildAndExportImage();
 * 
 * ×÷          Õß: luojing
 * ´´½¨Ê±¼ä: 2013-3-27 ÉÏÎç11:42:12
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Captcha {
    
    private $width;//¿í¶È
    private $height; //¸ß¶È
    private $codeNum;//ÑéÖ¤Âë×Ö·ûÊýÁ¿
    private $image;//ÑéÖ¤ÂëÍ¼Ïñ×ÊÔ´
    private $sessionKey;//sessionÖÐ±£´æµÄÃû×Ö
    private $captcha;//ÑéÖ¤Âë×Ö·û´®
    const charWidth = 10;//µ¥¸ö×Ö·û¿í¶È,¸ù¾ÝÊä³ö×Ö·û´óÐ¡¶ø±ä
    
    /**
     * ´´½¨ÑéÖ¤ÂëÀà£¬³õÊ¼»¯Ïà¹Ø²ÎÊý
     * @param  $width Í¼Æ¬¿í¶È
     * @param  $height Í¼Æ¬¸ß¶È
     * @param  $codeNum ÑéÖ¤Âë×Ö·ûÊýÁ¿
     * @param  $sessionKey sessionÖÐ±£´æµÄÃû×Ö
     */
    function __construct($width = 50, $height = 20, $codeNum = 4, $sessionKey = 'captcha') {
        $this->width = $width;
        $this->height = $height;
        $this->codeNum = $codeNum;
        $this->sessionKey = $sessionKey;
        
        //±£Ö¤×îÐ¡¸ß¶ÈºÍ¿í¶È
        if($height < 20) {
            $this->height = 20;
        }
        if($width < ($codeNum * self::charWidth + 10)) {//×óÓÒ¸÷±£Áô5ÏñËØ¿ÕÏ¶
            $this->width = $codeNum * self::charWidth + 10;
        }
    }
    
    /**
     * ¹¹Ôì²¢Êä³öÑéÖ¤ÂëÍ¼Æ¬
     */
    public  function buildAndExportImage() {
        $this->createImage();
        $this->setDisturb();
        $this->setCaptcha();
        $this->exportImage();
    }
    
    /**
     * ¹¹ÔìÍ¼Ïñ£¬ÉèÖÃµ×É«
     */
    private function createImage() {
        //´´½¨Í¼Ïñ
        $this->image = imagecreatetruecolor($this->width, $this->height);  
        //´´½¨±³¾°É«
        $bg = imagecolorallocate($this->image, mt_rand(220, 255), mt_rand(220, 255), mt_rand(220, 255));  
        //Ìî³ä±³¾°É«
        imagefilledrectangle($this->image, 0, 0, $this->width - 1, $this->height - 1, $bg);
    }
    
    /**
     * ÉèÖÃ¸ÉÈÅÔªËØ
     */
    private function setDisturb() {
        
        //ÉèÖÃ¸ÉÈÅµã
        for($i = 0; $i < 150; $i++) {
            $color = imagecolorallocate($this->image, mt_rand(150, 200),  mt_rand(150, 200),  mt_rand(150, 200));
            imagesetpixel($this->image, mt_rand(5, $this->width - 10), mt_rand(5, $this->height - 3), $color);
        }
        
        //ÉèÖÃ¸ÉÈÅÏß
        for($i = 0; $i < 10; $i++) {
            $color = imagecolorallocate($this->image, mt_rand(150, 220), mt_rand(150, 220), mt_rand(150, 220));
            imagearc($this->image, mt_rand(-10, $this->width), mt_rand(-10, $this->height), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $color);
        }
        
        //´´½¨±ß¿òÉ«
        $border = imagecolorallocate($this->image, mt_rand(0, 50), mt_rand(0, 50), mt_rand(0, 50));
        //»­±ß¿ò
        imagerectangle($this->image, 0, 0, $this->width - 1, $this->height - 1, $border);
    }
    
    /**
     * ²úÉú²¢»æÖÆÑéÖ¤Âë
     */
    private function setCaptcha() {
        $str = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        //Éú³ÉÑéÖ¤Âë×Ö·û
        for($i = 0; $i < $this->codeNum; $i++) {
            $this->captcha .= $str{mt_rand(0, strlen($str) - 1)};
        }
        //»æÖÆÑéÖ¤Âë
        for($i = 0; $i < strlen($this->captcha); $i++) {
            $color = imagecolorallocate($this->image, mt_rand(0, 200), mt_rand(0, 200), mt_rand(0, 200));
            $x = floor(($this->width - 10)/$this->codeNum);
            $x = $x*$i + floor(($x-self::charWidth)/2) + 5;
            $y = mt_rand(2, $this->height - 20);
            imagechar($this->image, 5, $x, $y, $this->captcha{$i}, $color);
        }
    }
    
    /*
     * Êä³öÍ¼Ïñ,ÑéÖ¤Âë±£´æµ½sessionÖÐ
     */
    private function exportImage() {
        if(imagetypes() & IMG_GIF){
            header('Content-type:image/gif');
            imagegif($this->image);
        } else if(imagetypes() & IMG_PNG){
            header('Content-type:image/png');  
             imagepng($this->iamge);
        } else if(imagetypes() & IMG_JPEG) {
            header('Content-type:image/jpeg');  
             imagepng($this->iamge);
        } else {
            imagedestroy($this->image);
            die("Don't support image type!");
        }
        //½«ÑéÖ¤ÂëÐÅÏ¢±£´æµ½sessionÖÐ£¬md5¼ÓÃÜ
        if(!isset($_SESSION)){
            session_start();
        } 
        $_SESSION[$this->sessionKey] = md5($this->captcha);
        
        imagedestroy($this->image);  
    }
    
    function __destruct() {
        unset($this->width, $this->height, $this->codeNum,$this->captcha);
    }
}