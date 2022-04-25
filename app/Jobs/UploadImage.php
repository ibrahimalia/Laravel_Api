<?php

namespace App\Jobs;
use Image;
use App\Models\Design;
use File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $design;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Design $design)
    {
        //
        $this->design = $design;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $disk= $this->design->disk;
        $original_file = storage_path().'/uploads/original/'. $this->design->image;
        try {
            Image::make($original_file)->fit(800,600,function($constraint){
                $constraint->aspectRatio();
            })->save( $large = storage_path('uploads/large/'. $this->design->image));

            Image::make($original_file)->fit(800,600,function($constraint){
                $constraint->aspectRatio();
            })->save( $thumbnail = storage_path('uploads/thumbnail/'. $this->design->image));
            //original image
            if(Storage::disk($disk)
            ->put('uploads/designs/original/'.$this->design->image,fopen($original_file,'r+'))) {
               File::delete($original_file);
            }
            //large image
            if(Storage::disk($disk)
            ->put('uploads/designs/large/'.$this->design->image,fopen($large,'r+'))) {
               File::delete($large);
            }
            //thumbnail image
            if(Storage::disk($disk)
            ->put('uploads/designs/thumbnail/'.$this->design->image,fopen($thumbnail,'r+'))) {
               File::delete($thumbnail);
            }
            //update database record with success flag
            $this->design->update([
              'upload_successfule' => true
            ]);


        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
