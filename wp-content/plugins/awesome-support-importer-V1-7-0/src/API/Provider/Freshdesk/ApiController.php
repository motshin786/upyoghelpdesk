<?php

namespace Pressware\AwesomeSupport\API\Provider\Freshdesk;

use Pressware\AwesomeSupport\API\Abstracts\ProviderController;

class ApiController extends ProviderController
{
    const NO_TICKETS_RESPONSE = -1;

    /**
     * @var string
     */
    protected $subdomain;

    /*******************************************
     * Helpers
     ******************************************/

    /**
     * Request the Tickets from Ticksy.
     *
     * @since 0.1.0
     *
     * @return void
     */
    protected function request()
    {
        $pageNumber = 0;
        do {
            $endpoint = $this->getEndpoint($pageNumber);
            // $packet   = $this->fromJSON($this->get($endpoint));
            $packet   = $this->get($endpoint);

            $response = $this->dataMapper->mapJSON($packet);
            $pageNumber++;
        } while ($response != self::NO_TICKETS_RESPONSE);
    }

    /**
     * Request and map the conversation for the specific Conversation ID from Help Scout.
     *
     * @since 0.1.0
     *
     * @param int|string $conversationId
     *
     * @return void
     * @link https://developer.freshdesk.com/api/#list_all_ticket_notes
     */
    protected function requestConversation($conversationId)
    {
        $endpoint = sprintf(
            'https://%s.freshdesk.com/api/v2/tickets/%s/conversations',
            $this->subdomain,
            $conversationId
        );
        $packet   = $this->get($endpoint);
        $this->dataMapper->mapJSON($packet);
    }

    /**
     * Request Tickets from Freshdesk.
     *
     * @param string $status (optional) 'closed' or 'open'
     * @param string $pageNumber
     *
     * @return \stdClass
     * @link https://developer.freshdesk.com/api/#list_all_tickets
     */
    protected function getEndpoint($pageNumber = null)
    {
        $endpoint = sprintf(
            'https://%s.freshdesk.com/api/v2/tickets?include=description,requester,stats',
            $this->subdomain
        );

        // Additional pages are requested by adding another parameter, e.g.
        // Page 2 is /2
        if ($pageNumber) {
            $endpoint .= "&page={$pageNumber}";
        }

        return $endpoint;
    }

    /**
     * Get the request options with the basic authorization.
     *
     * @since 0.1.0
     *
     * @param array $options
     *
     * @return array
     */
    protected function mergeOptionsWithAuth(array $options)
    {
        return array_merge($options, [
            'auth' => [
                $this->config['token'],
                'X',
            ],
        ]);
    }
}