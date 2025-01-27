<?php

namespace Pressware\AwesomeSupport\API\Provider\Freshdesk;

use Pressware\AwesomeSupport\API\Abstracts\DataMapper as AbstractDataMapper;

class DataMapper extends AbstractDataMapper
{
    const NO_TICKETS_RESPONSE = -1;

    /**
     * @var array
     */
    protected $attachments = [];

    /**
     * Maps the incoming JSON to the individual repositories.
     *
     * @since 0.1.0
     *
     * @param string|array $json
     * @param string $key (Optional)
     *
     * @return void
     */
    public function mapJSON($json, $key = '', $ticketId = null)
    {
        $packets = $this->fromJSON($json);
        $tickets = $this->fromJSON($json);
        if (!$tickets) {
            return self::NO_TICKETS_RESPONSE;
        }

        foreach ((array)$tickets as $ticket) {
            if (!$this->withinDateRange($ticket->updated_at, true)) {
                continue;
            }

            $ticketId = (int)$ticket->id;

            // Store the ticket
            $this->ticketRepository->create($ticketId, [
                'agentID'    => (int)$ticket->responder_id,
                'customerID' => (int)$ticket->requester_id,
                'subject'    => $ticket->subject,
                'createdAt'  => $ticket->created_at,
            ]);

            // Store the customer.
            if ($ticket->requester_id) {
                $this->storeUser(
                    $ticket->requester->id,
                    $ticket->requester->name,
                    $ticket->requester->email,
                    'customer'
                );
            }
        }
    }

    /**
     * Map the attachment and convert into an array data structure.
     *
     * @since 0.1.0
     *
     * @param \stdClass|mixed $attachment
     *
     * @return array
     * [
     *      'url' => 'holds a valid URL',
     *      'filename' => 'holds the filename, e.g. image.jpg',
     * ]
     */
    public function mapAttachment($attachment)
    {
        return [
            'url'      => $attachment->file_url,
            'filename' => $attachment->file_name,
        ];
    }

    /**
     * Maps the users into the User Repository.
     *
     * @since 0.1.0
     *
     * @param array $users
     *
     * @return void
     */
    protected function mapUsers(array $users)
    {
        foreach ($users as $user) {
            $this->userRepository->createModel($user);
        }
    }

    /**
     * Map the response into the Ticket Repository.
     *
     * @since 0.1.0
     *
     * @param array $tickets
     *
     * @return void
     */
    protected function mapTickets(array $tickets)
    {
        foreach ($tickets as $ticket) {
            $updatedAt = $this->toFormattedDate($ticket->updated_at);
            // Skip this one if it's after the end date selection.
            if (!$this->withinDateRange($updatedAt, false)) {
                continue;
            }

            $this->ticketRepository->create(
                (int)$ticket->id,
                [
                    'agentID'     => $ticket->assignee_id,
                    'customerID'  => $ticket->requester_id,
                    'subject'     => $ticket->subject,
                    'description' => $ticket->description,
                    'createdAt'   => $this->toFormattedDate($ticket->created_at),
                    'updatedAt'   => $this->toFormattedDate($updatedAt),
                ]
            );
        }
    }
}
