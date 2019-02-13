<?php

/**
 * Simple MIME part to handle embedded calendar events
 *
 * @author Cosimo Meli
 */
class Swift_Calendar extends Swift_MimePart {

    /**
     * Default Content-Type for calendars
     */
    const CONTENT_TYPE = 'text/calendar';

    /**
     * Only this methods are recognized by common email providers
     */
    const METHOD_PUBLISH = 'PUBLISH';
    const METHOD_REQUEST = 'REQUEST';

    /**
     * Swift_Calendar constructor.
     *
     * @param string !null $data The iCal data as serialized string
     * @param string $method One of the constants defined in this class
     * @param string|null $charset Optional charset
     */
    public function __construct($data = null, $method = self::METHOD_REQUEST, $charset = null) {
        parent::__construct($data, self::CONTENT_TYPE, $charset);

        $this->setMethod($method);
    }

    /**
     * Set the method for the calendar
     *
     * @param string $method One of the constants defined in this class
     * @return $this
     */
    public function setMethod($method) {
        if ($method !== self::METHOD_REQUEST && $method !== self::METHOD_PUBLISH) {
            throw new InvalidArgumentException('Method must be PUBLISH or REQUEST');
        }

        $this->setHeaderParameter('Content-Type', 'method', $method);

        return $this;
    }

    /**
     * Get the method set for this instance
     *
     * @return string
     */
    public function getMethod() {
        return $this->getHeaderParameter('Content-Type', 'method');
    }

    /**
     * Get the default nesting level of this MIME part
     *
     * @return int
     */
    public function getNestingLevel() {
        return self::LEVEL_MIXED;
    }

    /**
     * Create a new Instance of this class
     *
     * @param string !null $data The iCal data as serialized string
     * @param string $method One of the constants defined in this class
     * @param string|null $charset Optional charset
     * @return Swift_Calendar
     */
    public static function newInstance($data = null, $method = self::METHOD_REQUEST, $charset = null) {
        return new self($data, $method, $charset);
    }

}