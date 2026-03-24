<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Guest Account Registered</title>
  <style>
    body {
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .email-wrapper {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .email-header {
      background: linear-gradient(135deg, #dc2d3d 0%, #b82532 100%);
      padding: 40px 30px;
      text-align: center;
    }

    .email-header h1 {
      color: #ffffff;
      margin: 0;
      font-size: 26px;
      font-weight: 700;
    }

    .email-header p {
      color: rgba(255, 255, 255, 0.9);
      margin: 10px 0 0 0;
      font-size: 15px;
    }

    .email-body {
      padding: 40px 30px;
    }

    .greeting {
      font-size: 19px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 16px;
    }

    .message {
      color: #555;
      font-size: 15px;
      line-height: 1.8;
      margin-bottom: 24px;
    }

    .info-box {
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
      border-left: 4px solid #dc2d3d;
      border-radius: 8px;
      padding: 24px;
      margin: 24px 0;
    }

    .info-box h3 {
      color: #dc2d3d;
      margin: 0 0 16px 0;
      font-size: 16px;
      font-weight: 700;
    }

    .info-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid rgba(220, 45, 61, 0.1);
    }

    .info-item:last-child {
      border-bottom: none;
    }

    .info-label {
      color: #666;
      font-size: 14px;
      font-weight: 500;
    }

    .info-value {
      color: #1a1a1a;
      font-size: 14px;
      font-weight: 600;
      background-color: #ffffff;
      padding: 6px 12px;
      border-radius: 6px;
      border: 1px solid #e0e0e0;
    }

    .btn-container {
      text-align: center;
      margin: 30px 0;
    }

    .btn-primary {
      display: inline-block;
      background: linear-gradient(135deg, #dc2d3d 0%, #b82532 100%);
      color: #ffffff;
      text-decoration: none;
      padding: 14px 36px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 15px;
    }

    .email-footer {
      background-color: #1a1a1a;
      padding: 28px;
      text-align: center;
    }

    .email-footer p {
      color: #999;
      font-size: 13px;
      margin: 5px 0;
    }

    .email-footer a {
      color: #dc2d3d;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="email-wrapper">
    <div class="email-header">
      <h1>New Guest Registration</h1>
      <p>Kingsford University – Magazine Contribution System</p>
    </div>
    <div class="email-body">
      <div class="greeting">Hello {{ $notifiable->name ?? 'Marketing Coordinator' }},</div>
      <div class="message">
        A new guest account has been registered under your faculty. You can view and manage guests from the Guest
        Management section.
      </div>
      <div class="info-box">
        <h3>Guest Details</h3>
        <div class="info-item">
          <span class="info-label">Name</span>
          <span class="info-value">{{ $guest->name }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Email</span>
          <span class="info-value">{{ $guest->email }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Faculty</span>
          <span class="info-value">{{ $faculty->name }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Registered At</span>
          <span class="info-value">{{ $guest->created_at->format('M d, Y H:i') }}</span>
        </div>
      </div>
      <div class="btn-container">
        <a href="{{ config('app.url') . '/guests' }}" class="btn-primary">View Guest List</a>
      </div>
    </div>
    <div class="email-footer">
      <p><strong>Kingsford University</strong></p>
      <p>Magazine Contribution System</p>
      <p style="margin-top:12px;font-size:12px;">© {{ date('Y') }} Kingsford University. All rights reserved.</p>
    </div>
  </div>
</body>

</html>