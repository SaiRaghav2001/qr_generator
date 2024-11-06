<?php
namespace App\Http\Controllers;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;


class QrCodeController extends Controller
{
  public function create()
  {
    return view('qrcode.create');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|string|max:255',
      'url' => 'required|url',
      'description' => 'nullable|string',
    ]);

    $qrCode = QrCode::create($validatedData);

    // Return the ID of the created QR code as JSON
    return response()->json(['id' => $qrCode->id]);
  }

  public function show($id)
  {
    $qrCode = QrCode::findOrFail($id);

    return view('qrcode.show', compact('qrCode'));
  }

  public function generateQrCode($id)
  {
    $qrCode = Qrcode::findOrFail($id);

    // Generate QR code with logo
    $qrCodeImageWithLogo = QrCodeGenerator::format('png')
      ->size(240)
      ->errorCorrection('H')
      ->backgroundColor(255, 255, 255)
      ->margin(12)
      ->merge('storage/images/kmlogo.png', 0.15, true)
      ->generate($qrCode->url);

    // Create file path to save the QR code image
    $fileName = 'qrcode_' . $qrCode->id . '.png';
    $filePath = public_path('qr_codes/' . $fileName);

    // Store the generated QR code image in the public directory
    Storage::put('public/qr_codes/' . $fileName, $qrCodeImageWithLogo);

    return view('qrcode.qrcode', [
      'qrCode' => $qrCode,
      'qrCodeImageWithLogo' => $qrCodeImageWithLogo,
      'filePath' => asset('storage/qr_codes/' . $fileName), // Add this for the download link


    ]);
  }
  public function downloadQrCode($id)
  {
    $qrCode = Qrcode::findOrFail($id);
    $filePath = 'public/qr_codes/qrcode_' . $qrCode->id . '.png';

    // Check if the file exists in storage
    if (Storage::exists($filePath)) {
      $fileContent = Storage::get($filePath);
      $headers = [
        'Content-Type' => 'image/png',
        'Content-Disposition' => 'attachment; filename="qrcode_' . $qrCode->id . '.png"',
      ];

      return Response::make($fileContent, 200, $headers);
    } else {
      return abort(404, 'QR Code not found.');
    }
  }

}
