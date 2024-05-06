<?php
\Carbon\Carbon::setLocale('en');

return [
    'meta' => [
        'description' => 'Budgets tailored to your business. At Nina Code we specialize in providing solutions tailored to each business, whether you need a website, a mobile application, or an enterprise management system, we help you achieve it. Contact us today.',
        'og:title' => 'Nina Code | Pricing',
        'og:description' => 'Budgets tailored to your business. At Nina Code we specialize in providing solutions tailored to each business, whether you need a website, a mobile application, or an enterprise management system, we help you achieve it. Contact us today.',
        'og:image' => 'https://nina-code.com/images/og-image.jpg',
        'og:url' => 'https://nina-code.com',
        'og:type' => 'website',
        'og:locale' => 'en_US',
        'og:site_name' => 'Nina Code',
        'og:image:width' => '1200',
        'og:image:height' => '630',
        'twitter:card' => 'summary_large_image',
        'twitter:site' => '@nina_code',
        'twitter:creator' => '@nina_code',
        'twitter:title' => 'Nina Code | Pricing',
        'twitter:description' => 'Budgets tailored to your business. At Nina Code we specialize in providing solutions tailored to each business, whether you need a website, a mobile application, or an enterprise management system, we help you achieve it. Contact us today.',
        'twitter:image' => 'https://nina-code.com/images/og-image.jpg'
    ],
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
