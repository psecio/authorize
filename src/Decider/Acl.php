<?php

namespace Psecio\Authorize\Decider;

class Acl extends \Psecio\Authorize\Decider
{
    const LIST_ID = 'acl-list';

    public function __construct(array $list)
    {
        $this->setContext([
            self::LIST_ID => $list
        ]);
    }

    /**
     * Execute the decider based on onput and context
     * The identifier value will be in $input[0] based on how the verify() is called
     *
     * @param array $input
     * @return void
     */
    public function execute($input)
    {
        // Get the subject "identifier" and see if it matches one in our list
        $list = $this->getContext(self::LIST_ID);

        if (!($input[0] instanceof \Psecio\Authorize\Context\Subject)) {
            $subject = new \Psecio\Authorize\Context\Subject([
                'identifier' => $input[0]
            ]);
        } else {
            $subject = $input[0];
        }

        // Perform the evaluation
        return in_array($subject->getIdentifier(), $list);
    }
}