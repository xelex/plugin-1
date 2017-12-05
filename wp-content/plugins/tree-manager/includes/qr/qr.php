<?php 
    include dirname( __FILE__ ) . '/phpqrcode.php';

    function generate_qr_image($url) {
        $f2 = 'img/background.png';

        $center_x = 366 + 133;
        $center_y = 410 + 133;

        $outerFrame = 0;
        $pixelPerPoint = 13;
        
        // generating frame 
        $frame = QRcode::text($url, false, QR_ECLEVEL_L); 
        
        // rendering frame with GD2 (that should be function by real impl.!!!) 
        $h = count($frame); 
        $w = strlen($frame[0]); 
        
        $imgW = $w + 2*$outerFrame; 
        $imgH = $h + 2*$outerFrame; 
        
        $base_image = imagecreate($imgW, $imgH); 
        
        $col[0] = imagecolorallocate($base_image,255,255,255); // BG, white  
        $col[1] = imagecolorallocate($base_image,0,0,0);     // FG, blue 

        imagefill($base_image, 0, 0, $col[0]); 

        for($y=0; $y<$h; $y++) { 
            for($x=0; $x<$w; $x++) { 
                if ($frame[$y][$x] == '1') { 
                    imagesetpixel($base_image,$x+$outerFrame,$y+$outerFrame,$col[1]);  
                } 
            } 
        } 
        
        // saving to file 
        $image1 = imagecreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint); 
        imagecopyresized( 
            $image1,  
            $base_image,  
            0, 0, 0, 0,  
            $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH 
        );

        $info2 = getimagesize($f2);
        $image2 = imagecreatefrompng($f2);
        
        $merged_image = imagecreatetruecolor($info2[0], $info2[1]);
        imagealphablending($merged_image, false);
        imagesavealpha($merged_image, true);

        imagecopy($merged_image, $image2, 0, 0, 0, 0, $info2[0], $info2[1]);
        imagecopymerge($merged_image, $image1, $center_x - $imgW * $pixelPerPoint/2, $center_y - $imgH * $pixelPerPoint/2, 0, 0, $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, 100);

        return imagepng($merged_image);
    }

    $url = $_REQUEST['url'];
    $preview = $_REQUEST['preview'];
    $pdf = $_REQUEST['pdf'];

    $we_need_x = 0;
    $we_need_y = 0;

    if ($url) {
        if ($preview) {
            // single page
            header('Content-Type: image/png');
            print(generate_qr_image($url));
        } else {
            // many pages
        }
    }