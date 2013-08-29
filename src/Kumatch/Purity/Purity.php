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
     * @return $this
     */
    public function numericToInteger()
    {
        if (is_numeric($this->value)) {
            $this->value = (int)$this->value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function numericToFloat()
    {
        if (is_numeric($this->value)) {
            $this->value = (float)$this->value;
        }

        return $this;
    }

    /**
     * @param string|array|null $charlist
     * @return $this
     */
    public function trim($charlist = null)
    {
        if (!is_string($this->value)) {
            return $this;
        }

        if (is_null($charlist)) {
            $this->value = trim($this->value);
        } else if (is_array($charlist)) {
            $this->value = trim($this->value, implode('', $charlist));
        } else {
            $this->value = trim($this->value, $charlist);
        }

        return $this;
    }

    /**
     * @param string|array|null $charlist
     * @return $this
     */
    public function ltrim($charlist = null)
    {
        if (!is_string($this->value)) {
            return $this;
        }

        if (is_null($charlist)) {
            $this->value = ltrim($this->value);
        } else if (is_array($charlist)) {
            $this->value = ltrim($this->value, implode('', $charlist));
        } else {
            $this->value = ltrim($this->value, $charlist);
        }

        return $this;
    }

    /**
     * @param string|array|null $charlist
     * @return $this
     */
    public function rtrim($charlist = null)
    {
        if (!is_string($this->value)) {
            return $this;
        }

        if (is_null($charlist)) {
            $this->value = rtrim($this->value);
        } else if (is_array($charlist)) {
            $this->value = rtrim($this->value, implode($charlist));
        } else {
            $this->value = rtrim($this->value, $charlist);
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