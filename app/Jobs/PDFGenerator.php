<?php

namespace App\Jobs;

use App\Models\Donwload;
use Dompdf\Dompdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class PDFGenerator implements ShouldQueue
{
    use Queueable;

    protected $posts;

    /**
     * Create a new job instance.
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();

        $html = view('pdf', ['posts' => $this->posts])->render();

        $domPdf = new Dompdf();

        $domPdf->loadHtml($html);
        $domPdf->setPaper('A4', 'landscape');
        $domPdf->render();

        $pdfOutput = $domPdf->output();

        $pdfPath = 'public/' . $uuid . '.pdf';
        Storage::put($pdfPath, $pdfOutput);
        $pdfUrl = Storage::url($pdfPath);

        Donwload::query()->create([
            'link' => env('APP_URL') . $pdfUrl
        ]);


    }
}
