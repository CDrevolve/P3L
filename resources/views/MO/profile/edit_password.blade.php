<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAF6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFD9C0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Password</h2>
        <form method="POST" action="{{ route('mo.profile.updatePassword') }}">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</body>
</html>
