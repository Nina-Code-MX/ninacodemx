<?php

namespace App\Http\Livewire\Public;

use App\Helpers\LocaleHelper;
use App\Models\Service;
use App\Traits\ReCaptchaV3;
use App\Traits\SendGridTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Livewire\Component;
use SendGrid\Mail\Mail as SendGridMail;
use SendGrid;
use Illuminate\Support\Facades\Cookie;

class Pricing extends Component
{
    use ReCaptchaV3, SendGridTrait;

    public $heroData = ['h1' => false, 'h2' => false, 'p' => false, 'action' => false];
    public $pageId = 'pricing';
    public $pageTitle = 'Precios';
    public $formData = [
        'first_name' => '',
        'last_name' => '',
        'company' => '',
        'email' => '',
        'phone' => '',
        'phoneCountry' => '',
        'country' => '',
        'service' => '',
        'reCaptcha' => '',
        'ip' => ''
    ];
    public $submit_message = '';
    private $sendgrid;

    /**
     * Mount
     * @param Request $request
     * @param null $lang
     * @return void
     */
    public function mount(Request $request, $lang = null)
    {
        LocaleHelper::detectLocale($request, $this->pageId);

        $this->heroData['h1'] = __('Precios');
        $this->heroData['h2'] = __('pages/pricing.h2');
        $this->heroData['p'] = __('pages/pricing.hero.p');

        $this->pageTitle = __('Precios');

        $this->sendgrid = new SendGrid(env('SENDGRID_API_KEY', ''));
    }

    /**
     * Render view
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $services = Service::orderBy('order')->get();

        return view('livewire.public.pricing', ['services' => $services])
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
            'formData.service' => 'required|exists:services,id',
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
            'formData.service' => __('mainmenu.services'),
            'formData.message' => __('Mensaje'),
            'formData.reCaptcha' => __('ReCaptcha'),
            'formData.ip' => __('IP')
        ]);

        $service = Service::find($this->formData['service']);

        $contactData = array_merge($this->formData, ['lang' => Cookie::get('lang') ?: config('app.locale'), 'service_name' => $service->name ?? 'Desconocido']);
        $createContact = $this->createContact($contactData);

        if (isset($createContact['status']) && $createContact['status'] == 202) {
            $sendEmail = $this->mailSend(
                __('pages/pricing.mail.subject', ['service' => $service->name ?? 'Desconocido']),
                'text/html',
                __('pages/pricing.mail.content', [
                    'full_name' => $this->formData['first_name'] . ' ' . $this->formData['last_name'],
                    'message' => $this->formData['message'],
                    'service' => $service->name ?? 'Desconocido'
                ]),
                ['services'],
                $contactData
            );

            if (isset($sendEmail['status']) && $sendEmail['status'] == 202) {
                return redirect(request()->header('Referer'))->with('success', __('Gracias, en breve nos pondremos en contacto contigo'));
            }
        }

        $this->submit_message = __('Hubo un error al procesar la petición');
    }
}
