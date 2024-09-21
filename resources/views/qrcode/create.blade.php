<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create QR Code</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
      max-width: 600px;
      background-color: #fff;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .form-group label {
      font-weight: bold;
    }

    h2 {
      margin-bottom: 30px;
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Create QR Code</h2>
    <!-- <img src="storage/images/logo.jpg" /> -->
    <form action="{{ route('qrcodes.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
      </div>
      <div class="form-group">
        <label for="url">URL</label>
        <input type="url" class="form-control" id="url" name="url" placeholder="Enter URL" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"
          placeholder="Enter description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Save</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>