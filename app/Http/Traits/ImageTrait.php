<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    public function img($file, $path = 'images/home/', $old_file = 'test.png')
    {
        $old_file = $old_file ?? 'test.png';
        $this->deleteImg($old_file);
        // check if svg
        if ($file->getClientOriginalExtension() === 'svg') {
            return $this->svg($file, $path);
        } else {
            $filename = md5($file->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $file->getClientOriginalExtension();
            Image::Make($file)->encode('webp', 100)->save(public_path($path . $filename . '.webp'));
            return $path . $filename . '.webp';
        }
    }

    public function svg($file, $path = 'images/icons/')
    {
        $filename = md5($file->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $filename);
        return $path . $filename;
    }

    public function deleteImg($file)
    {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }

}
