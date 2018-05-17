<?php

namespace Psecio\Authorize\Decider;

use \Psecio\PropAuth\Enforcer;

class Acl extends \Psecio\Authorize\Decider
{
    const LIST_ID = 'acl-list';

    public function __construct(array $list)
    {
        echo 'init decider: '.print_r($list, true)."\n";

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
    public function execute($policy, $input)
    {
error_log(get_class().' :: '.__FUNCTION__);
        // Get the subject "identifier" and see if it matches one in our list
        $list = $this->getContext(self::LIST_ID);

        if (!($input[0] instanceof \Psecio\Authorize\Context\Subject)) {
            $subject = new \Psecio\Authorize\Context\Subject([
                'identifier' => $input[0]
            ]);
        } else {
            $subject = $input[0];
        }
print_r($subject);
print_r($policy);
echo 'in, should be list: '.print_r($input, true)."\n";

        $enforcer = new Enforcer();
        return $enforcer->evaluate($subject, $policy);
    }
}