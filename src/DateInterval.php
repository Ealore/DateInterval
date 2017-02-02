<?php

namespace Ealore\DateInterval;

class DateInterval extends \DateInterval
{
   /**
     * @param string $interval_spec
     * @return void
     */
    public function __construct(string $interval_spec)
    {
        $invert = 0;

        if ($interval_spec != '' && $interval_spec[0] == '-') {

            $invert = 1;

            $interval_spec = substr($interval_spec, 1);
        }

        parent::__construct($interval_spec);

        // weeks are defined
        if (stristr($interval_spec, 'W')) {
            preg_match('/.*(?P<weeks>\d+)W.*/', $interval_spec, $matches);
            $this->w = $matches['weeks'];

            // days are defined too
            if (stristr($interval_spec, 'D')) {
                preg_match('/.*(?P<weeks>\d+)W(?P<days>\d+)D.*/', $interval_spec, $matches);
                    $this->w = $matches['weeks'];
                    $this->d = $matches['days'];
            } else {
                // days are not defined, reset
                $this->d = 0;
            }

        }

        $this->invert = $invert;
    } // __construct

    /**
     * @return \DateTime
     */
    public function legacy()
    {
        $legacy = unserialize(serialize($this));

        // var_dump($legacy);

        $legacy->d = $this->d + ($this->w * 7);
        $legacy->w = 0;

        return $legacy;
    } // getLegacyInterval()
}