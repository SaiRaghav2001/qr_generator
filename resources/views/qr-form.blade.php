<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Generator</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>QR Code Generator</h1>

    <form action="{{ route('generate.qr') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title" required>
      </div>

      <div class="form-group">
        <label for="url">URL</label>
        <input type="url" class="form-control" id="url" name="url" placeholder="Enter the URL" required>
      </div>

      <div class="form-group">
        <label for="description">Description (optional)</label>
        <textarea class="form-control" id="description" name="description" rows="3"
          placeholder="Enter an optional description"></textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Generate QR Code</button>
    </form>
  </div>

  <!-- Bootstrap JS and dependencies (optional, for any interactive elements) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>