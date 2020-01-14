<?php

/**
 * CompressImage
 * 
 * @author Renzo Nogueira
 * @since 1.0 Documentação inicial.
 * 
 * Compresses images while maintaining a good resolution.
 * Exemple: CompressImage::compress("image.jpeg", 200, 200, 75, 'jpeg');
 */
class CompressImage
{

    /**
     * compress
     * 
     * @author Renzo Nogueira
     * @since 1.0 Documentação inicial.
     * @param $fileName Path, URL, or base64 of the image.
     * @param $maxWidth Maximum width of the image.
     * @param $maxHeight Maximum height of the image.
     * @param $quality Percent of the quality relative to the original image. The default is 50.
     * @param $type Output type (jpeg, png, gif). The default is 'jpeg'.
     */
    public static function compress($fileName, $maxWidth, $maxHeight, $quality, $type)
    {
        // GETTING ORIGINAL SIZE
        list($width_orig, $height_orig) = getimagesize($fileName);
        // CALCULATING PROPORTION
        $ratio_orig = $width_orig / $height_orig;
        if ($maxWidth / $maxHeight > $ratio_orig) {
            $maxWidth = $maxHeight * $ratio_orig;
        } else {
            $maxHeight = $maxWidth / $ratio_orig;
        }
        // RESIZED
        $image_p = imagecreatetruecolor($maxWidth, $maxHeight);
        $image = imagecreatefromjpeg($fileName);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $width_orig, $height_orig);
        // RENDERING
        switch ($type) {                                                                // Creates image file based on the specified type.
            case 'png':
                imagepng($image_p, 'image_data.png', $quality <= 100 ? $quality : 50);
                break;
            case 'gif':
                imagegif($image_p, 'image_data.gif', $quality <= 100 ? $quality : 50);
                break;
            default:
                imagegif($image_p, 'image_data.jpeg', $quality <= 100 ? $quality : 50);
        }
        $path = 'image_data.' . $type;
        $type = pathinfo($path, PATHINFO_EXTENSION);                                    // Image info.
        $data = file_get_contents($path);                                               // Binary handle of the generated image
        $binary = $data;                                                                // Binary text to use for writing file.
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);            // Code for base64 to send.

        return array(
            'binary' => $binary,
            'base64' => $base64
        );
    }
}