<?php

namespace Haladigitally\Basitbot;

class BasitBot
{
    protected string $endpoint;
    protected string $appKey;
    protected string $authKey;

    public function __construct()
    {
        // Use Laravel config() helper to load settings
        $this->endpoint = config('basitbot.endpoint', 'https://basitbot.com/api/');
        $this->appKey = config('basitbot.app_key', '');
        $this->authKey = config('basitbot.auth_key', '');
    }

    protected function request(string $path, array $params): array
    {
        $curl = curl_init();

        $params['appkey'] = $this->appKey;
        $params['authkey'] = $this->authKey;

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->endpoint . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return ['error' => $error];
        }

        return json_decode($response, true);
    }

    public function sendText(string $to, string $message, bool $sandbox = false): array
    {
        return $this->request('create-message', [
            'to' => $to,
            'message' => $message,
            'sandbox' => $sandbox ? 'true' : 'false',
        ]);
    }

    public function sendFile(string $to, string $message, string $fileUrl, bool $sandbox = false): array
    {
        return $this->request('create-message', [
            'to' => $to,
            'message' => $message,
            'file' => $fileUrl,
            'sandbox' => $sandbox ? 'true' : 'false',
        ]);
    }

    public function sendTemplate(string $to, string $templateId, array $variables): array
    {
        return $this->request('create-message', [
            'to' => $to,
            'template_id' => $templateId,
            'variables' => $variables,
        ]);
    }

    public function sendOtp(string $to, string $message, int $expireIn = 300): array
    {
        return $this->request('send-otp', [
            'to' => $to,
            'message' => $message,
            'expire_in' => $expireIn,
        ]);
    }
}
