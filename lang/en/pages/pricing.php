<?php
\Carbon\Carbon::setLocale('en');

return [
    'hero' => [
        'p' => 'Budgets tailored to your business.'
    ],
    'h2' => 'Request a quote',
    'p' => [
        'At Nina Code we specialize in providing solutions tailored to each business, whether you need a website, a mobile application, or an enterprise management system, we help you achieve it.',
        'If you are interested in any of our services, or have any questions, do not hesitate to contact us.'
    ],
    'form' => [
        'info' => 'By submitting this form you agree to our <a class="text-secondary" href=":privacy" target="_blank">Privacy Policy</a> and <a class="text-secondary" href=":terms" target="_blank">Terms of Service</a>. Once we receive your request, we will contact you as soon as possible.',
        'submit' => 'Send',
        'title' => 'A project a button away',
    ],
    'mail' => [
        'welcome' => 'Hello :full_name,',
        'subject' => 'New quote request: :service',
        'message' => '<p>Thank you for your interest in "<b>:service</b>", we got your request an soon we are going to be in touch with you.</p>'
    ]
];
