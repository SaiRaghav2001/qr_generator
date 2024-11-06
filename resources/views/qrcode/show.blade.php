<!--  -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
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

    .btn-customs {
      background-color: #6c757d;
      color: #fff;
      border-radius: 45px;
      padding: 8px 24px;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .btn-customs:hover {
      background-color: #5a6268;
      color: #e2e6ea;
      transform: scale(1.05);
    }

    .card-header {
      background-color: #BDE0FE;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header">
            <h2 class="mb-0 text-center">QR Code Details</h2>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <p><strong>Title:</strong> <span class="text-muted">{{ $qrCode->title }}</span></p>
            </div>
            <div class="mb-3">
              <p><strong>URL:</strong> <a href="{{ $qrCode->url }}" class="text-primary"
                  target="_blank">{{ $qrCode->url }}</a></p>
            </div>
            <div class="mb-3">
              <p><strong>Description:</strong> <span class="text-muted">{{ $qrCode->description }}</span></p>
            </div>

            <div class="d-flex justify-content-start">
              <a href="{{ route('qrcodes.generate', $qrCode->id) }}" class="btn btn-customs me-2">Generate QR Code</a>
              <a href="{{ route('dashboard', ) }}" class="btn btn-custom">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>