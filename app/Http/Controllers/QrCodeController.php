<?php
#
#namespace App\Http\Controllers;
#
#use App\Models\QrCode;
#use Illuminate\Http\Request;
#use QrCode as QRCodeGenerator;
#
#class QrCodeController extends Controller
#{
#  public function store(Request $request)
#  {
#    $request->validate([
#      'title' => 'required|string|max:255',
#      'description' => 'required|string',
#      'url' => 'required|url',
#    ]);
#
#    // Generate QR Code based on the URL
#    $qrCodeImage = QRCodeGenerator::format('png')
#      ->size(200)
#      ->generate($request->url);
#
#    $qrCode = new QrCode;
#    $qrCode->title = $request->title;
#    $qrCode->description = $request->description;
#    $qrCode->url = $request->url;
#    $qrCode->qr_code_image = base64_encode($qrCodeImage); // Save the QR code as a base64 string
#    $qrCode->save();
#
#    return redirect()->route('qrcodes.create');
#  }
#
#  public function generateQrCode(Request $request)
#  {
#    $request->validate([
#      'url' => 'required|url',
#    ]);
#
#    // Generate QR Code based on the URL
#    $qrCodeImage = QRCodeGenerator::format('png')
#      ->size(200)
#      ->generate($request->url);
#
#    return response()->json(['qrCode' => base64_encode($qrCodeImage)]);
#  }
#}

#namespace App\Http\Controllers;
#use Illuminate\Http\Request;
#use SimpleSoftwareIO\QrCode\Facades\QrCode;
#class QrCodeController extends Controller
#{
#  public function index()
#  {
#    return view('qr-form');
#  }
#
#  public function generate(Request $request)
#  {
#    $request->validate([
#      'title' => 'required',
#      'url' => 'required|url',
#      'description' => 'nullable',
#    ]);
#
#    $qrCode = QrCode::size(200)->generate($request->url);
#
#    return view('qr-result', [
#      'title' => $request->title,
#      'description' => $request->description,
#      'qrCode' => $qrCode
#    ]);
#  }
#}
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;

class QrCodeController extends Controller
{
  public function create()
  {
    return view('qrcode.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'url' => 'required|url',
      'description' => 'required|string',
    ]);

    $qrCode = QrCode::create($request->all());


    return redirect()->route('qrcodes.show', $qrCode->id);
  }

  public function show($id)
  {
    $qrCode = QrCode::findOrFail($id);

    return view('qrcode.show', compact('qrCode'));
  }

  public function generateQrCode($id)
  {
    $qrCode = QrCode::findOrFail($id);
    // $qrCodeImage = QrCodeGenerator::size(200)->generate($qrCode->url);
    $qrCodeImage = QrCodeGenerator::size(200)
      ->errorCorrection('H') // Higher error correction
      ->color(23, 5, 100) // Blue color
      // ->border(4, 23, 5, 100)
      ->backgroundColor(255, 255, 255) // White background
      ->margin(10) // Adds a border/margin of 10 pixels
      ->generate($qrCode->url);

    // To add a logo
    // $logoPath = public_path('storage/images/logo.jpg');

    // $logoPath = public_path() . '\storage\images\logo.jpg';
    // $logoPath = base_path('public/storage/images/logo.jpg');

    $qrCodeImageWithLogo = QrCodeGenerator::size(200)
      ->errorCorrection('H') // Higher error correction
      ->color(0, 0, 255) // Blue color
      ->backgroundColor(255, 255, 255) // White background
      ->margin(10) // Adds a border/margin of 10 pixels
      // ->merge($logoPath, 0.2) // Use the local file path and size ratio (0.2 is 20% of the QR size)
      ->generate($qrCode->url);
    return view('qrcode.qrcode', compact('qrCode', 'qrCodeImage'));
  }

}
