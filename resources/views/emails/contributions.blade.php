<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>New Contribution Submitted</title>
</head>

<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: auto; padding: 24px;">
  <h2>New Contribution Submitted</h2>

  <p>Hello {{ $coordinator->name }},</p>

  <p>A new contribution has been submitted for your review.</p>

  <table style="width:100%; border-collapse: collapse; margin: 16px 0;">
    <tr>
      <td style="padding: 8px; font-weight: bold; width: 140px;">Title</td>
      <td style="padding: 8px;">{{ $contribution->title }}</td>
    </tr>
    <tr style="background:#f9f9f9;">
      <td style="padding: 8px; font-weight: bold;">Student</td>
      <td style="padding: 8px;">{{ $contribution->student->user->name }}</td>
    </tr>
    <tr>
      <td style="padding: 8px; font-weight: bold;">Post</td>
      <td style="padding: 8px;">{{ $contribution->post->title }}</td>
    </tr>
    <tr style="background:#f9f9f9;">
      <td style="padding: 8px; font-weight: bold;">Faculty</td>
      <td style="padding: 8px;">{{ $contribution->post->faculty->name }}</td>
    </tr>
    <tr>
      <td style="padding: 8px; font-weight: bold;">Submitted At</td>
      <td style="padding: 8px;">{{ $contribution->created_at->format('d M Y, H:i') }}</td>
    </tr>
  </table>

  <p>
    <a href="{{ route('contributions.show', $contribution) }}"
      style="display:inline-block; padding: 10px 20px; background:#4f46e5; color:#fff; text-decoration:none; border-radius:4px;">
      View Contribution
    </a>
  </p>

  <p style="color:#888; font-size:12px; margin-top:32px;">
    You are receiving this because you are the coordinator for {{ $contribution->post->faculty->name }}.
  </p>
</body>

</html>