<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordResetRequest;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminSupportController extends Controller
{
    /**
     * Show password reset requests dashboard
     */
    public function passwordResets(Request $request)
    {
        $status = $request->get('status', 'pending');
        
        $requests = PasswordResetRequest::with('user')
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.password-resets', [
            'requests' => $requests,
            'status' => $status,
        ]);
    }

    /**
     * Show password reset request details
     */
    public function showPasswordReset($id)
    {
        $request = PasswordResetRequest::findOrFail($id);

        return view('admin.password-reset-detail', [
            'request' => $request->load('user'),
        ]);
    }

    /**
     * Resolve password reset request
     */
    public function resolvePasswordReset(Request $request, $id)
    {
        $passwordResetRequest = PasswordResetRequest::findOrFail($id);

        $validated = $request->validate([
            'new_password' => ['required', 'string', 'min:8'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            $user = $passwordResetRequest->user;

            // Update user password
            $user->update([
                'password' => bcrypt($validated['new_password']),
            ]);

            // Update password reset request
            $passwordResetRequest->update([
                'status' => 'resolved',
                'admin_notes' => $validated['admin_notes'],
                'resolved_at' => now(),
            ]);

            // Send email to user with new password
            $this->sendPasswordResetEmail($user, $validated['new_password'], $passwordResetRequest->email);

            return back()->with('success', 'Password has been reset and sent to user.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Reject password reset request
     */
    public function rejectPasswordReset(Request $request, $id)
    {
        $passwordResetRequest = PasswordResetRequest::findOrFail($id);

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        try {
            $passwordResetRequest->update([
                'status' => 'rejected',
                'admin_notes' => $validated['rejection_reason'],
                'resolved_at' => now(),
            ]);

            // Send rejection email to user
            $this->sendRejectionEmail($passwordResetRequest);

            return back()->with('success', 'Password reset request has been rejected.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Show support tickets dashboard
     */
    public function supportTickets(Request $request)
    {
        $status = $request->get('status', 'open');
        $category = $request->get('category');
        
        $tickets = SupportTicket::with('user')
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.support-tickets', [
            'tickets' => $tickets,
            'status' => $status,
            'category' => $category,
        ]);
    }

    /**
     * Show support ticket details
     */
    public function showSupportTicket($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        return view('admin.support-ticket-detail', [
            'ticket' => $ticket->load('user'),
        ]);
    }

    /**
     * Respond to support ticket
     */
    public function respondToTicket(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $validated = $request->validate([
            'response' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'in:in_progress,resolved,closed'],
        ]);

        try {
            $ticket->update([
                'admin_response' => $validated['response'],
                'status' => $validated['status'],
                'responded_at' => now(),
            ]);

            // Send response email to user
            $this->sendTicketResponseEmail($ticket);

            return back()->with('success', 'Response has been sent to user.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Send password reset email to user
     */
    private function sendPasswordResetEmail(User $user, string $newPassword, string $email)
    {
        $subject = 'Your Password Has Been Reset';
        $message = "
            <h2>Password Reset Successful</h2>
            <p>Hello {$user->name},</p>
            <p>Your password has been successfully reset by our administrator.</p>
            <p style='background: #f0f9ff; padding: 12px; border-left: 4px solid #1e40af; border-radius: 4px;'>
                <strong>Your new password:</strong><br/>
                <code style='font-family: monospace; font-size: 16px;'>{$newPassword}</code>
            </p>
            <p style='color: #991b1b; background: #fef2f2; padding: 12px; border-radius: 4px;'>
                <strong>⚠️ Important:</strong> Please change this password immediately after logging in. Do not share this password with anyone.
            </p>
            <hr>
            <p>
                <a href='" . url('/login') . "' style='background-color: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Sign In Now</a>
            </p>
            <hr>
            <p>If you did not request a password reset, please contact us immediately.</p>
            <p style='color: #64748b; font-size: 12px;'>Best regards,<br/>AJJ CRISBER Engineering Services</p>
        ";

        $this->sendEmail($email, $subject, $message);
    }

    /**
     * Send rejection email to user
     */
    private function sendRejectionEmail(PasswordResetRequest $passwordResetRequest)
    {
        $subject = 'Password Reset Request - Unable to Process';
        $message = "
            <h2>Password Reset Request Status</h2>
            <p>Hello,</p>
            <p>Your password reset request could not be processed for the following reason:</p>
            <p style='background: #fef2f2; padding: 12px; border-left: 4px solid #dc2626; border-radius: 4px; color: #991b1b;'>
                <strong>" . ($passwordResetRequest->admin_notes ?? 'Unable to verify identity') . "</strong>
            </p>
            <p>Please try again or contact our support team if you have questions.</p>
            <hr>
            <p>
                <a href='" . url('/support') . "' style='background-color: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Contact Support</a>
            </p>
            <p style='color: #64748b; font-size: 12px;'>Best regards,<br/>AJJ CRISBER Engineering Services</p>
        ";

        $this->sendEmail($passwordResetRequest->email, $subject, $message);
    }

    /**
     * Send ticket response email to user
     */
    private function sendTicketResponseEmail(SupportTicket $ticket)
    {
        $ticketId = str_pad($ticket->id, 6, '0', STR_PAD_LEFT);
        
        $subject = 'Support Response - Ticket #' . $ticketId;
        $message = "
            <h2>We've Responded to Your Support Ticket</h2>
            <p>Hello {$ticket->name},</p>
            <p>Thank you for contacting us. We have reviewed your support request and provided a response below.</p>
            <hr>
            <h3>Your Ticket</h3>
            <p><strong>Ticket ID:</strong> {$ticketId}</p>
            <p><strong>Subject:</strong> {$ticket->subject}</p>
            <p><strong>Status:</strong> " . ucwords(str_replace('_', ' ', $ticket->status)) . "</p>
            <hr>
            <h3>Our Response</h3>
            <p>" . nl2br($ticket->admin_response) . "</p>
            <hr>
            <p>If you have any further questions, please reply to this email or visit our support page.</p>
            <p style='color: #64748b; font-size: 12px;'>Best regards,<br/>AJJ CRISBER Engineering Services Support Team</p>
        ";

        $this->sendEmail($ticket->email, $subject, $message);
        
        // Also send to gmail if provided
        if ($ticket->gmail_account) {
            $this->sendEmail($ticket->gmail_account, $subject, $message);
        }
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
}
