@extends('email')

@section('email-body')
    <tr>
        <td class="email-body" width="570" cellpadding="0" cellspacing="0">
            <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">
                        <div class="f-fallback">
                            @php
                                $school = \App\Models\School::where('client_id', $invoice->client_id)->first();
                            @endphp
                            
                            @if($school && $school->logo_path)
                                <div style="text-align: center; margin-bottom: 20px;">
                                    <img src="{{ asset('storage/' . $school->logo_path) }}" alt="{{ $school->name }} Logo" style="max-width: 150px; height: auto;">
                                </div>
                            @endif
                            
                            <h1>Payment Receipt - {{ $invoice->client->name }}</h1>
                            
                            @if($school)
                                <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0;">
                                    <h3 style="margin-top: 0; color: #495057;">School Information</h3>
                                    <p style="margin: 5px 0;"><strong>School:</strong> {{ $school->name }}</p>
                                    <p style="margin: 5px 0;"><strong>Contact Person:</strong> {{ $school->contact_person }}</p>
                                    <p style="margin: 5px 0;"><strong>Total Students:</strong> {{ $school->student_count }}</p>
                                    <p style="margin: 5px 0;"><strong>Total Staff:</strong> {{ $school->staff_count }}</p>
                                    <p style="margin: 5px 0;"><strong>Yearly Fee:</strong> ${{ number_format($school->yearly_fee, 2) }}</p>
                                </div>
                            @endif
                            
                            <p>Thank you for your payment! We have received your payment for the invoice below.</p>
                            <p>Invoice #{{ $invoice->invoice_no }}.</p>
                            
                            <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9;"><strong>Invoice Number:</strong></td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $invoice->invoice_no }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9;"><strong>Payment Date:</strong></td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">{{ now()->format('F j, Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9;"><strong>Amount Paid:</strong></td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">${{ number_format($invoice->calculated_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9;"><strong>Payment Status:</strong></td>
                                    <td style="padding: 8px; border: 1px solid #ddd; color: green;"><strong>PAID</strong></td>
                                </tr>
                            </table>

                            <p>This serves as your official receipt for the payment. Please keep this for your records.</p>
                            
                            <p>If you have any questions about this payment or need any assistance, please don't hesitate to contact us.</p>
                            
                            <br />
                            <p>Best regards,
                                <br>{{ config('config.companyName') }}<br />
                                {{ config('config.companyPhoneNumber') }}
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
