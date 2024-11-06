<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Presentation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .qr-card {
      border: none;
      border-radius: 15px;
      background-color: #fff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      max-width: 100%;
    }

    .card-header {
      background-color: #BDE0FE;
      color: black;
      text-align: center;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .qr-code-container {
      padding: 20px;
      background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(238, 238, 238, 1) 100%);
      border-radius: 15px;
      display: inline-block;
      width: 100%;
      /* Ensure full width on small devices */
      max-width: 300px;
      /* Limit the maximum width */
      margin: 0 auto;
    }

    img {
      width: 100%;
      height: auto;
      max-width: 100%;
      border-radius: 10px;
    }

    h4 {
      font-weight: bold;
      letter-spacing: 1px;
    }

    .btn-custom {
      background-color: #6c757d;
      color: #fff;
      border-radius: 50px;
      padding: 10px 30px;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #5a6268;
      color: #e2e6ea;
      transform: scale(1.05);
    }

    /* Mobile View Optimization */
    @media (max-width: 576px) {
      .card-header h4 {
        font-size: 1.2rem !important;
        padding: 10px;
      }

      .qr-code-container {
        padding: 15px;
        max-width: 100%;
        /* Let the QR code take full width on small devices */
      }

      .btn-custom {
        padding: 8px 20px;
        font-size: 0.9rem;
      }

      p {
        font-size: 0.9rem;
      }
    }

    /* Tablet View Optimization */
    @media (min-width: 577px) and (max-width: 992px) {
      .qr-code-container {
        max-width: 250px;
      }
    }
  </style>
</head>

<body>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10 col-12">
        <div class="card qr-card">
          <div class="card-header">
            <h4 class="mb-0">QR Code</h4>
            <!-- Optional: Display the QR Code Title -->
            <!-- <h6>{{ $qrCode->title }}</h6> -->
          </div>
          <div class="card-body text-center">
            <div class="qr-code-container mb-4">
              <!-- Display QR Code Image -->

              <img src="data:image/png;base64,{{ base64_encode($qrCodeImageWithLogo) }}" alt="QR Code"
                class="img-fluid">
            </div>
            <!-- Optional: Add a description or details -->
            <p class="text-muted mb-4">
              Scan this QR code to access the content.
            </p>
            <a href="{{ route('qrcode.download', $qrCode->id) }}" class="btn btn-custom">
              Download QR Code
            </a>

            <a href="{{ route('qrcodes.create', $qrCode->id) }}" class="btn btn-custom">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>