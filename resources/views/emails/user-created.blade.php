<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Kingsford University</title>
  <style>
    body {
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
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
      font-size: 28px;
      font-weight: 700;
    }

    .email-header p {
      color: rgba(255, 255, 255, 0.9);
      margin: 10px 0 0 0;
      font-size: 16px;
    }

    .email-body {
      padding: 40px 30px;
    }

    .greeting {
      font-size: 20px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 20px;
    }

    .message {
      color: #555;
      font-size: 15px;
      line-height: 1.8;
      margin-bottom: 30px;
    }

    .credentials-box {
      background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
      border-left: 4px solid #dc2d3d;
      border-radius: 8px;
      padding: 25px;
      margin: 30px 0;
    }

    .credentials-box h3 {
      color: #dc2d3d;
      margin: 0 0 20px 0;
      font-size: 18px;
      font-weight: 700;
    }

    .credential-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid rgba(220, 45, 61, 0.1);
    }

    .credential-item:last-child {
      border-bottom: none;
    }

    .credential-label {
      color: #666;
      font-size: 14px;
      font-weight: 500;
    }

    .credential-value {
      color: #1a1a1a;
      font-size: 15px;
      font-weight: 600;
      font-family: 'Courier New', monospace;
      background-color: #ffffff;
      padding: 8px 16px;
      border-radius: 6px;
      border: 1px solid #e0e0e0;
    }

    .warning-box {
      background-color: #fff7ed;
      border-left: 4px solid #f59e0b;
      border-radius: 8px;
      padding: 20px;
      margin: 25px 0;
    }

    .warning-box p {
      margin: 0;
      color: #92400e;
      font-size: 14px;
      line-height: 1.6;
    }

    .warning-box strong {
      color: #b45309;
      font-weight: 600;
    }

    .btn-container {
      text-align: center;
      margin: 35px 0;
    }

    .btn-primary {
      display: inline-block;
      background: linear-gradient(135deg, #dc2d3d 0%, #b82532 100%);
      color: #ffffff;
      text-decoration: none;
      padding: 16px 40px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 16px;
      box-shadow: 0 4px 6px rgba(220, 45, 61, 0.2);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      box-shadow: 0 6px 12px rgba(220, 45, 61, 0.3);
      transform: translateY(-2px);
    }

    .steps-list {
      background-color: #f9fafb;
      border-radius: 8px;
      padding: 25px;
      margin: 25px 0;
    }

    .steps-list h4 {
      color: #1a1a1a;
      margin: 0 0 20px 0;
      font-size: 16px;
      font-weight: 600;
    }

    .step-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 15px;
    }

    .step-item:last-child {
      margin-bottom: 0;
    }

    .step-number {
      flex-shrink: 0;
      width: 28px;
      height: 28px;
      background-color: #dc2d3d;
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 14px;
      margin-right: 12px;
    }

    .step-text {
      color: #555;
      font-size: 14px;
      line-height: 1.6;
      padding-top: 4px;
    }

    .support-section {
      background-color: #f9fafb;
      border-radius: 8px;
      padding: 25px;
      margin: 25px 0;
      text-align: center;
    }

    .support-section p {
      color: #666;
      font-size: 14px;
      margin: 0 0 15px 0;
    }

    .support-section a {
      color: #dc2d3d;
      text-decoration: none;
      font-weight: 600;
    }

    .email-footer {
      background-color: #1a1a1a;
      padding: 30px;
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

    .divider {
      height: 1px;
      background: linear-gradient(to right, transparent, #e0e0e0, transparent);
      margin: 30px 0;
    }

    @media only screen and (max-width: 600px) {
      .email-wrapper {
        margin: 0;
        border-radius: 0;
      }

      .email-header,
      .email-body,
      .email-footer {
        padding: 30px 20px;
      }

      .credential-item {
        flex-direction: column;
        align-items: flex-start;
      }

      .credential-value {
        margin-top: 8px;
        width: 100%;
        word-break: break-all;
      }
    }
  </style>
</head>

<body>
  <div class="email-wrapper">
    <!-- Header -->
    <div class="email-header">
      <h1>Welcome to Kingsford University</h1>
      <p>Magazine Contribution System</p>
    </div>

    <!-- Body -->
    <div class="email-body">
      <div class="greeting">Hello {{ $user->name }},</div>

      <div class="message">
        <p>Welcome to the Kingsford University Magazine Contribution System! Your account has been successfully created
          by the system administrator.</p>
        <p>This platform enables you to contribute to our annual university magazine and collaborate with fellow
          students and faculty members.</p>
      </div>

      <!-- Credentials Box -->
      <div class="credentials-box">
        <h3>🔐 Your Login Credentials</h3>
        <div class="credential-item">
          <span class="credential-label">Email Address:</span>
          <span class="credential-value">{{ $user->email }}</span>
        </div>
        <div class="credential-item">
          <span class="credential-label">Temporary Password:</span>
          <span class="credential-value">{{ $temporaryPassword }}</span>
        </div>
      </div>

      <!-- Warning Box -->
      <div class="warning-box">
        <p><strong>⚠️ Security Notice:</strong> This is a temporary password. You will be required to change it
          immediately upon your first login to ensure your account security.</p>
      </div>

      <!-- Login Button -->
      <div class="btn-container">
        <a href="{{ config('app.url') . '/login' }}" class="btn-primary">Login to Your Account</a>
      </div>

      <div class="divider"></div>

      <!-- Next Steps -->
      <div class="steps-list">
        <h4>📋 Next Steps</h4>
        <div class="step-item">
          <div class="step-number">1</div>
          <div class="step-text">Click the login button above or visit the platform website</div>
        </div>
        <div class="step-item">
          <div class="step-number">2</div>
          <div class="step-text">Enter your email address and temporary password</div>
        </div>
        <div class="step-item">
          <div class="step-number">3</div>
          <div class="step-text">Create a new secure password (must be different from the temporary password)</div>
        </div>
        <div class="step-item">
          <div class="step-number">4</div>
          <div class="step-text">Verify your email address to activate all features</div>
        </div>
        <div class="step-item">
          <div class="step-number">5</div>
          <div class="step-text">Complete your profile and start contributing!</div>
        </div>
      </div>

      <!-- Support Section -->
      <div class="support-section">
        <p>Need help getting started?</p>
        <p>Contact us at <a href="mailto:support@ksf.it.com">support@ksf.it.com</a></p>
      </div>
    </div>

    <!-- Footer -->
    <div class="email-footer">
      <p><strong>Kingsford University</strong></p>
      <p>Magazine Contribution System</p>
      <p style="margin-top: 15px;">
        <a href="{{ config('app.url') . '/terms' }}">Terms & Conditions</a> |
        <a href="{{ config('app.url') . '/about' }}">About Us</a>
      </p>
      <p style="margin-top: 15px; font-size: 12px;">
        © {{ date('Y') }} Kingsford University. All rights reserved.
      </p>
    </div>
  </div>
</body>

</html>