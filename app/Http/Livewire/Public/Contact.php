<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\ContactForm;
use App\Traits\ReCaptchaV3;
use App\Traits\SendGridTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Livewire\Component;
use SendGrid;
use Illuminate\Support\Facades\Cookie;

class Contact extends Component
{
    use ReCaptchaV3, SendGridTrait;

    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'contact';
    public $pageTitle = 'Contact Us';
    public $formData = [
        'first_name' => '',
        'last_name' => '',
        'company' => '',
        'email' => '',
        'phone' => '',
        'phoneCountry' => '',
        'country' => '',
        'message' => '',
        'reCaptcha' => '',
        'ip' => ''
    ];
    public $submit_message = '';
    private $sendgrid;

    public $contact = [];

    public function mount(Request $request)
    {
        LocaleHelper::detectLocale($request, $this->pageId);

        $this->heroData['h1'] = __('pages/contact.hero.h1');
        $this->heroData['h2'] = __('pages/contact.hero.h2');
        $this->heroData['p'] = __('pages/contact.hero.p');
        // $this->heroData['action'] = ['lable' => __('Contactenos'), 'route' => route('home', ['locale' => app()->getLocale()])];
        $this->pageTitle = __('Contactenos');
    }

    public function render()
    {
        return view('livewire.public.contact')
            ->layout('layouts.app', [
                'heroData' => $this->heroData,
                'pageId' => $this->pageId,
                'pageTitle' => $this->pageTitle
            ]);
    }

    /**
     * Send contact form data
     * @return \Livewire\Redirector | void
     */
    public function formDataProcess()
    {
        $this->submit_message = '';

        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                // Get reCaptcha response
                $reCaptchaResponse = $this->reCaptchaV3($this->formData['reCaptcha'], $this->formData['ip']);

                if ($reCaptchaResponse == false) {
                    $response['text'] = __('Google reCaptcha inválido.');
                    $validator->errors()->add('formData.reCaptcha', __('Google reCaptcha inválido.'));
                }
            });
        })->validate([
            'formData.first_name' => 'required|min:2',
            'formData.last_name' => 'required|min:2',
            'formData.company' => 'required|min:2',
            'formData.email' => 'required|email',
            'formData.phone' => 'required|min:10',
            'formData.phoneCountry' => 'required|min:2',
            'formData.country' => 'required|min:2|max:50',
            'formData.message' => 'required|min:5|max:100',
            'formData.reCaptcha' => 'required|min:1',
            'formData.ip' => 'required|ip',
        ],
        [],
        [
            'formData.first_name' => __('Nombre(s)'),
            'formData.last_name' => __('Apellido(s)'),
            'formData.company' => __('Company'),
            'formData.email' => __('Email'),
            'formData.phone' => __('Teléfono'),
            'formData.phoneCountry' => __('País'),
            'formData.country' => __('País'),
            'formData.message' => __('Mensaje'),
            'formData.reCaptcha' => __('ReCaptcha'),
            'formData.ip' => __('IP')
        ]);

        $contactData = array_merge($this->formData, ['lang' => Cookie::get('lang') ?: config('app.locale')]);
        $createContact = $this->createContact(env('SENDGRID_LIST_CONTACT', ''), $contactData);

        try {
            ContactForm::create([
                'page' => url()->current(),
                'service' => null,
                'ip_address' => $contactData['ip'],
                'first_name' => $contactData['first_name'],
                'last_name' => $contactData['last_name'],
                'company' => $contactData['company'],
                'phone' => $contactData['phoneCountry'] . $contactData['phone'],
                'email' => $contactData['email'],
                'message' => $contactData['message']
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        if (isset($createContact['status']) && $createContact['status'] == 202) {
            $template = view(
                'emails.generic',
                [
                    'lang' => app()->getLocale(),
                    'code_short' => 'SLCTD',
                    'code_long' => __('Contacto'),
                    'subject' => __('Hemos recibido tu mensaje'),
                    'welcome' => __('pages/contact.mail.welcome', ['name' => $contactData['first_name'] . ' ' . $contactData['last_name']]),
                    'message' => __('pages/contact.mail.message') . ' <p style="font-family: courier;background: #f0f0f0; border: 1px solid #cccccc; font-size: .75rem; font-style: italic; padding: 0.5rem; text-align: center;">' . $contactData['message']
                ]
            )->render();

            $sendEmail = $this->mailSend(
                __('Hemos recibido tu mensaje'),
                'text/html',
                $template,
                ['services'],
                $contactData
            );

            if (isset($sendEmail['status']) && $sendEmail['status'] == 202) {
                return redirect(request()->header('Referer'))->with('success', __('Gracias, en breve nos pondremos en contacto contigo'));
            }
        }

        $this->submit_message = __('Hubo un error al procesar la petición');
    }

    public function saveContact()
    {
        \Log::debug('saveContact', $this->contact);
    }
}
