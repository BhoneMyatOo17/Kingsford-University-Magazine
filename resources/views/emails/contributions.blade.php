<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Contribution Submitted</title>
</head>

<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:'Segoe UI',Arial,sans-serif; color:#1f2937;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding:32px 16px;">
    <tr>
      <td align="center">
        <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;">

          {{-- Header --}}
          <tr>
            <td style="background-color:#dc2d3d; border-radius:12px 12px 0 0; padding:32px 40px; text-align:center;">
              <p style="margin:0 0 8px 0; font-size:22px; font-weight:700; color:#ffffff; letter-spacing:-0.3px;">
                Kingsford University
              </p>
              <p
                style="margin:0; font-size:13px; color:rgba(255,255,255,0.75); letter-spacing:0.5px; text-transform:uppercase;">
                Magazine System
              </p>
            </td>
          </tr>

          {{-- Body --}}
          <tr>
            <td style="background-color:#ffffff; padding:36px 40px;">

              {{-- Title badge --}}
              <div
                style="display:inline-block; background-color:#fef2f2; color:#dc2d3d; font-size:11px; font-weight:700; letter-spacing:0.8px; text-transform:uppercase; padding:4px 12px; border-radius:20px; margin-bottom:20px;">
                New Submission
              </div>

              <h2 style="margin:0 0 8px 0; font-size:22px; font-weight:700; color:#111827;">
                New Contribution Submitted
              </h2>
              <p style="margin:0 0 24px 0; font-size:15px; color:#6b7280; line-height:1.6;">
                Hello <strong style="color:#111827;">{{ $coordinator->name }}</strong>, a new contribution has been
                submitted to your faculty and is awaiting your review.
              </p>

              {{-- Details card --}}
              <table width="100%" cellpadding="0" cellspacing="0"
                style="background-color:#f9fafb; border-radius:10px; border:1px solid #e5e7eb; overflow:hidden; margin-bottom:28px;">
                <tr>
                  <td style="padding:0;">
                    <table width="100%" cellpadding="0" cellspacing="0">

                      <tr>
                        <td style="padding:14px 20px; border-bottom:1px solid #e5e7eb;">
                          <p
                            style="margin:0 0 2px 0; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.6px;">
                            Title</p>
                          <p style="margin:0; font-size:14px; font-weight:600; color:#111827;">
                            {{ $contribution->title }}</p>
                        </td>
                      </tr>

                      <tr style="background-color:#ffffff;">
                        <td style="padding:14px 20px; border-bottom:1px solid #e5e7eb;">
                          <p
                            style="margin:0 0 2px 0; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.6px;">
                            Student</p>
                          <p style="margin:0; font-size:14px; font-weight:600; color:#111827;">
                            {{ $contribution->student->user->name }}</p>
                        </td>
                      </tr>

                      <tr>
                        <td style="padding:14px 20px; border-bottom:1px solid #e5e7eb;">
                          <p
                            style="margin:0 0 2px 0; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.6px;">
                            Post</p>
                          <p style="margin:0; font-size:14px; font-weight:600; color:#111827;">
                            {{ $contribution->post->title }}</p>
                        </td>
                      </tr>

                      <tr style="background-color:#ffffff;">
                        <td style="padding:14px 20px; border-bottom:1px solid #e5e7eb;">
                          <p
                            style="margin:0 0 2px 0; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.6px;">
                            Faculty</p>
                          <p style="margin:0; font-size:14px; font-weight:600; color:#111827;">
                            {{ $contribution->post->faculty->name }}</p>
                        </td>
                      </tr>

                      <tr>
                        <td style="padding:14px 20px;">
                          <p
                            style="margin:0 0 2px 0; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.6px;">
                            Submitted At</p>
                          <p style="margin:0; font-size:14px; font-weight:600; color:#111827;">
                            {{ $contribution->created_at->format('d M Y, H:i') }}</p>
                        </td>
                      </tr>

                    </table>
                  </td>
                </tr>
              </table>

              {{-- CTA Button --}}
              <table cellpadding="0" cellspacing="0">
                <tr>
                  <td style="border-radius:8px; background-color:#dc2d3d;">
                    <a href="{{ route('contributions.show', $contribution) }}"
                      style="display:inline-block; padding:12px 28px; font-size:14px; font-weight:700; color:#ffffff; text-decoration:none; border-radius:8px; letter-spacing:0.2px;">
                      View Contribution →
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td
              style="background-color:#f9fafb; border-top:1px solid #e5e7eb; border-radius:0 0 12px 12px; padding:20px 40px; text-align:center;">
              <p style="margin:0 0 4px 0; font-size:12px; color:#9ca3af;">
                You are receiving this because you are the coordinator for
                <strong style="color:#6b7280;">{{ $contribution->post->faculty->name }}</strong>.
              </p>
              <p style="margin:0; font-size:11px; color:#d1d5db;">
                © {{ date('Y') }} Kingsford University Magazine System
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>

</html>