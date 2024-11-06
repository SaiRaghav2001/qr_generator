<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create QR Code</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
    }

    .container {
      margin-top: 50px;
      max-width: 600px;
      padding: 40px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
    }

    h2 {
      margin-bottom: 30px;
      font-weight: bold;
      text-align: center;
      letter-spacing: 1px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px;
    }

    button[type="submit"] {
      background-color: #007bff;
      border-radius: 50px;
      font-weight: bold;
      padding: 12px;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Create QR Code</h2>
    <form id="qrCodeForm">
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
      <button type="button" class="btn btn-primary btn-block" id="saveButton">Save QR Code</button>
    </form>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="qrCodeModalLabel">QR Code Ready</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Your details have been saved successfully. Would you like to generate the QR code?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="generateQrCode">Generate QR Code</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Handle the Save button click event
    document.getElementById('saveButton').addEventListener('click', function (event) {
      event.preventDefault(); // Prevent form submission

      // Simulate form submission via AJAX or send the data to the backend
      let formData = {
        title: $('#title').val(),
        url: $('#url').val(),
        description: $('#description').val(),
        _token: $('input[name=_token]').val(),
      };

      $.ajax({
        url: '{{ route('qrcodes.store') }}',
        // url: 'https://d60a-45-112-136-250.ngrok-free.app/qrcodes/store', // Route for storing QR code details
        method: "POST",
        data: formData,
        success: function (response) {
          // Show the modal
          $('#qrCodeModal').modal('show');

          // Store the QR Code ID in a variable to use later
          var qrCodeId = response.id;

          // Handle Generate QR Code button click event inside the modal
          document.getElementById('generateQrCode').addEventListener('click', function () {
            // Redirect to the generate QR code page using the returned ID
            window.location.href = "/qrcodes/" + qrCodeId + "/generate";
          });

        },
        error: function (xhr) {
          alert('Error saving QR code.');
        }
      });
    });
  </script>
  <!-- <script>

    document.getElementById('saveButton').addEventListener('click', function (event) {
      event.preventDefault();

      let formData = new FormData();
      formData.append('title', document.getElementById('title').value);
      formData.append('url', document.getElementById('url').value);
      formData.append('description', document.getElementById('description').value);
      formData.append('_token', document.querySelector('input[name=_token]').value);

      fetch('{{ route('qrcodes.store') }}', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          if (data.id) {

            let qrCodeModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
            qrCodeModal.show();


            var qrCodeId = data.id;


            document.getElementById('generateQrCode').addEventListener('click', function () {

              window.location.href = "/qrcodes/" + qrCodeId + "/generate";
            });
          }
        })
        .catch(error => {
          alert('Error saving QR code.');
        });
    });
  </script> -->

</body>

</html>