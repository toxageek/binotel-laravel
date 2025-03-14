<?php

namespace Toxageek\BinotelLaravel;

class BinotelCalls extends BinotelClient
{
    /**
     * Створення двостороннього дзвінка. Внутрішню лінію із зовнішнім телефонним номером.
     */
    public function internalNumberToExternalNumber(
        string|int $internalNumber,
        string|int $externalNumber,
        string|int|null $pbxNumber = null,
        ?int $limitCallTime = null,
        int $callTimeToExt = 30,
        bool $playbackWaiting = true,
        ?string $callerIdForEmployee = null,
        bool $async = false,
    ): array {
        return $this->request('calls/internal-number-to-external-number', [
            'internalNumber' => $internalNumber,
            'externalNumber' => $externalNumber,
            'pbxNumber' => $pbxNumber,
            'limitCallTime' => $limitCallTime,
            'callTimeToExt' => $callTimeToExt,
            'playbackWaiting' => $playbackWaiting,
            'callerIdForEmployee' => $callerIdForEmployee,
            'async' => $async,
        ]);
    }

    /**
     * Створення двостороннього дзвінка. Зовнішній номер із зовнішнім телефонним номером.
     */
    public function externalNumberToExternalNumber(
        string|int $externalNumber1,
        string|int $externalNumber2,
        string|int $pbxNumber,
        ?int $limitCallTime = null,
        int $callTimeToExt = 30,
        bool $playbackWaiting = true,
    ): array {
        return $this->request('calls/external-number-to-external-number', [
            'externalNumber1' => $externalNumber1,
            'externalNumber2' => $externalNumber2,
            'pbxNumber' => $pbxNumber,
            'limitCallTime' => $limitCallTime,
            'callTimeToExt' => $callTimeToExt,
            'playbackWaiting' => $playbackWaiting,
        ]);
    }

    /**
     * Створення двостороннього дзвінка. Зовнішній номер із зовнішнім телефонним номером.
     */
    public function externalNumberToIncomingCall(
        string|int $externalNumber,
        string|int $pbxNumber,
        string|int|null $pbxNumberInExternalCall = null,
    ): array {
        return $this->request('calls/external-number-to-incoming-call', [
            'externalNumber' => $externalNumber,
            'pbxNumber' => $pbxNumber,
            'pbxNumberInExternalCall' => $pbxNumberInExternalCall,
        ]);
    }

    /**
     * Переадресація дзвінка за участю.
     */
    public function attendedCallTransfer(string|int $generalCallId, string|int $externalNumber): array
    {
        return $this->request('calls/attended-call-transfer', [
            'generalCallID' => $generalCallId,
            'externalNumber' => $externalNumber,
        ]);
    }

    /**
     * Примусове завершення дзвінка.
     */
    public function hangupCall(string|int $generalCallId): array
    {
        return $this->request('calls/hangup-call', [
            'generalCallID' => $generalCallId,
        ]);
    }

    /**
     * Дзвінок із відтворенням голосового файлу.
     */
    public function callWithAnnouncement(string|int $externalNumber, string|int $voiceFileId): array
    {
        return $this->request('calls/call-with-announcement', [
            'externalNumber' => $externalNumber,
            'voiceFileID' => $voiceFileId,
        ]);
    }

    /**
     * Дзвінок із голосовим меню.
     */
    public function callWithInteractiveVoiceResponse(
        string|int $externalNumber,
        string $ivrName,
        string|int|null $rewriteInternalNumber = null,
    ): array {
        return $this->request('calls/call-with-interactive-voice-response', [
            'externalNumber' => $externalNumber,
            'ivrName' => $ivrName,
            'rewriteInternalNumber' => $rewriteInternalNumber,
        ]);
    }
}
