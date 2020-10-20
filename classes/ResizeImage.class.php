<?php

/**
 * User: Mole
 * Date: 10/19/2017
 * Time: 1:13 PM
 * Info: common image ratios are 4:3(1.3333), 3:2(1.5), 1:1(1), 16:9(1.7777)
 */
class ResizeImage
{

  private $image_folder;         /* the folder of our images */
  private $image_path;           /* The full image path and name ex. 'resized_images/sunrise.jpg' */
  private $original_width;       /* The original width of the given image */
  private $original_height;      /* The original height of the given image */
  private $aspect_ratio;         /* The original aspect ratio of the given image */
  private $type;                 /* The image type 'jpg, gif, png' */

  private $new_image_name;       /* The resized image name ex 'res_sunrise.jpg' */
  private $new_image_path;       /* The full resized image path and name ex. 'resised_images/res_sunrise.jpg' */

  private $new_crop_name;        /* The croped image name ex 'crop_sunrise.jpg' */
  private $crop_image_path;      /* The full croped image path and name ex. 'resised_images/crop_sunrise.jpg' */

  private $new_width;            /* The new width to resize the picture */
  private $new_height;           /* The new height to resize the picture */

  private $quality = 100;        /* The quality of the resampled image, only for jpg and gif files */
  private $png_quality = 7;      /* The quality of the resampled image, only for png files */

  private $new_ratio;            /* The new aspect ratio when resizing and cropping an image to a specific ratio   */
  private $ratio_19_9 = 1.77777; /* The 16:9 ratio */
  private $ratio_4_3 = 1.33333;  /* The 4:3 ratio */
  private $ratio_3_2 = 1.5;      /* The 3:2 ratio */
  private $min_width = 1000;     /* The minimum width size for uploaded image */

  private $error;

  /**
   * ResizeImage constructor.
   * @param $image the given image url
   * @param $post_folder
   */
  public function __construct($image,$post_folder){

    /* Initializing our class fields */
    $this->image_path = $image;
    $this->image_folder = $post_folder;
    list($this->original_width, $this->original_height, $this->type) = getimagesize($this->image_path);

    $this->aspect_ratio = $this->original_width/ $this->original_height;
    
    // do keep both resolutions use the res_ prefix.
    // and comment out the imagedestroy($src) in main resize function. 
    
    # $this->new_image_name = 'res_'.basename($this->image_path);
    $this->new_image_name = basename($this->image_path);
    
    $this->new_image_path = $this->image_folder. $this->new_image_name;

    $this->new_crop_name = 'crop_'.basename($this->image_path);

    $this->crop_image_path = $this->image_folder. $this->new_crop_name;
  }


  /**
   * Resizing and keeping the aspect ratio.
   * @param $new_width
   * @return bool
   */
  public function resizeInRatio($new_width)
  {
    $this->new_width = $new_width;
    $this->new_height = $new_width/$this->aspect_ratio;
    $this->resize();
  }


  /**
   * Resizing with fixed values.
   * @param int $res_width , the width to resize the image in ratio.
   * @param $crop_width
   * @param $crop_height
   */
  public function cropToThumbs($res_width, $crop_width, $crop_height)
  {
    $this->resizeInRatio($res_width);

    list($this->original_width, $this->original_height, $this->type) = getimagesize($this->new_image_path);

    $this->crop($crop_width, $crop_height);
    //unlink($this->new_image_path);
  }


  /**
   * Resizing an image to 16:9 ratio
   * @param $new_width
   */
  public function resizeTo_16_9($new_width)
  {
    $this->new_ratio = $this->ratio_19_9;
    $this->resizeToRatio($new_width);
  }


  /**
 * Resizing an image to 4:3 ratio
 * @param $new_width
 */
  public function resizeTo_4_3($new_width)
  {
    $this->new_ratio = $this->ratio_4_3;
    $this->resizeToRatio($new_width);
  }


  /**
   * Resizing an image to 3:2 ratio
   * @param $new_width
   */
  public function resizeTo_3_2($new_width)
  {
    $this->new_ratio = $this->ratio_3_2;
    $this->resizeToRatio($new_width);
  }


  /**
   * resizing an image and changing the ratio
   * @param $new_width
   * @return bool
   */
  private function resizeToRatio($new_width)
  {

    $new_width = $new_width + 100;
    $this->resizeInRatio($new_width);
    list($this->original_width, $this->original_height, $this->type) = getimagesize($this->new_image_path);
    $ratio_width = $this->original_width - 100;
    $ratio_height = ($ratio_width / $this->new_ratio);

    $this->crop($ratio_width,$ratio_height);
    unlink($this->new_image_path);
    return true;
  }

  /**
   * Main crop code
   * @param $crop_width
   * @param $crop_height
   * @return bool
   */
  private function crop($crop_width,$crop_height)
  {

    $src_x = ($this->original_width / 2) - ($crop_width / 2);
    $src_y = ($this->original_height / 2) - ($crop_height / 2);

    if($this->type == 1){
      $src = imagecreatefromgif($this->new_image_path);
    }else if($this->type == 2){
      $src = imagecreatefromjpeg($this->new_image_path);
    }else if($this->type == 3){
      $src = imagecreatefrompng($this->new_image_path);
    }else{
      // nothing yet.
    }

    $temp = imagecreatetruecolor($crop_width, $crop_height);
    imagecopyresampled($temp, $src, 0, 0, $src_x, $src_y, $crop_width, $crop_height, $crop_width,
      $crop_height);

    if($this->type == 1){
      imagegif($temp,$this->image_path, $this->quality);
    }else if($this->type == 2){
      imagejpeg($temp,$this->image_path, $this->quality);
    }else if($this->type == 3){
      imagepng($temp,$this->image_path, $this->png_quality);
    }else{
      // nothing yet.
    }
    //imagedestroy($src);
    imagedestroy($temp);

    return true;
  }


  /**
   * Main resize code
   * All properties are initiated in the class constructor.
   * The 1, 2 and 3 values are coming from the getimagesize() function
   * and they declaring the image type.
   * 1 = gif
   * 2 = jpeg
   * 3 = png
   * @return bool
   */
  private function resize()
  {

    if($this->type == 1){
      $src = imagecreatefromgif($this->image_path);
    }else if($this->type == 2){
      $src = imagecreatefromjpeg($this->image_path);
    }else if($this->type == 3){
      $src = imagecreatefrompng($this->image_path);
    }else{
      // nothing yet.
    }

    $temp = imagecreatetruecolor($this->new_width, $this->new_height);
    imagecopyresampled($temp, $src, 0, 0, 0, 0, $this->new_width, $this->new_height, $this->original_width,
      $this->original_height);

    if($this->type == 1){
      imagegif($temp,$this->new_image_path, $this->quality);
    }else if($this->type == 2){
      imagejpeg($temp,$this->new_image_path, $this->quality);
    }else if($this->type == 3){
      imagepng($temp,$this->new_image_path, $this->png_quality);
    }else{
      // nothing yet.
    }
    imagedestroy($src);
    imagedestroy($temp);

    return true;
  }


  /**
   * @return mixed
   */
  public function getError()
  {
    return $this->error;
  }









} // end of class