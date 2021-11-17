<?php

namespace OK\Ipstack\Entity\Params;

use OK\Ipstack\Exceptions\InvalidParameterException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
trait ParameterBagTrait
{
    protected string $key;
    protected string $format = ParameterBagInterface::FORMAT_JSON;
    protected string $protocol = ParameterBagInterface::PROTOCOL_HTTP;
    protected string $language = 'en';

    public function getKey(): string
    {
        return $this->key;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setProtocol(string $protocol): void
    {
        if (!in_array($protocol, $this->getAvailableProtocols())) {
            throw new InvalidParameterException(sprintf("Invalid protocol '%s'. Please, use one of existing protocols [%s]", $protocol, implode(',', $this->getAvailableProtocols())));
        }

        $this->protocol = $protocol;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setLanguage(string $language): void
    {
        if (!in_array($language, ParameterBagInterface::LANGUAGES)) {
            throw new InvalidParameterException(sprintf("Invalid language '%s'. Please, use one of existing languages [%s]", $language, implode(',', ParameterBagInterface::LANGUAGES)));
        }

        $this->language = $language;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setFormat(string $format): void
    {
        if (!in_array($format, $this->getAvailableFormats())) {
            throw new InvalidParameterException(sprintf("Invalid output format '%s'. Please, use one of existing formats [%s]", $format, implode(',', $this->getAvailableFormats())));
        }

        $this->format = $format;
    }

    protected function getAvailableProtocols(): array
    {
        return [
            ParameterBagInterface::PROTOCOL_HTTP,
            ParameterBagInterface::PROTOCOL_HTTPS
        ];
    }

    protected function getAvailableFormats(): array
    {
        return [
            ParameterBagInterface::FORMAT_JSON,
            ParameterBagInterface::FORMAT_XML
        ];
    }
}
