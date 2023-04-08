<?php

namespace App\Http\Controllers\Api\V1\MailChimp;

use App\Http\Controllers\Controller;
use App\Traits\GuzzleHttp;
use App\Traits\ReCaptchaV3;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;

class NewsletterController extends Controller
{
    use GuzzleHttp, ReCaptchaV3;

    /**
     * Index
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $response = ['icon' => 'error', 'status' => 400, 'text' => 'Hubo un error al procesar la petición.', 'title' => '¡Error!'];

        $reCaptcha = $request->get('reCaptcha') ?? null;
        $email = $request->get('email') ?? null;
        $userIp = $request->get('userIp') ?? null;

        if (!$email) {
            $response['text'] = 'El campo del correo electrónico es obligatorio.';

            return response()->json($response, $response['status']);
        }

        if (!$reCaptcha) {
            $response['text'] = 'reCaptcha inválido.';

            return response()->json($response, $response['status']);
        }

        $reCaptchaResponse = $this->reCaptchaV3($reCaptcha, $userIp);

        if ($reCaptchaResponse == false) {
            $response['text'] = 'reCaptcha inválido.';

            return response()->json($response, $response['status']);
        }

        try {
            $Mailchimp = new ApiClient();
            $Mailchimp->setConfig([
                'apiKey' => env('MAILCHIMP_API_KEY', ''),
                'server' => env('MAILCHIMP_SERVER_PREFIX', '')
            ]);

            $member = $Mailchimp->lists->addListMember(env('MAILCHIMP_LIST_ID', ''), [
                'email_address' => $email,
                'status' => 'subscribed',
                'tags' => ['newsletter']
            ]);

            if (isset($member->status) && $member->status != 'subscribed') {
                $response['icon'] = 'success';
                $response['status'] = 200;
                $response['text'] = 'Se ha registrado a la lista de distribución.';
                $response['title'] = '¡Éxito!';
            } else {
                $response['text'] = 'No se pudo registrar a la lista de distribución.';
            }
        } catch (ApiException $e) {
            \Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getResponseBody()]);
        } catch (ClientException $e) {
            $context = json_decode($e->getResponse()->getBody()->getContents() ?? ['title' => $response['title'], 'detail' => $response['text']], true);

            $response['title'] = $context['title'] ?? $response['title'];
            $response['text'] = $context['detail'] ?? $response['text'];

            if ($response['title'] == 'Member Exists') {
                $response['icon']  = 'warning';
                $response['text']  = 'El correo electrónico ya se encuentra registrado en la lista de distribución.';
                $response['title'] = 'Usuario ya registrado';
            }

            if ($response['title'] == 'Invalid Resource') {
                $response['icon']  = 'warning';
                $response['text']  = 'El correo electrónico <' . $email . '> es inválido.';
                $response['title'] = 'Correo electrónico inválido';
            }

            \Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $context]);
        } catch (\Exception $e) {
            \Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $e->getMessage()]);
        }

        return response()->json($response, $response['status']);
    }
}
