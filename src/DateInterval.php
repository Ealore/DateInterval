<?php

namespace Ealore\DateInterval;

class DateInterval extends \DateInterval
{
    public $w = 0;
    public $interval_spec = '';

   /**
     * @param string $interval_spec
     * @return void
     */
    public function __construct($interval_spec)
    {
        $invert = 0;
        $interval_spec = trim(strtoupper($interval_spec));

        $this->interval_spec = $interval_spec;

        if ($interval_spec != '' && $interval_spec[0] == '-') {
            $invert = 1;
            $interval_spec = substr($interval_spec, 1);
        }

        if ($interval_spec == 'PYMWDTHMS') {
            $interval_spec = 'P0Y0M0W0DT0H0M0S';
        }

        parent::__construct($interval_spec);

        if (stristr($interval_spec, 'W')) {
            // weeks are defined
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
     * Returns an instance of the legacy PHP \DateInteval class
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

    /**
     * Returns the interval specification string
     *
     * @return string
     */
    public function getIntervalSpec()
    {
         $interval_spec = $this->invert ? '-P' : 'P';

         $interval_spec .= $this->y ? "{$this->y}Y" : '';
         $interval_spec .= $this->m ? "{$this->m}M" : '';
         $interval_spec .= $this->w ? "{$this->w}W" : '';
         $interval_spec .= $this->d ? "{$this->d}D" : '';

        $interval_spec .= ($this->h || $this->i || $this->s) ? 'T' : '';

        $interval_spec .= $this->h ? "{$this->h}H" : '';
        $interval_spec .= $this->i ? "{$this->i}M" : '';
        $interval_spec .= $this->s ? "{$this->s}S" : '';

        return ($interval_spec == 'P' || $interval_spec == '-P') ? $this->interval_spec : $interval_spec;
    }
}
