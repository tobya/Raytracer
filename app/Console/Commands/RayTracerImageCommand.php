<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RayTracerImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raytracer:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->GenerateImage();

        return 0;
    }

    public function GenerateImage()
    {
        $imgHeight = 256;
        $imgWidth = 256;
        $text = "P3\n $imgWidth $imgHeight\n255\n";
        for ($j = $imgHeight-1;$j >= 0; $j--){
            for ($i = 0;$i < $imgWidth; $i++){
                $r = $i / ($imgWidth -1);
                $g = $j / ($imgHeight -1);
                $b = 0.75;

                $ir = intval(255.999 * $r);
                $ig = intval(255.999 * $g);
                $ib = intval(255.999 * $b);
                $text .= "$ir $ig $ib \n";
            }
        }
       echo Storage::put('image.ppm',$text);
    }
}
