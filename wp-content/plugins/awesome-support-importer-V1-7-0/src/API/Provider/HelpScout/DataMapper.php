<?php

namespace Pressware\AwesomeSupport\API\Provider\HelpScout;

use Pressware\AwesomeSupport\API\Abstracts\DataMapper as AbstractDataMapper;

class DataMapper extends AbstractDataMapper
{
    /**
     * Maps the incoming JSON to the individual repositories.
     *
     * @since 0.1.1
     *
     * @param string $json
     * @param string $key (Optional)
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function mapJSON($json, $key = '')
    {
        $conversation = $this->fromJSON($json);

        if (!$this->withinDateRange($conversation->userUpdatedAt ?: $conversation->createdAt)) {
            return;
        }
        $ticketId = $conversation->number;

        $this->mapUsers($conversation);
        $this->mapTicket($ticketId, $conversation);

        foreach ((array)$conversation->_embedded->threads as $thread) {
            $this->mapThreads($ticketId, $thread);
        }
    }

    /**
     * Map the ticket, storing it into the ticket repository. Plus, store the "open" status in history.
     *
     * @since 0.1.0
     *
     * @param string|int $ticketId
     * @param \stdClass|null $conversation
     *
     * @return void
     */
    protected function mapTicket($ticketId, $conversation)
    {
        $customerId = is_object($conversation->primaryCustomer) ? $conversation->primaryCustomer->id : 0;
        $this->ticketRepository->create($ticketId, [
            'agentID'    => is_object($conversation->createdBy) ? $conversation->createdBy->id : 0,
            'customerID' => is_object($conversation->primaryCustomer) ? $conversation->primaryCustomer->id : 0,
            'subject'    => $conversation->subject,
            'createdAt'  => $conversation->createdAt,
            'updatedAt'  => $conversation->userUpdatedAt,
        ]);

        $this->historyRepository->create(
            $ticketId,
            $customerId,
            'open',
            $conversation->createdAt
        );
    }

    /**
     * Map the threads to the appropriate repository.  Threads can be a reply, original ticket, status (history)
     * item, or note.  Notes are stored.
     *
     * @since 0.1.0
     *
     * @param int|string $ticketId
     * @param \stdClass $thread
     *
     * @return void
     */
    protected function mapThreads($ticketId, $thread)
    {
        if ('note' === $thread->type) {
            return;
        }

        if ($this->isAReply($thread)) {
            return $this->mapReply($ticketId, $thread->id, $thread);
        }

        if ($this->isOriginalTicket($thread)) {
            return $this->mapOriginalTicket($ticketId, $thread);
        }

        if ('lineitem' === $thread->type) {
            return $this->mapHistory($ticketId, $thread);
        }
    }

    /**
     * Checks if the thread is the original ticket.
     *
     * @since 0.1.0
     *
     * @param \stdClass $thread
     *
     * @return bool
     */
    protected function isOriginalTicket($thread)
    {
        if (!property_exists($thread, 'state')) {
            return false;
        }
        return 'published' === $thread->state && 'customer' === $thread->type;
    }

    /**
     * Checks if the thread is a reply.
     *
     * @since 0.1.0
     *
     * @param \stdClass $thread
     *
     * @return bool
     */
    protected function isAReply($thread)
    {
        return 'message' === $thread->type
            && property_exists($thread->action->associatedEntities, 'originalConversation')
            && !empty($thread->action->associatedEntities->originalConversation);
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
            'url'      => $attachment->_links->web->href,
            'filename' => $attachment->filename,
        ];
    }

    /**
     * Map the users of this conversation.
     *
     * @since 0.1.0
     *
     * @param \stdClass $conversation
     *
     * @return void
     */
    protected function mapUsers($conversation)
    {
        foreach (['createdBy', 'primaryCustomer'] as $property) {
            $this->mapUser(
                $conversation->{$property},
                'primaryCustomer' === $property ? $property : 'agent'
            );
        }
    }

    /**
     * If this is a user, create the user's model and store in the User's repository.
     *
     * @since 0.1.0
     *
     * @param \stdClass|null|mixed $user
     * @param string $role
     *
     * @return void
     */
    protected function mapUser($user, $role = '')
    {
        if (!$user instanceof \stdClass) {
            return;
        }
        if (!$role) {
            $role = 'user' === $user->type ? 'customer' : 'agent';
        }

        // Cast it to an array for strict mode, i.e. to add more properties.
        $user         = (array)$user;
        $user['role'] = $role;
        $user['name'] = "{$user['first']} {$user['last']}";

        // Cast it back to a stdClass object and create the model.
        $this->userRepository->createModel((object)$user);
    }

    /**
     * Map the reply, creating it's model in the repository. If there attachments, map those to store with
     * the reply's model.
     *
     * @since 0.2.0
     *
     * @param int $ticketId
     * @param int $replyId
     * @param \stdClass $thread
     *
     * @return void
     */
    protected function mapReply($ticketId, $replyId, \stdClass $thread)
    {
        $this->mapUser($thread->createdBy);

        $this->replyRepository->create(
            $ticketId,
            $replyId,
            [
                'ticketId'  => $ticketId,
                'userId'    => $thread->createdBy->id,
                'reply'     => $thread->body,
                'timestamp' => $thread->createdAt,
            ]
        );

        $this->mapAttachments($thread->_embedded->attachments, $ticketId, $replyId);
    }

    /**
     * Map the original ticket's description (comment) and attachments.
     *
     * @since 0.1.0
     *
     * @param int $ticketId
     * @param \stdClass $thread
     *
     * @return void
     */
    protected function mapOriginalTicket($ticketId, \stdClass $thread)
    {
        $this->ticketRepository->set("$ticketId.description", $thread->body);
        $this->mapAttachments($thread->_embedded->attachments, $ticketId);
    }

    /**
     * Map the historical item for this thread.
     *
     * @since 0.1.0
     *
     * @param int|string $ticketId
     * @param \stdClass $thread
     *
     * @return void
     */
    protected function mapHistory($ticketId, \stdClass $thread)
    {
        if (in_array($thread->status, ['nochange', 'spam'])) {
            return;
        }

        $this->historyRepository->create(
            $ticketId,
            $thread->createdBy->id,
            $this->getHistoryStatus($thread->status),
            $thread->createdAt
        );
    }
}
