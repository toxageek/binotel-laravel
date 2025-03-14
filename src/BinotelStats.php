<?php

namespace Toxageek\BinotelLaravel;

class BinotelStats extends BinotelClient
{
    /**
     * Вхідні дзвінки за певний період.
     */
    public function incomingCallsForPeriod(int $from, int $to): array
    {
        return $this->request('stats/incoming-calls-for-period',
            [
                'startTime' => $from,
                'stopTime' => $to,
            ]);
    }

    /**
     * Вихідні дзвінки за певний період.
     */
    public function outgoingCallsForPeriod(int $from, int $to): array
    {
        return $this->request('stats/outgoing-calls-for-period',
            [
                'startTime' => $from,
                'stopTime' => $to,
            ]);
    }

    /**
     * CallTracking дзвінки за певний період.
     */
    public function callTrackingCallsForPeriod(int $from, int $to): array
    {
        return $this->request('stats/calltracking-calls-for-period',
            [
                'startTime' => $from,
                'stopTime' => $to,
            ]);
    }

    /**
     * Вхідні дзвінки з певного часу.
     */
    public function allIncomingCallsSince(int $from): array
    {
        return $this->request('stats/all-incoming-calls-since',
            [
                'timestamp' => $from,
            ]);
    }

    /**
     * Вихідні дзвінки з певного часу.
     */
    public function allOutgoingCallsSince(int $from): array
    {
        return $this->request('stats/all-outgoing-calls-since',
            [
                'timestamp' => $from,
            ]);
    }

    /**
     * Вхідні та вихідні дзвінки за внутрішнім номером співробітника за певний період.
     * Обмеження: період не може перевищувати 7 днів.
     */
    public function listOfCallsByInternalNumberForPeriod(string|int $internalNumber, int $from, int $to): array
    {
        return $this->request('stats/list-of-calls-by-internal-number-for-period',
            [
                'internalNumber' => $internalNumber,
                'startTime' => $from,
                'stopTime' => $to,
            ]);
    }

    /**
     * Вхідні та вихідні дзвінки протягом дня.
     */
    public function listOfCallsPerDay(?int $dayInTimestamp = null): array
    {
        return $this->request('stats/list-of-calls-per-day',
            [
                'dayInTimestamp' => $dayInTimestamp,
            ]);
    }

    /**
     * Вхідні та вихідні дзвінки за певний період.
     * Обмеження: не більше 24 годин.
     */
    public function listOfCallsForPeriod(int $from, int $to): array
    {
        return $this->request('stats/list-of-calls-for-period',
            [
                'startTime' => $from,
                'stopTime' => $to,
            ]);
    }

    /**
     * Втрачені дзвінки за сьогодні.
     */
    public function listOfLostCallsForToday(): array
    {
        return $this->request('stats/list-of-lost-calls-for-today');
    }

    /**
     * Дзвінки які онлайн.
     */
    public function onlineCalls(): array
    {
        return $this->request('stats/online-calls');
    }

    /**
     * Вхідні та вихідні дзвінки за номером телефону.
     */
    public function historyByExternalNumber(string|array $externalNumbers): array
    {
        return $this->request('stats/history-by-external-number',
            [
                'externalNumbers' => $externalNumbers,
            ]);
    }

    /**
     * Вхідні та вихідні дзвінки за ідентифікатором клієнта.
     */
    public function historyByCustomerId(string|array $customerId): array
    {
        return $this->request('stats/history-by-customer-id',
            [
                'customerID' => $customerId,
            ]);
    }

    /**
     * Вхідні та вихідні дзвінки Недавні дзвінки за внутрішнім номером співробітник.
     * Обмеження: дзвінки за останні 2 тижні, не більше 50 дзвінків.
     */
    public function recentCallsByInternalNumber(string|int $internalNumber): array
    {
        return $this->request('stats/recent-calls-by-internal-number',
            [
                'internalNumber' => $internalNumber,
            ]);
    }

    /**
     * Дані про дзвінок за ідентифікатором дзвінка.
     */
    public function callDetails(array $generalCallId): array
    {
        return $this->request('stats/call-details',
            [
                'generalCallID' => $generalCallId,
            ]);
    }

    /**
     * Посилання на запис розмови.
     */
    public function callRecord(string|int $generalCallId): array
    {
        return $this->request('stats/call-record',
            [
                'generalCallID' => $generalCallId,
            ]);
    }
}
