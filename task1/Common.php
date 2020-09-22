<?php
declare(strict_types=1);

namespace task1;

/**
 * Class Common
 * @package task1
 */
class Common
{
    /**
     * @var string|string
     */
    protected string $message;

    /**
     * Common constructor.
     * @param string|null $message
     */
    public function __construct(?string $message)
    {
        $this->message = $message ?? '';
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return get_class($this);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}