<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfTestController extends Controller
{
    public function generate()
    {
        // Paths
        $sealPath = public_path('admin/images/inv_image/seal.png');
        $signPath = public_path('admin/images/inv_image/signature.png');
        $finalPath = public_path('admin/images/inv_image/final_signature.png');

        if (!file_exists($finalPath)) {
            $seal = imagecreatefrompng($sealPath);
            $sign = imagecreatefrompng($signPath);

            // Transparency enable
            imagesavealpha($seal, true);
            imagealphablending($seal, true);

            imagesavealpha($sign, true);
            imagealphablending($sign, true);

            // sizes
            $seal_w = imagesx($seal);
            $seal_h = imagesy($seal);
            $sign_w = imagesx($sign);
            $sign_h = imagesy($sign);

            // ---- Resize Seal proportional to signature ----
            $maxSealW = $sign_w * 0.8; // seal will cover 80% of signature width
            $maxSealH = $sign_h * 0.8; // seal will cover 80% of signature height

            $ratio = min($maxSealW / $seal_w, $maxSealH / $seal_h);
            $newSealW = intval($seal_w * $ratio);
            $newSealH = intval($seal_h * $ratio);

            $resizedSeal = imagecreatetruecolor($newSealW, $newSealH);
            imagesavealpha($resizedSeal, true);
            imagealphablending($resizedSeal, false);

            // transparent background
            $transparent = imagecolorallocatealpha($resizedSeal, 255, 255, 255, 127);
            imagefill($resizedSeal, 0, 0, $transparent);

            imagecopyresampled(
                $resizedSeal,
                $seal,
                0, 0, 0, 0,
                $newSealW, $newSealH,
                $seal_w, $seal_h
            );

            // ---- Create bigger transparent canvas ----
            $finalW = max($sign_w, $newSealW);
            $finalH = max($sign_h, $newSealH);

            $canvas = imagecreatetruecolor($finalW, $finalH);
            imagesavealpha($canvas, true);
            imagealphablending($canvas, false);
            $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
            imagefill($canvas, 0, 0, $transparent);

            // ---- Place seal first (background) ----
            $seal_x = ($finalW - $newSealW) / 2;
            $seal_y = ($finalH - $newSealH) / 2;
            imagecopy($canvas, $resizedSeal, $seal_x, $seal_y, 0, 0, $newSealW, $newSealH);

            // ---- Place signature on top ----
            $sign_x = ($finalW - $sign_w) / 2;
            $sign_y = ($finalH - $sign_h) / 2;
            imagecopy($canvas, $sign, $sign_x, $sign_y, 0, 0, $sign_w, $sign_h);

            // save merged image (transparent PNG)
            imagepng($canvas, $finalPath);

            imagedestroy($seal);
            imagedestroy($sign);
            imagedestroy($resizedSeal);
            imagedestroy($canvas);
        }

        // आता PDF ला final_signature.png पाठव
        $pdf = Pdf::loadView('test', [
            'finalSignature' => 'admin/images/inv_image/final_signature.png'
        ]);

        return $pdf->stream('test.pdf'); // opens in browser
    }
}
