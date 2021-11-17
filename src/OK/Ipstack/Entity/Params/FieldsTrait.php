<?php

namespace OK\Ipstack\Entity\Params;

use OK\Ipstack\Exceptions\InvalidParameterException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
trait FieldsTrait
{
    protected array $fields = [];

    /**
     * @throws InvalidParameterException
     */
    public function addField(string $field)
    {
        if (!in_array($field, $this->getAvailableFields())) {
            throw new InvalidParameterException(sprintf("Invalid field '%s'. Please, use one of existing fields [%s]", $field, implode(',', $this->getAvailableFields())));
        }

        if (!in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }
    }

    public function removeField(string $field)
    {
        $key = array_search($field, $this->fields);

        if ($key !== false) {
            unset($this->fields[$key]);
        }
    }

    /**
     * @throws InvalidParameterException
     */
    public function setFields(array $fields)
    {
        foreach ($fields as $field) {
            $this->addField($field);
        }
    }

    public function clearFields()
    {
        $this->fields = [];
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Override in class which use this trait
     */
    public function getAvailableFields(): array
    {
        return [];
    }
}
