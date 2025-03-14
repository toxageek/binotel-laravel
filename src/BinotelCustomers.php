<?php

namespace Toxageek\BinotelLaravel;

class BinotelCustomers extends BinotelClient
{
    /**
     * Вибір усіх клієнтів.
     */
    public function list(): array
    {
        return $this->request('customers/list');
    }

    /**
     * Вибір клієнтів за ідентифікатором клієнта.
     */
    public function takeById(array $customerId): array
    {
        return $this->request('customers/take-by-id', [
            'customerID' => $customerId,
        ]);
    }

    /**
     * Вибір клієнтів за міткою.
     */
    public function takeByLabel(int|string $labelId): array
    {
        return $this->request('customers/take-by-label', [
            'labelID' => $labelId,
        ]);
    }

    /**
     * Пошук клієнтів за ім'ям або номером телефону.
     */
    public function search(string $subject): array
    {
        return $this->request('customers/search', [
            'subject' => $subject,
        ]);
    }

    /**
     * Створення клієнта.
     */
    public function create(
        string $name,
        array $numbers,
        ?string $description = null,
        ?string $email = null,
        string|int|null $assignedToEmployeeByInternalNumber = null,
        string|int|null $assignedToEmployeeById = null,
        ?array $labels = null,
    ): array {
        return $this->request('customers/create', $this->client(
            name: $name,
            numbers: $numbers,
            description: $description,
            email: $email,
            assignedToEmployeeByInternalNumber: $assignedToEmployeeByInternalNumber,
            assignedToEmployeeById: $assignedToEmployeeById,
            labels: $labels,
        ));
    }

    /**
     * Редагування клієнта.
     */
    public function update(
        string|int $id,
        ?string $name = null,
        ?array $numbers = null,
        ?string $description = null,
        ?string $email = null,
        string|int|null $assignedToEmployeeByInternalNumber = null,
        string|int|null $assignedToEmployeeById = null,
        ?array $labels = null,
    ): array {
        return $this->request('customers/update', [
            'id' => $id,
            ...$this->client(
                name: $name,
                numbers: $numbers,
                description: $description,
                email: $email,
                assignedToEmployeeByInternalNumber: $assignedToEmployeeByInternalNumber,
                assignedToEmployeeById: $assignedToEmployeeById,
                labels: $labels,
            ),
        ]);
    }

    /**
     * Видалення клієнта.
     */
    public function delete(array $customerId): array
    {
        return $this->request('customers/delete', [
            'customerID' => $customerId,
        ]);
    }

    /**
     * Вибір усіх позначок.
     */
    public function listOfLabels(): array
    {
        return $this->request('customers/listOfLabels');
    }

    /**
     * Формування масиву клієнта.
     */
    protected function client(
        ?string $name = null,
        ?array $numbers = null,
        ?string $description = null,
        ?string $email = null,
        string|int|null $assignedToEmployeeByInternalNumber = null,
        string|int|null $assignedToEmployeeById = null,
        ?array $labels = null,
    ): array {
        $client = [];

        if (! is_null($name)) {
            $client['name'] = $name;
        }

        if (! is_null($numbers)) {
            $client['numbers'] = array_unique($numbers);
        }

        if (! is_null($description)) {
            $client['description'] = $description;
        }

        if (! is_null($email)) {
            $client['email'] = $email;
        }

        if (! is_null($assignedToEmployeeByInternalNumber)) {
            $client['assignedToEmployee']['internalNumber'] = $assignedToEmployeeByInternalNumber;
        }

        if (! is_null($assignedToEmployeeById)) {
            $client['assignedToEmployee']['id'] = $assignedToEmployeeById;
        }

        if (! is_null($labels)) {
            $client['labels'] = $labels;
        }

        return $client;
    }
}
