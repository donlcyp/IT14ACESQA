<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordResetRequest;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password submission
     */
    public function submitForgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            // Find user by email
            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                return back()->with('error', 'No account found with this email address.');
            }

            // Create password reset request
            $resetRequest = PasswordResetRequest::create([
                'user_id' => $user->id,
                'email' => $validated['email'],
                'reason' => $validated['reason'],
                'status' => 'pending',
            ]);

            // Send email to admin
            $this->sendAdminNotification($user, $resetRequest);

            return back()->with('success', 'Your password reset request has been submitted. The administrator will contact you shortly at ' . $validated['email']);
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    /**
     * Show support ticket form
     */
    public function showSupportForm()
    {
        return view('auth.support-ticket');
    }

    /**
     * Submit support ticket
     */
    public function submitSupportTicket(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'gmail_account' => ['nullable', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'concern' => ['required', 'string', 'max:2000'],
            'category' => ['required', 'in:password_reset,account_issue,technical_issue,feature_request,other'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
        ]);

        try {
            // Find user if authenticated
            $userId = null;
            if ($request->user()) {
                $userId = $request->user()->id;
            }

            // Create support ticket
            $ticket = SupportTicket::create([
                'user_id' => $userId,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'gmail_account' => $validated['gmail_account'],
                'subject' => $validated['subject'],
                'concern' => $validated['concern'],
                'category' => $validated['category'],
                'priority' => $validated['priority'],
                'status' => 'open',
            ]);

            // Send confirmation email to user
            $this->sendTicketConfirmation($ticket);

            // Send notification to admin
            $this->sendAdminTicketNotification($ticket);

            return back()->with('success', 'Your support ticket has been submitted successfully. Ticket #' . str_pad($ticket->id, 6, '0', STR_PAD_LEFT));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    /**
     * Send notification email to admin about password reset request
     */
    private function sendAdminNotification(User $user, PasswordResetRequest $resetRequest)
    {
        $adminEmail = 'j.dutaro.545524@umindanao.edu.ph';
        
        $subject = 'Password Reset Request - ' . $user->name;
        $message = "
            <h2>Password Reset Request</h2>
            <p><strong>User:</strong> {$user->name}</p>
            <p><strong>Email:</strong> {$user->email}</p>
            <p><strong>Position:</strong> {$user->user_position}</p>
            <p><strong>Reason:</strong> " . ($resetRequest->reason ?? 'Not provided') . "</p>
            <p><strong>Request Time:</strong> {$resetRequest->created_at->format('M d, Y H:i A')}</p>
            <hr>
            <p>Please log in to the system to verify this user's identity and provide their password via email.</p>
            <p><a href='" . url('/admin/support/password-resets') . "' style='background-color: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>View Request in System</a></p>
        ";

        $this->sendEmail($adminEmail, $subject, $message);
    }

    /**
     * Send confirmation email to user about support ticket
     */
    private function sendTicketConfirmation(SupportTicket $ticket)
    {
        $ticketId = str_pad($ticket->id, 6, '0', STR_PAD_LEFT);
        
        $subject = 'Support Ticket Received - #' . $ticketId;
        $message = "
            <h2>Thank you for contacting us</h2>
            <p>We have received your support request with the following details:</p>
            <ul>
                <li><strong>Ticket ID:</strong> {$ticketId}</li>
                <li><strong>Subject:</strong> {$ticket->subject}</li>
                <li><strong>Category:</strong> " . ucwords(str_replace('_', ' ', $ticket->category)) . "</li>
                <li><strong>Priority:</strong> " . ucwords($ticket->priority) . "</li>
                <li><strong>Submitted:</strong> {$ticket->created_at->format('M d, Y H:i A')}</li>
            </ul>
            <p>Our team will review your request and respond to you shortly at <strong>{$ticket->email}</strong></p>
            " . ($ticket->gmail_account ? "<p>We will also contact you at your Gmail: <strong>{$ticket->gmail_account}</strong></p>" : '') . "
            <hr>
            <p>Best regards,<br/>AJJ CRISBER Engineering Services Support Team</p>
        ";

        $this->sendEmail($ticket->email, $subject, $message);
    }

    /**
     * Send notification email to admin about new support ticket
     */
    private function sendAdminTicketNotification(SupportTicket $ticket)
    {
        $adminEmail = 'j.dutaro.545524@umindanao.edu.ph';
        $ticketId = str_pad($ticket->id, 6, '0', STR_PAD_LEFT);
        
        $subject = 'New Support Ticket - #' . $ticketId . ' [' . ucwords(str_replace('_', ' ', $ticket->category)) . ']';
        $message = "
            <h2>New Support Ticket Submitted</h2>
            <p><strong>Ticket ID:</strong> {$ticketId}</p>
            <p><strong>Name:</strong> {$ticket->name}</p>
            <p><strong>Email:</strong> {$ticket->email}</p>
            " . ($ticket->gmail_account ? "<p><strong>Gmail:</strong> {$ticket->gmail_account}</p>" : '') . "
            <p><strong>Subject:</strong> {$ticket->subject}</p>
            <p><strong>Category:</strong> " . ucwords(str_replace('_', ' ', $ticket->category)) . "</p>
            <p><strong>Priority:</strong> <span style='color: " . $this->getPriorityColor($ticket->priority) . ";'>" . strtoupper($ticket->priority) . "</span></p>
            <hr>
            <h3>Concern:</h3>
            <p>" . nl2br($ticket->concern) . "</p>
            <hr>
            <p><a href='" . url('/admin/support-tickets/' . $ticket->id) . "' style='background-color: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>View Ticket</a></p>
        ";

        $this->sendEmail($adminEmail, $subject, $message);
    }

    /**
     * Helper method to send emails
     */
    private function sendEmail($to, $subject, $htmlContent)
    {
        try {
            Mail::html($htmlContent, function ($message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject)
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
    }

    /**
     * Get priority color for display
     */
    private function getPriorityColor($priority)
    {
        return match($priority) {
            'low' => '#60a5fa',
            'medium' => '#fbbf24',
            'high' => '#f87171',
            'urgent' => '#dc2626',
            default => '#64748b',
        };
    }
}
