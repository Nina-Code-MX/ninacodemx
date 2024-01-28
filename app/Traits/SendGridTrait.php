<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Log;
use SendGrid;
use SendGrid\Mail\Mail as SendGridMail;
use SendGrid\Mail\Personalization as SendGridPersonalization;
use SendGrid\Mail\To as SendGridTo;

trait SendGridTrait {
    private $sendGrid;
    private $sendGridMail;
    private $sendGridPersonalization;
    private $sendGridListPricing;

    /**
     * SendGrid init
     * @return void
     */
    private function sendGridInit(string $list_id = null)
    {
        $this->sendGrid = new SendGrid(env('SENDGRID_API_KEY', ''));
        $this->sendGridListPricing = $list_id ?? env('SENDGRID_LIST_PRICING', '');
    }

    /**
     * Create contact
     * @param array $contactData
     * @return array
     */
    public function createContact(string $list_id = null, array $contactData = []): array
    {
        $this->sendGridInit($list_id ?? env('SENDGRID_LIST_CONTACT', ''));

        $contactObj = [
            'list_ids' => [$this->sendGridListPricing],
            'contacts' => [
                [
                    'address_line_1' => Str::substr($contactData['address_line_1'] ?? '', 0, 100),
                    'address_line_2' => Str::substr($contactData['address_line_2'] ?? '', 0, 100),
                    'alternate_emails' => $contactData['alternate_emails'] ?? [],
                    'city' => Str::substr($contactData['city'] ?? '', 0, 60),
                    'country' => Str::substr($contactData['country'] ?? '', 0, 50),
                    'email' => Str::substr($contactData['email'] ?? '', 0, 254),
                    'first_name' => Str::substr($contactData['first_name'] ?? '', 0, 50),
                    'last_name' => Str::substr($contactData['last_name'] ?? '', 0, 50),
                    'postal_code' => Str::substr($contactData['postal_code'] ?? '', 0, 10),
                    'state_province_region' => Str::substr($contactData['state_province_region'] ?? '', 0, 50),
                    'custom_fields' => [
                        'phone' => Str::substr(($contactData['phoneCountry'] ?? '') . ($contactData['phone'] ?? ''), 0, 20),
                        'company' => Str::substr($contactData['company'] ?? '', 0, 50),
                        'service_id' => Str::substr($contactData['service'] ?? '', 0, 50),
                        'service_name' => Str::substr($contactData['service_name'] ?? '', 0, 50),
                        'ip' => Str::substr($contactData['ip'] ?? '', 0, 15),
                        'lang' => Str::substr($contactData['lang'] ?? 'es', 0, 10),
                        'message' => Str::substr($contactData['message'] ?? '', 0, 100)
                    ]
                ]
            ]
        ];

        try {
            $response = $this->sendGrid->client->marketing()->contacts()->put($contactObj);
            return ['body' => $response->body(), 'message' => __('Contacto creado en SendGrid.'), 'status' => $response->statusCode()];
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getMessage()]);
            return ['body' => $e->getMessage(), 'message' => __('Hubo un error al procesar la solicitud.'), 'status' => 0];
        }
    }

    /**
     * Mail send
     * @param string $subject
     * @param string $content_type
     * @param string $content
     * @param array $categories
     * @param array $contactData
     * @return array
     */
    public function mailSend(string $subject, string $content_type, string $content, array $categories = [], array $contactData = []): array
    {
        $categories = array_merge(['contact'], $categories);

        $mailObject = [
            'personalizations' => [
                [
                    'from' => [
                        'email' => env('MAIL_FROM_ADDRESS', ''),
                        'name' => env('MAIL_FROM_NAME', '')
                    ],
                    'to' => [
                        [
                            'email' => $contactData['email'],
                            'name' => $contactData['first_name'] . ' ' . $contactData['last_name']
                        ]
                    ],
                    'bcc' => [
                        [
                            'email' => env('MAIL_FROM_ADDRESS', ''),
                            'name' => env('MAIL_FROM_NAME', '')
                        ]
                    ],
                ]
            ],
            'from' => [
                'email' => env('MAIL_FROM_ADDRESS', ''),
                'name' => env('MAIL_FROM_NAME', '')
            ],
            'reply_to' => [
                'email' => env('MAIL_FROM_ADDRESS', ''),
                'name' => env('MAIL_FROM_NAME', '')
            ],
            'subject' => $subject,
            'content' => [
                [
                    'type' => $content_type,
                    'value' => $content
                ]
            ],
            'categories' => array_unique($categories),
            'tracking_settings' => [
                'click_tracking' => [
                    'enable' => true,
                    'enable_text' => true
                ],
                'open_tracking' => [
                    'enable' => true
                ]
            ]
        ];

        try {
            $response = $this->sendGrid->client->mail()->send()->post($mailObject);
            return ['body' => $response->body(), 'message' => __('Mensaje envíado.'), 'status' => $response->statusCode()];
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getMessage()]);
            return ['body' => $e->getMessage(), 'message' => __('Hubo un error al procesar la solicitud.'), 'status' => 0];
        }
    }
}