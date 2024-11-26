<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScrapingController extends Controller
{
    public function scrapeProduct(Request $request)
    {
        $url = $request->input('url'); // URL yang diinputkan pengguna
        $output = null;

        // Menjalankan skrip Puppeteer menggunakan Node.js
        $command = "node scrape.js {$url}";
        exec($command, $output);

        // Mengembalikan hasil scraping sebagai respons
        return response()->json([
            'data' => json_decode(implode($output))
        ]);
    }
}
