<?php

namespace Toxageek\BinotelLaravel;

class BinotelSettings extends BinotelClient
{
    /**
     * Вибір усіх працівників.
     */
    public function listOfEmployees(): array
    {
        return $this->request('settings/list-of-employees');
    }

    /**
     * Вибір всіх сценаріїв обробки вхідних дзвінків.
     */
    public function listOfRoutes(): array
    {
        return $this->request('settings/list-of-routes');
    }

    /**
     * Вибір усіх голосових повідомлень.
     */
    public function listOfVoiceFiles(): array
    {
        return $this->request('settings/list-of-voice-files');
    }
}
