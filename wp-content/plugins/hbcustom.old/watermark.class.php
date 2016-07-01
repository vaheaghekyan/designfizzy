<?php
/* 
 * Class Watermark
 * require GD librabry
 *
 * 
 */

class Watermark {
    /**
     *
     * @var image resource
     */
    private $image = null;

    /**
     *
     * @var image resource
     */
    private $watermark = null;

    /**
     *
     * @var string
     */
    private $output_file = null;

    /**
     *
     * @var int
     */
    private $type = '';

    private $type_image = null;

    private $image_path = null;


    const BOTTOM_RIGHT = 1;
    const CENTER = 2;
    const BOTTOM_RIGHT_SMALL = 3;

    /**
     *
     * @param string $path_to_image
     */
    public function __construct($path_to_image){
        if (file_exists($path_to_image) && $type_image = exif_imagetype($path_to_image)){

            $this->image_path = $path_to_image;
            $this->type_image = $type_image;

            switch($type_image){
                case IMAGETYPE_GIF:
                    $this->image = imagecreatefromgif($path_to_image);
                    break;
                case IMAGETYPE_JPEG:
                    $this->image = imagecreatefromjpeg($path_to_image);
                    break;
                case IMAGETYPE_PNG:
                    $this->image = imagecreatefrompng($path_to_image);
                    break;
            }
        }
        $this->type = Watermark::BOTTOM_RIGHT;
    }

    /**
     *
     * @param string $path_to_watermark
     * @return boolean
     */
    public function setWatermarkImage($path_to_watermark){
        if (file_exists($path_to_watermark) && $type_watermark = exif_imagetype($path_to_watermark)){
            switch($type_watermark){
                case IMAGETYPE_GIF:
                    $this->watermark = imagecreatefromgif($path_to_watermark);
                    break;
                case IMAGETYPE_JPEG:
                    $this->watermark = imagecreatefromjpeg($path_to_watermark);
                    break;
                case IMAGETYPE_PNG:
                    $this->watermark = imagecreatefrompng($path_to_watermark);
                    break;
            }
            return true;
        }
        return false;
    }

    /**
     *
     * @return boolean
     */
    public function save(){
        $this->output_file = $this->image_path;
        return $this->process();
    }

    /**
     *
     * @param string $path_to_image
     * @return boolean
     */
    public function saveAs($path_to_image){
        $this->output_file = $path_to_image;
        return $this->process();
    }

    /**
     *
     * @param int $type
     */
    public function setType($type){
        $this->type = $type;
    }

    /**
     *
     * @return boolean
     */
    private function process(){
        if ($this->image && $this->watermark){
            switch ($this->type){
                case Watermark::BOTTOM_RIGHT:
                    return $this->watermark_bottom_right($this->image, $this->watermark);
                    break;
                case Watermark::CENTER:
                    return $this->watermark_center($this->image, $this->watermark);
                    break;
                case Watermark::BOTTOM_RIGHT_SMALL:
                    return $this->watermark_bottom_right_small($this->image, $this->watermark);
                    break;
            }
            return true;
        }else {
            return false;
        }
    }

    /**
     *
     * @param image resource $image
     * @param image resource $watermark
     * @return boolean
     */
    private function watermark_bottom_right(&$image, &$watermark){
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);
        $size = getimagesize($this->image_path);
        $dest_x = $size[0] - $watermark_width - 5;
        $dest_y = $size[1] - $watermark_height - 5;
        imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);

        imagealphablending($image, false);
        imagesavealpha($image,true);

        switch($this->type_image){
            case IMAGETYPE_GIF:
                imagegif($image, $this->output_file);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image,$this->output_file,100);
                break;
            case IMAGETYPE_PNG:
                imagepng($image, $this->output_file, 9);
                break;
        }

        imagedestroy($image);
        imagedestroy($watermark);
        return true;
    }

    /**
     *
     * @param image resource $image
     * @param image resource $watermark
     * @return booelan
     */
    private function watermark_center(&$image, &$watermark){
        $size = getimagesize($this->image_path);
        $watermark_x = imagesx($watermark);
        $watermark_y = imagesy($watermark);
        $im_x = $size[0];
        $im_y = $size[1];
        $cof = $im_x/($watermark_x*1.3); // 5/1 = im_x/(wx*cof) ; wx*cof = im_x/5 ; cof = im_x/wx*5
        $w = intval($watermark_x*$cof);
        $h = intval($watermark_y*$cof);

        $watermark_mini = imagecreatetruecolor($w, $h);
        imagealphablending($watermark_mini, false);
        imagesavealpha($watermark_mini,true);
        imagecopyresampled($watermark_mini, $watermark, 0, 0, 0, 0, $w, $h, $watermark_x, $watermark_y);


        $dest_x = $im_x - $w - (($im_x-$w)/2);
        $dest_y = $im_y - $h - (($im_y-$h)/2);

        imagecopy($image, $watermark_mini, $dest_x, $dest_y, 0, 0, $w, $h);

        imagealphablending($image, false);
        imagesavealpha($image,true);

        switch($this->type_image){
            case IMAGETYPE_GIF:
                imagegif($image, $this->output_file);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image,$this->output_file,100);
                break;
            case IMAGETYPE_PNG:
                imagepng($image, $this->output_file, 9);
                break;
        }

        imagedestroy($image);
        imagedestroy($watermark);
        return true;
    }

    /**
     *
     * @param image resource $image
     * @param image resource $watermark
     * @return boolean
     */
    private function watermark_bottom_right_small(&$image, &$watermark){
        $size = getimagesize($this->image_path);
        $orig_watermark_x = imagesx($watermark);
        $orig_watermark_y = imagesy($watermark);
        $im_x = $size[0];
        $im_y = $size[1];
        $cof = $im_x/($orig_watermark_x*5); // 5/1 = im_x/(wx*cof) ; wx*cof = im_x/5 ; cof = im_x/wx*5
        $w = intval($orig_watermark_x*$cof);
        $h = intval($orig_watermark_y*$cof);

        $watermark_mini = imagecreatetruecolor($w, $h);
        imagealphablending($watermark_mini, false);
        imagesavealpha($watermark_mini,true);
        imagecopyresampled($watermark_mini, $watermark, 0, 0, 0, 0, $w, $h, $orig_watermark_x, $orig_watermark_y);
        //
        $dest_x = $size[0] - $w - 5;
        $dest_y = $size[1] - $h -5;
        
        imagecopy($image, $watermark_mini, $dest_x,$dest_y , 0, 0, $w, $h);

        imagealphablending($image, false);
        imagesavealpha($image,true);

        switch($this->type_image){
            case IMAGETYPE_GIF:
                imagegif($image, $this->output_file);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image,$this->output_file,100);
                break;
            case IMAGETYPE_PNG:
                imagepng($image, $this->output_file, 9);
                break;
        }

        imagedestroy($image);
        imagedestroy($watermark);
        imagedestroy($watermark_mini);
        return true;
    }

}
?>