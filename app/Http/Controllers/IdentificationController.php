<?php

namespace App\Http\Controllers;

use App\Models\Identification;
use Illuminate\Http\Client\Response as HttpResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class IdentificationController extends Controller
{
    /**
     * URL dan kredensial untuk Gemini API.
     */
    private string $geminiApiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
    private ?string $geminiApiKey;

    public function __construct()
    {
        // Mengambil API key dari file konfigurasi services.
        $this->geminiApiKey = config('services.gemini.key');
    }

    /**
     * Menampilkan halaman form upload utama.
     */
    public function showUploadForm()
    {
        return view('IdentificationImage.formUploudImage');
    }

    /**
     * Metode utama untuk memproses unggahan gambar.
     */
    public function processImage(Request $request): RedirectResponse
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg|max:5120']);

        try {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->file('image');

            // 1. Panggil Gemini API
            $apiResponse = $this->callGeminiApi($uploadedFile);

            // 2. Proses dan format hasil dari API
            $processedResult = $this->processGeminiApiResponse($apiResponse);

            // 3. Tambahkan path gambar ke data hasil
            $processedResult['image_path'] = $this->storeImage($uploadedFile, 'results');

            // 4. Simpan ke database jika identifikasi berhasil
            if ($processedResult['label'] !== 'Tidak dapat diidentifikasi') {
                Identification::create([
                    'image_path'       => $processedResult['image_path'],
                    'identified_as'    => $processedResult['label'],
                    'confidence_score' => $processedResult['score'], // Gemini tidak memberi skor, kita set 1 (ditemukan)
                    'ai_raw_response'  => $processedResult['raw_response'],
                ]);
            }

            // 5. Kembalikan pengguna ke halaman form dengan membawa data hasil lengkap
            return redirect()->route('identification.form')->with('result', $processedResult);

        } catch (Throwable $e) {
            Log::error("Gagal memproses gambar: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('identification.form')
                ->withErrors('Terjadi kesalahan pada server saat memproses gambar Anda. Tim kami telah diberitahu.');
        }
    }

    // --- METODE-METODE PEMBANTU (PRIVATE HELPERS) ---

    private function storeImage(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, 'public');
    }

    /**
     * Memanggil Gemini API dengan prompt dan gambar.
     */
    private function callGeminiApi(UploadedFile $file): HttpResponse
    {
        if (!$this->geminiApiKey) {
            abort(500, 'Gemini API Key tidak dikonfigurasi.');
        }

        $base64Image = base64_encode($file->get());

        // Prompt ini dirancang agar Gemini memberikan jawaban yang terstruktur
        $prompt = "Tolong identifikasi tanaman dalam gambar ini. Berikan jawaban dalam format berikut, dan hanya format ini:\nNama Umum: [Nama Umum Tanaman]\nNama Ilmiah: [Nama Ilmiah Tanaman]\nDeskripsi: [Deskripsi singkat 2-3 kalimat tentang tanaman ini]";

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                        [
                            'inline_data' => [
                                'mime_type' => $file->getMimeType(),
                                'data' => $base64Image
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Untuk development lokal, Anda mungkin perlu menambahkan `Http::withoutVerifying()->...`
        return Http::post($this->geminiApiUrl . '?key=' . $this->geminiApiKey, $payload);
    }

    /**
     * Memproses respons teks dari API Gemini menjadi format yang kita inginkan.
     */
    private function processGeminiApiResponse(HttpResponse $response): array
    {
        $responseData = $response->json();

        $defaultResult = [
            'label'        => 'Tidak dapat diidentifikasi',
            'score'        => 0, // Gemini tidak memberi skor, 0 berarti gagal
            'details'      => null,
            'description'  => 'AI tidak dapat mengenali gambar ini. Coba lagi dengan gambar yang lebih jelas.',
            'raw_response' => $responseData ?? ['error' => 'Respons API kosong.'],
        ];

        if (!$response->successful()) {
            Log::warning('Gemini API merespons dengan error:', ['status' => $response->status(), 'body' => $response->body()]);
            return $defaultResult;
        }

        $textResponse = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$textResponse) {
            return $defaultResult;
        }

        preg_match('/Nama Umum: (.*?)\n/i', $textResponse, $commonNameMatches);
        preg_match('/Nama Ilmiah: (.*?)\n/i', $textResponse, $scientificNameMatches);
        preg_match('/Deskripsi: (.*)/is', $textResponse, $descriptionMatches);

        $commonName = trim($commonNameMatches[1] ?? 'N/A');
        $scientificName = trim($scientificNameMatches[1] ?? 'N/A');
        $description = trim($descriptionMatches[1] ?? 'Tidak ada deskripsi.');

        if ($commonName === 'N/A' || str_contains(strtolower($commonName), 'tidak dapat')) {
            return $defaultResult;
        }

        return [
            'label'        => ucwords($commonName),
            'score'        => 1, // 1 berarti berhasil diidentifikasi
            'details'      => [
                'scientific_name' => $scientificName,
            ],
            'description'  => $description,
            'raw_response' => $responseData,
        ];
    }
}
