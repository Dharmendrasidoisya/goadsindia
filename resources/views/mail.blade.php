<!DOCTYPE html>
<html>
<head>
    <title>Get It From Kabra Trading Co.</title>
    <style>
        
        .email-container {
            background: #ffffff;
            max-width: 600px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            border-radius: 5px 5px 0 0;
            font-size: 20px;
            font-weight: bold;
        }
        .email-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .email-table th, .email-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .email-table th {
            background-color: #f4f4f4;
        }
        .email-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="email-header">Get It From Kabra Trading Co.</div>

    <table class="email-table">
        <tr>
            <th>Name</th>
            <td>{{$name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$email}}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{$phone}}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{$location}}</td>
        </tr>
        <tr>
            <th>Message</th>
            <td>{{$mes}}</td>
        </tr>
    </table>

    <div class="email-footer">
        <p>Thank you for your inquiry. We will get back to you soon.</p>
    </div>
</div>

</body>
</html>
