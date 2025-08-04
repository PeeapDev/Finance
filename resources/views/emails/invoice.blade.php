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
                            
                            <h1>Hi {{ $invoice->client->name }}.</h1>
                            
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
                            
                            <p>I hope this email finds you well. Thank you for doing business with us. We have prepared the
                                invoice for you, which you can find and download by clicking the link provided below. Feel
                                free to review it at your convenience. If you have any questions or require any further
                                information, please don't hesitate to let us know. We're here to assist you.</p>
                            <p><a href="{{ route('email.invoice.pdf', $invoice->slug) }}">Invoice</a></p>
                            <br />

                            <p>Thanks,
                                <br>{{ config('config.companyName') }},<br />
                                {{ config('config.companyPhoneNumber') }}
                            </p>
                            <!-- Sub copy -->
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
