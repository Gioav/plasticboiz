#!/usr/bin/perl
use MIME::Lite;
 
$to = 'scrizzothomas@gmail.com';
$cc = '';
$from = 'plasticboiz@proton.me';
$subject = 'Test Email';
$message = 'This is test email sent by Perl Script';

$msg = MIME::Lite->new(
                 From     => $from,
                 To       => $to,
                 Cc       => $cc,
                 Subject  => $subject,
                 Data     => $message
                 );
                 
$msg->send or die;
print "Email Sent Successfully\n";
