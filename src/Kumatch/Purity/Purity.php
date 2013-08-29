<?php

namespace Kumatch\Purity;

class Purity
{

    /** @var mixed **/
    protected $value;

    /**
     * @param $value
     * @return static
     */
    static public function start($value)
    {
        return new static($value);
    }


    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $to
     * @param array $froms
     * @return $this
     */
    public function to($to, array $froms = array())
    {
        foreach ($froms as $from) {
            if ($from === $this->value) {
                $this->value = $to;
            }
        }

        return $this;
    }

    /**
     * @param array $froms
     * @return $this
     */
    public function toBlank(array $froms = array(null))
    {
        $this->to('', $froms);

        return $this;
    }

    /**
     * @param array $froms
     * @return $this
     */
    public function toNull(array $froms = array(''))
    {
        $this->to(null, $froms);

        return $this;
    }

    /**
     * @return $this
     */
    public function toBoolean()
    {
        if (!$this->value || $this->value === '0' || $this->value === 'false') {
            $this->value = false;
        } else {
            $this->value = true;
        }

        return $this;
    }

    /**
     * @param $to
     * @param array $froms
     * @return $this
     */
    public function toDefault($to, array $froms = array('', null))
    {
        return $this->to($to, $froms);
    }
}